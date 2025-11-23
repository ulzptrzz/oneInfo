@component('mail::message')
# 📝 Pendaftaran Siswa Baru

Ada seorang siswa baru yang baru saja mendaftar ke sebuah program.

---

## 👤 Data Siswa
**Nama:** {{ $pendaftaran->siswa->user->name }}  
**Email:** {{ $pendaftaran->siswa->user->email }}  
**Kelas:** {{ $pendaftaran->siswa->kelas->nama_kelas ?? '-' }}

---

## 🎓 Program yang Didaftarkan
**Program:** {{ $pendaftaran->program->name }}  
**Kategori:** {{ $pendaftaran->program->kategori_program->nama_kategori ?? '-' }}  
**Pelaksanaan:** {{ ucfirst($pendaftaran->program->pelaksanaan) }}

---

## ⏳ Waktu Pendaftaran
{{ $pendaftaran->created_at->format('d M Y H:i') }}

---

@component('mail::button', ['url' => route('list-pendaftaran-program')])
Kelola Pendaftaran
@endcomponent

Terima kasih,<br>
**{{ config('app.name') }}**
@endcomponent
