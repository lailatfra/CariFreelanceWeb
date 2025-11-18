<?php
// app/Console/Commands/MigratePaymentsToWallet.php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Wallet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigratePaymentsToWallet extends Command
{
    protected $signature = 'wallet:migrate-payments';
    protected $description = 'Migrate existing successful payments to freelancer wallets';

    public function handle()
    {
        $this->info('Starting migration of existing payments to wallets...');

        DB::beginTransaction();
        try {
            // Ambil semua payment yang sudah success
            $successPayments = Payment::where('status', 'success')
                ->with(['freelancer', 'project'])
                ->get();

            $this->info("Found {$successPayments->count()} successful payments");

            $bar = $this->output->createProgressBar($successPayments->count());
            $bar->start();

            $totalCredit = 0;
            $processedFreelancers = [];

            foreach ($successPayments as $payment) {
                // Buat atau ambil wallet freelancer
                $wallet = Wallet::firstOrCreate(
                    ['user_id' => $payment->freelancer_id],
                    ['balance' => 0, 'pending_balance' => 0]
                );

                // Cek apakah transaksi ini sudah pernah di-credit
                $existingTransaction = $wallet->transactions()
                    ->where('payment_id', $payment->id)
                    ->exists();

                if (!$existingTransaction) {
                    // Credit wallet
                    $wallet->credit(
                        $payment->service_amount,
                        "Migrasi: Pembayaran dari project #{$payment->project_id}" . 
                        ($payment->project ? " - {$payment->project->title}" : ""),
                        $payment->id
                    );

                    $totalCredit += $payment->service_amount;
                    
                    if (!in_array($payment->freelancer_id, $processedFreelancers)) {
                        $processedFreelancers[] = $payment->freelancer_id;
                    }
                }

                $bar->advance();
            }

            $bar->finish();
            $this->newLine(2);

            DB::commit();

            $this->info("✅ Migration completed successfully!");
            $this->info("📊 Statistics:");
            $this->info("   - Total payments migrated: {$successPayments->count()}");
            $this->info("   - Total freelancers affected: " . count($processedFreelancers));
            $this->info("   - Total amount credited: Rp " . number_format($totalCredit, 0, ',', '.'));

            return 0;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("❌ Migration failed: " . $e->getMessage());
            $this->error($e->getTraceAsString());
            return 1;
        }
    }
}