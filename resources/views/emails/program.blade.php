@component('mail::message')

# 🎉 Halo <strong>Satoernus</strong>!  
Kami dengan senang hati mengumumkan bahwa program baru telah dipublikasikan dan siap kamu ikuti.
Sebuah program baru telah ditambahkan ke <strong>Website <span style="color:#0C356A">One</span><span style="color:#FFC436">Info</span></strong>. 
Segera kunjungi dan ikut berpartisipasi dalam program tersebut!. Semangat <strong>Satoernus</strong>!  

---

## 📝 **{{ $program->name }}**
<div style="margin-top:10px; padding: 15px; background:#f1f5f9; border-radius:10px;">
    <p style="margin: 0;">
        <strong>Kategori:</strong> {{ $program->kategoriProgram->nama_kategori ?? '-' }}<br>
        📆 <strong>Tanggal:</strong> {{ $program->tanggal_mulai }} - {{ $program->tanggal_selesai }}<br>
        <strong>Status:</strong> <span style="color:#0ea5e9; font-weight:bold;">Terbuka</span>
    </p>
</div>

---

@component('mail::button', ['url' => route('detail-program', $program->id), 'color' => 'primary'])
✨ Lihat Detail Program
@endcomponent

---

Terima kasih,  
<strong>OneInfo - SMKN 1 Kota Bekasi</strong>  
<small>"Mewujudkan Siswa Hebat dan Berprestasi"</small>

@endcomponent
