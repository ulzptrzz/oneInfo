@component('mail::message')
# Pendaftaran Siswa Baru

Seorang siswa baru baru saja mendaftar.

**Nama:** {{ $siswa->name }}  
**Email:** {{ $siswa->email }}  
**Waktu Daftar:** {{ $siswa->created_at->format('d M Y H:i') }}

@component('mail::button', ['url' => route('admin.dashboard')])
Lihat Dashboard Admin
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
