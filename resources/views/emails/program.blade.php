@component('mail::message')

# 🎉 Halo <strong>Satoernus</strong>!
Kami dengan senang hati mengumumkan bahwa sebuah program baru telah ditambahkan ke <strong>Website <span style="color:#FFC436 font-bold">OneInfo</span></strong>.
Segera kunjungi websitenya dan ikut berpartisipasi dalam program tersebut!. Semangat <strong>Satoernus</strong>!

---

## ✨**{{ $program->name }}**✨
<div style="margin-top:10px; padding: 15px; background:#f1f5f9; border-radius:10px;">
    <p style="margin: 0;">
        📝<strong> Kategori:</strong> {{ $program->kategoriProgram->nama_kategori ?? '-' }}<br>
        📆<strong> Tanggal Pendaftaran :</strong>
        {{ \Carbon\Carbon::parse($program->tanggal_mulai)->translatedFormat('d F Y') }}
        -
        {{ \Carbon\Carbon::parse($program->tanggal_selesai)->translatedFormat('d F Y') }}
        <br>
    </p>
</div>

---

@component('mail::button', ['url' => route('guest-detail-program', $program->id), 'color' => 'primary'])
✨ Lihat Detail Program
@endcomponent

---

Terima kasih,
<strong>OneInfo - SMKN 1 Kota Bekasi</strong>
<small>"Mewujudkan Siswa Hebat dan Berprestasi"</small>

@endcomponent