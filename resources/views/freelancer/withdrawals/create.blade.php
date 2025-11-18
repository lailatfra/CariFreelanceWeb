    @extends('freelancer.layout.freelancer-layout')

    @section('title', 'Ajukan Penarikan Saldo')

    @section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-money-check-alt mr-2"></i>Ajukan Penarikan Saldo
            </h1>
            <a href="{{ route('freelancer.withdrawals.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <div class="row">
            <!-- Form -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">Form Penarikan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('freelancer.withdrawals.store') }}" method="POST">
                            @csrf

                            <!-- Amount -->
                            <div class="form-group">
                                <label for="amount" class="font-weight-bold">
                                    Jumlah Penarikan <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" 
                                        name="amount" 
                                        id="amount" 
                                        class="form-control @error('amount') is-invalid @enderror" 
                                        value="{{ old('amount') }}"
                                        min="50000"
                                        max="{{ $wallet->balance }}"
                                        step="1000"
                                        required>
                                </div>
                                <small class="form-text text-muted">
                                    Minimum penarikan: Rp 50.000 | Maksimum: {{ $wallet->formatted_balance }}
                                </small>
                                @error('amount')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Bank Name -->
                            <div class="form-group">
                                <label for="bank_name" class="font-weight-bold">
                                    Nama Bank <span class="text-danger">*</span>
                                </label>
                                <select name="bank_name" 
                                        id="bank_name" 
                                        class="form-control @error('bank_name') is-invalid @enderror" 
                                        required>
                                    <option value="">-- Pilih Bank --</option>
                                    <option value="BCA" {{ old('bank_name') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                    <option value="Mandiri" {{ old('bank_name') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                    <option value="BNI" {{ old('bank_name') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                    <option value="BRI" {{ old('bank_name') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                    <option value="CIMB Niaga" {{ old('bank_name') == 'CIMB Niaga' ? 'selected' : '' }}>CIMB Niaga</option>
                                    <option value="Danamon" {{ old('bank_name') == 'Danamon' ? 'selected' : '' }}>Danamon</option>
                                    <option value="Permata" {{ old('bank_name') == 'Permata' ? 'selected' : '' }}>Permata</option>
                                    <option value="BSI" {{ old('bank_name') == 'BSI' ? 'selected' : '' }}>BSI</option>
                                    <option value="BTN" {{ old('bank_name') == 'BTN' ? 'selected' : '' }}>BTN</option>
                                </select>
                                @error('bank_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Account Number -->
                            <div class="form-group">
                                <label for="account_number" class="font-weight-bold">
                                    Nomor Rekening <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                    name="account_number" 
                                    id="account_number" 
                                    class="form-control @error('account_number') is-invalid @enderror" 
                                    value="{{ old('account_number') }}"
                                    placeholder="Contoh: 1234567890"
                                    required>
                                @error('account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Account Holder Name -->
                            <div class="form-group">
                                <label for="account_holder_name" class="font-weight-bold">
                                    Nama Pemilik Rekening <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                    name="account_holder_name" 
                                    id="account_holder_name" 
                                    class="form-control @error('account_holder_name') is-invalid @enderror" 
                                    value="{{ old('account_holder_name', Auth::user()->name) }}"
                                    placeholder="Sesuai dengan rekening bank"
                                    required>
                                @error('account_holder_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <div class="form-group mb-0 mt-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-paper-plane mr-2"></i>Ajukan Penarikan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Info Sidebar -->
            <div class="col-lg-4">
                <!-- Balance Info -->
                <div class="card shadow mb-4 border-left-success">
                    <div class="card-body">
                        <h6 class="font-weight-bold text-success mb-3">
                            <i class="fas fa-info-circle mr-2"></i>Informasi Saldo
                        </h6>
                        <div class="mb-3">
                            <small class="text-muted d-block">Saldo Tersedia</small>
                            <h4 class="font-weight-bold text-success mb-0">
                                {{ $wallet->formatted_balance }}
                            </h4>
                        </div>
                        <div>
                            <small class="text-muted d-block">Saldo Dalam Proses</small>
                            <h5 class="font-weight-bold text-warning mb-0">
                                Rp {{ number_format($wallet->pending_balance, 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- Important Notes -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h6 class="font-weight-bold text-primary mb-3">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Ketentuan Penarikan
                        </h6>
                        <ul class="small mb-0 pl-3">
                            <li class="mb-2">Minimum penarikan adalah <strong>Rp 50.000</strong></li>
                            <li class="mb-2">Penarikan akan diproses dalam <strong>1-3 hari kerja</strong></li>
                            <li class="mb-2">Pastikan data rekening bank Anda <strong>sudah benar</strong></li>
                            <li class="mb-2">Anda hanya dapat mengajukan <strong>1 penarikan dalam satu waktu</strong></li>
                            <li class="mb-0">Dana akan ditransfer ke rekening yang Anda daftarkan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection