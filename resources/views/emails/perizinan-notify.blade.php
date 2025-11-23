@component('mail::message')
# 📄 Surat Perizinan Telah Dikirim

Halo **{{ $pendaftaran->siswa->user->name }}**,  
Admin telah mengunggah dan mengirimkan surat perizinan kegiatan kamu.

---

## 📝 Detail Pendaftaran
**Program:** {{ $pendaftaran->program->name }}  
**Kategori:** {{ $pendaftaran->program->kategori_program->nama_kategori ?? '-' }}  
**Pelaksanaan:** {{ ucfirst($pendaftaran->program->pelaksanaan) }}  

**Tanggal Daftar:** {{ $pendaftaran->tanggal_daftar }}

---

## 📑 Surat Perizinan
**Tanggal Dikirim:** {{ $perizinan->tanggal_dikirim }}  
**Catatan Admin:**  
@if($perizinan->catatan)
> "{{ $perizinan->catatan }}"
@else
Tidak ada catatan tambahan.
@endif

@component('mail::button', ['url' => asset('storage/' . $perizinan->file)])
Download Surat Perizinan
@endcomponent

---

Jika ada kesalahan atau butuh revisi, silakan hubungi pihak sekolah.

Terima kasih,  
**{{ config('app.name') }}**
@endcomponent
