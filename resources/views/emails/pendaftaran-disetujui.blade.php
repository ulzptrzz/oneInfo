@component('mail::message')
# 🎉 Pendaftaran Kamu Telah Disetujui!

Halo **{{ $pendaftaran->siswa->user->name }}**,  

Pendaftaran kamu untuk mengikuti kegiatan **{{ $pendaftaran->program->name }}** telah **resmi disetujui oleh pihak sekolah**.

---

## 📌 Detail Pendaftaran
**Nama Program:** {{ $pendaftaran->program->name }}  
**Kategori:** {{ $pendaftaran->program->kategoriProgram->nama_kategori ?? '-' }}  
**Tingkat:** {{ $pendaftaran->program->tingkat ?? '-' }}  
**Pelaksanaan:** **{{ ucfirst($pendaftaran->pelaksanaan) }}**  
**Tanggal Mulai:** {{ $pendaftaran->program->tanggal_mulai }}  
**Tanggal Selesai:** {{ $pendaftaran->program->tanggal_selesai }}  

**Tanggal Pendaftaran:** {{ $pendaftaran->tanggal_daftar }}  
**Mata Lomba:** {{ $pendaftaran->mata_lomba ?? '-' }}

---

@if($pendaftaran->pelaksanaan === 'offline')
## 📝 Informasi Tambahan (Offline)
Karena kegiatan ini **berlangsung secara offline**, mohon **menunggu surat perizinan dari sekolah**.  
Admin akan segera mengirimkan surat perizinan tersebut melalui sistem.

@endif

---

Jika kamu membutuhkan bantuan, silakan hubungi admin sekolah.

@component('mail::button', ['url' => url('/pendaftaran/'.$pendaftaran->id)])
Lihat Detail Pendaftaran
@endcomponent

Terima kasih,  
**{{ config('app.name') }}**
@endcomponent
