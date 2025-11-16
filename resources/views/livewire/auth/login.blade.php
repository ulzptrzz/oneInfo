<div>
    <div class="text-center mb-5 pt-20">
        <h1 class="text-4xl text-[#ffc436] font-extrabold">OneInfo</h1>
        <p class="text-lg text-[#0C356A] font-bold">Selamat datang dan dapatkan info terbaru</p>
    </div>

    <!-- Toggle Role -->
    <div class="flex justify-center mb-5">
        <div class="shadow-lg flex rounded-xl overflow-hidden">
            <button wire:click="setRole('siswa')"
                class="px-6 py-2 font-semibold transition
                {{ $role === 'siswa' ? 'bg-[#0C356A] text-white' : 'bg-white text-[#0C356A] hover:bg-[#eaeaea]' }}">
                Siswa
            </button>
            <button wire:click="setRole('admin')"
                class="px-6 py-2 font-semibold transition
                {{ $role === 'admin' ? 'bg-[#0C356A] text-white' : 'bg-white text-[#0C356A] hover:bg-[#eaeaea]' }}">
                Admin
            </button>
        </div>
    </div>

    <!-- Form -->
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-3xl shadow-2xl p-8 space-y-6">
                <form wire:submit.prevent="login" class="space-y-5">

                    @if ($role === 'admin')
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                            <input type="email" id="email" wire:model="email" placeholder="Masukkan email anda"
                                class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500" />
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="relative">
                            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                                Password
                            </label>

                            <div class="relative">
                                <input type="password" id="password" wire:model="password"
                                    placeholder="Masukkan password anda"
                                    class="w-full px-4 py-3 pl-4 pr-12 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 outline-none text-base" />

                                <!-- Tombol Toggle Password -->
                                <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-[#0C356A] focus:outline-none transition-colors">
                                    <i id="eyeIcon" class="bx bx-hide text-xl"></i>
                                </button>
                            </div>

                            @error('password')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                            <input type="email" id="email" wire:model="email" placeholder="Masukkan email anda"
                                class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500" />
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NISN -->
                        <div class="relative">
                            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                                NISN
                            </label>

                            <div class="relative">
                                <input type="password" id="password" wire:model="password"
                                    placeholder="Masukkan NISN anda"
                                    class="w-full px-4 py-3 pr-12 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500" />

                                <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-[#0C356A]">
                                    <i id="eyeIcon" class="bx bx-hide text-xl"></i>
                                </button>
                            </div>

                            @error('password')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <!-- Tombol Masuk -->
                    <button type="submit"
                        class="w-full bg-[#0C356A] hover:bg-[#0075a7] text-white font-semibold py-3 rounded-lg transition duration-200 transform hover:scale-105 active:scale-95">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('bx-hide');
            eyeIcon.classList.add('bx-show');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('bx-show');
            eyeIcon.classList.add('bx-hide');
        }
    }

    
</script>
