@component('mail::message')
# Program Baru Telah Dibuat!

Halo Siswa,

Kami baru saja menambahkan program baru:

**{{ $program->name }}**

Kategori: {{ $program->kategoriProgram->nama_kategori ?? '-' }}  
Tanggal: {{ $program->tanggal_mulai }} - {{ $program->tanggal_selesai }}

@component('mail::button', ['url' => route('detail-program', $program->id)])
Lihat Detail
@endcomponent

Terima kasih!  
SMKN 1 Kota Bekasi
@endcomponent
