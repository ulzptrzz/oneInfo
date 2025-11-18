<div>
    <div class="flex min-h-screen">
       <x-sidebar-siswa />
       <div class="max-w-5xl mx-auto p-6">
           <div class="bg-white rounded-3xl shadow-2xl p-8 space-y-6">
               <p>{{ $user->name }}</p>
               <p>{{ $user->email }}</p>
               <p>00{{ $user->siswa->nisn }}</p>
               <p>{{ $user->siswa->nis }}</p>
               <p>{{ $user->siswa->kelas->tingkat }} {{ $user->siswa->kelas->jurusan->nama_jurusan }} {{ $user->siswa->kelas->nama_kelas }} </p>
               <p>{{ $user->siswa->kelas->tahun_ajaran }}</p>
           </div>

       </div>
        <div>
            {{-- <img src="{{ asset('storage/' . $user->siswa->foto) }}" alt="foto siswa" /> --}}
        </div>
    </div>
</div>