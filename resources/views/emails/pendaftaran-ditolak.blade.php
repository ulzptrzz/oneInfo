@component('mail::message')
# ❌ Pendaftaran Kamu Ditolak

Halo **{{ $pendaftaran->siswa->user->name }}**,  

Kami sudah melakukan review terhadap pendaftaran kamu pada program berikut:

---

## 📌 Detail Pendaftaran
**Nama Program:** {{ $pendaftaran->program->name }}  
**Kategori:** {{ $pendaftaran->program->kategoriProgram->nama_kategori ?? '-' }}  
**Tingkat:** {{ $pendaftaran->program->tingkat ?? '-' }}  
**Pelaksanaan:** {{ ucfirst($pendaftaran->pelaksanaan) }}  

**Tanggal Pendaftaran:** {{ $pendaftaran->tanggal_daftar }}  
**Mata Lomba:** {{ $pendaftaran->mata_lomba ?? '-' }}

---

## 📝 Alasan Penolakan
@if($pendaftaran->catatan_admin)
> "{{ $pendaftaran->catatan_admin }}"
@else
Tidak ada catatan tambahan dari admin.
@endif

---

Jika kamu merasa ada kesalahan atau ingin mengajukan ulang, silakan hubungi pihak sekolah.

@component('mail::button', ['url' => route('guest.bukti-pendaftaran', $pendaftaran->id), 'color' => 'primary'])
Lihat Semua Pendaftaran
@endcomponent

Terima kasih,  
**{{ config('app.name') }}**
@endcomponent
