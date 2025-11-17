<div>
    <h1 class="font-bold text-[#0C356A] text-2xl">Join Program</h1>
    <div>
        <p>{{ $program->name }}</p>
        <p>{{ $program->deskripsi_singkat }}</p>
        <button wire:click='joinProgram' class="flex items-center gap-1 bg-[#0C356A] text-white px-3 py-2 rounded-md hover:bg-[#082d5b] transition">Join Program</button>
    </div>
</div>
