@component('mail::message')
# Selamat {{ $freelancer->name }} 🎉

Akun Anda telah **disetujui** oleh admin.  
Sekarang Anda sudah bisa login ke platform kami.

@component('mail::button', ['url' => url('/login')])
Login Sekarang
@endcomponent

Terima kasih,<br>
CariFreelance
@endcomponent
