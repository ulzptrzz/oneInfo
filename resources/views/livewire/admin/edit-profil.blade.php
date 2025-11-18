<div>

    <div class="flex min-h-screen bg-gray-50">
          <x-sidebar/>
        {{-- Main Content --}}
        <main class="flex-1 w-full p-4 md:p-8 pt-20 lg:pt-8">

            {{-- Success Messages --}}
            @if (session()->has('success'))
                <div class="max-w-4xl mx-auto mb-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-start gap-3">
                        <i class='bx bx-check-circle text-green-500 text-2xl flex-shrink-0'></i>
                        <div class="flex-1">
                            <h4 class="font-semibold text-green-900 mb-1">Berhasil!</h4>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session()->has('password_success'))
                <div class="max-w-4xl mx-auto mb-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-start gap-3">
                        <i class='bx bx-check-circle text-green-500 text-2xl flex-shrink-0'></i>
                        <div class="flex-1">
                            <h4 class="font-semibold text-green-900 mb-1">Password Berhasil Diperbarui!</h4>
                            <p class="text-sm text-green-700">{{ session('password_success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Edit Form Container --}}
            <div class="max-w-4xl mx-auto space-y-6">
                
                {{-- Profile Information Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class='bx bx-user text-blue-600 text-xl'></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Informasi Profil</h2>
                            <p class="text-sm text-gray-600">Update foto profil dan data pribadi Anda</p>
                        </div>
                    </div>

                    <form wire:submit.prevent="updateProfile">
                        
                        {{-- Photo Upload --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Foto Profil</label>
                            <div class="flex items-start gap-6">
                                {{-- Current/Preview Photo --}}
                                <div class="flex-shrink-0">
                                    @if ($foto)
                                        <img src="{{ $foto->temporaryUrl() }}" 
                                             alt="Preview" 
                                             class="w-24 h-24 rounded-full object-cover ring-4 ring-blue-100">
                                    @elseif ($old_foto)
                                        <img src="{{ asset('storage/' . $old_foto) }}" 
                                             alt="Current" 
                                             class="w-24 h-24 rounded-full object-cover ring-4 ring-gray-100">
                                    @else
                                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#0C356A] to-[#1e40af] flex items-center justify-center ring-4 ring-gray-100">
                                            <i class='bx bx-user text-white text-4xl'></i>
                                        </div>
                                    @endif
                                </div>

                                {{-- Upload Button --}}
                                <div class="flex-1">
                                    <label for="foto" 
                                           class="inline-flex items-center gap-2 bg-white border-2 border-gray-300 hover:border-blue-500 text-gray-700 px-6 py-2.5 rounded-lg font-medium cursor-pointer transition">
                                        <i class='bx bx-upload text-xl'></i>
                                        <span>Pilih Foto</span>
                                    </label>
                                    <input type="file" 
                                           id="foto" 
                                           wire:model="foto" 
                                           accept="image/*"
                                           class="hidden">
                                    <p class="text-xs text-gray-500 mt-2">
                                        JPG, PNG atau GIF. Maksimal 2MB.
                                    </p>
                                    @error('foto')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- Nama Lengkap --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-user text-gray-400'></i>
                                    </div>
                                    <input type="text" 
                                           id="name"
                                           wire:model="name"
                                           class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="Masukkan nama lengkap">
                                </div>
                                @error('name')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-envelope text-gray-400'></i>
                                    </div>
                                    <input type="email" 
                                           id="email"
                                           wire:model="email"
                                           class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="Masukkan email">
                                </div>
                                @error('email')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- No. Telepon --}}
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    No. Telepon
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-phone text-gray-400'></i>
                                    </div>
                                    <input type="text" 
                                           id="phone"
                                           wire:model="phone"
                                           class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="08xx xxxx xxxx">
                                </div>
                                @error('phone')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Submit Button --}}
                        <div class="flex gap-3 mt-8">
                            <button type="submit"
                                    class="flex-1 bg-[#0C356A] hover:bg-[#ffc436] text-white hover:text-[#0C356A] px-6 py-3 rounded-lg font-bold transition">
                                <i class='bx bx-save'></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.profil') }}"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-bold transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>

                {{-- Change Password Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class='bx bx-lock text-yellow-600 text-xl'></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Ubah Password</h2>
                            <p class="text-sm text-gray-600">Update password untuk keamanan akun Anda</p>
                        </div>
                    </div>

                    <form wire:submit.prevent="updatePassword">
                        
                        <div class="space-y-4">
                            
                            {{-- Current Password --}}
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password Lama <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-lock text-gray-400'></i>
                                    </div>
                                    <input type="password" 
                                           id="current_password"
                                           wire:model="current_password"
                                           class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                           placeholder="Masukkan password lama">
                                </div>
                                @error('current_password')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                
                                {{-- New Password --}}
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Password Baru <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class='bx bx-lock-alt text-gray-400'></i>
                                        </div>
                                        <input type="password" 
                                               id="new_password"
                                               wire:model="new_password"
                                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                               placeholder="Minimal 8 karakter">
                                    </div>
                                    @error('new_password')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Confirm Password --}}
                                <div>
                                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                        Konfirmasi Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class='bx bx-check-circle text-gray-400'></i>
                                        </div>
                                        <input type="password" 
                                               id="new_password_confirmation"
                                               wire:model="new_password_confirmation"
                                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                               placeholder="Ulangi password baru">
                                    </div>
                                </div>

                            </div>

                            {{-- Password Requirements --}}
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <i class='bx bx-info-circle text-yellow-600 text-xl flex-shrink-0'></i>
                                    <div>
                                        <h4 class="font-semibold text-yellow-900 text-sm mb-2">Persyaratan Password:</h4>
                                        <ul class="text-xs text-yellow-700 space-y-1">
                                            <li>• Minimal 8 karakter</li>
                                            <li>• Kombinasi huruf dan angka lebih aman</li>
                                            <li>• Hindari password yang mudah ditebak</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Submit Button --}}
                        <div class="mt-6">
                            <button type="submit"
                                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-bold transition">
                                <i class='bx bx-key'></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </main>
        
    </div>
</div>