<div>
    <div class="flex min-h-screen">
       <x-sidebar-siswa />
        <div>
            <img src="{{ asset('storage/' . $user->siswa->foto) }}" alt="foto siswa" />
            <p>{{ $user->name }}</p>
            <p>{{ $user->email }}</p>
            <p>00{{ $user->siswa->nisn }}</p>
            <p>{{ $user->siswa->nis }}</p>
            <p>{{ $user->siswa->kelas->tingkat }} {{ $user->siswa->kelas->jurusan->nama_jurusan }} {{ $user->siswa->kelas->nama_kelas }} </p>
            <p>{{ $user->siswa->kelas->tahun_ajaran }}</p>
        </div>
    </div>
</div>