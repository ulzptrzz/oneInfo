<div class="flex min-h-screen">

    <aside class="fixed overflow-y-auto">
        <x-sidebar />
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 ml-64 mr-20 min-h-screen">
        <div class="w-full mx-8 my-7 overflow-hidden">

            {{-- Profile Container --}}
            <div class="max-w-5xl mx-auto">

                {{-- Cover Image / Header --}}
                <div class="bg-gradient-to-r from-[#0C356A] to-[#1e40af] h-48 md:h-64 rounded-t-2xl relative">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                {{-- Profile Card --}}
                <div class="bg-white rounded-b-2xl shadow-lg -mt-20 md:-mt-24 relative">

                    {{-- Profile Header --}}
                    <div class="px-6 md:px-10 pb-6">

                        {{-- Avatar & Basic Info --}}
                        <div class="flex flex-col md:flex-row md:items-end gap-6 mb-6">

                            {{-- Profile Photo --}}
                            <div class="relative -mt-16 md:-mt-20">
                                <div
                                    class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden ring-4 ring-white shadow-xl bg-gray-100">
                                    @if ($user->foto)
                                        <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#0C356A] to-[#1e40af]">
                                            <i class='bx bx-user text-white text-6xl'></i>
                                        </div>
                                    @endif
                                </div>
                                {{-- Status Badge --}}
                                <div
                                    class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 border-4 border-white rounded-full">
                                </div>
                            </div>

                            {{-- Name & Info --}}
                            <div class="flex-1 md:mb-4">
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                                    {{ $user->name }}
                                </h1>
                                <p class="text-gray-600 flex items-center gap-2 mb-3">
                                    <i class='bx bx-envelope'></i>
                                    {{ $user->email }}
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class='bx bx-shield-quarter'></i>
                                        Administrator
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-1 bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class='bx bx-building'></i>
                                        SMKN 1 Kota Bekasi
                                    </span>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="md:mb-4 flex gap-3">
                                <a href="{{ route('admin.edit-profil') }}"
                                    class="inline-flex items-center gap-2 bg-[#0C356A] hover:bg-[#ffc436] text-white hover:text-[#0C356A] px-6 py-2.5 rounded-lg font-medium transition">
                                    <i class='bx bx-edit'></i>
                                    Edit Profil
                                </a>
                            </div>
                        </div>

                        {{-- Tabs/Navigation --}}
                        <div class="border-b border-gray-200">
                            <div class="flex gap-6 overflow-x-auto">
                                <button
                                    class="px-4 py-3 text-[#0C356A] border-b-2 border-[#0C356A] font-semibold whitespace-nowrap">
                                    Informasi Pribadi
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Profile Content --}}
                    <div class="px-6 md:px-10 py-6">

                        {{-- Personal Information Section --}}
                        <div class="space-y-6">

                            <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Pribadi</h2>

                            {{-- Info Grid --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                {{-- Nama Lengkap --}}
                                <div
                                    class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div
                                        class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bx bx-user text-white text-2xl'></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-600 mb-1">Nama Lengkap</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div
                                    class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div
                                        class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bx bx-envelope text-white text-2xl'></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-600 mb-1">Email</p>
                                        <p class="text-lg font-semibold text-gray-900 break-all">{{ $user->email }}</p>
                                    </div>
                                </div>

                                {{-- No. Telepon --}}
                                <div
                                    class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div
                                        class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bx bx-phone text-white text-2xl'></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-600 mb-1">No. Telepon</p>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $user->phone ?? 'Belum diisi' }}</p>
                                    </div>
                                </div>

                                {{-- Role --}}
                                <div
                                    class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div
                                        class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class='bx bx-shield-quarter text-white text-2xl'></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-600 mb-1">Role</p>
                                        <p class="text-lg font-semibold text-gray-900">Administrator</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Info Alert --}}
                            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4 flex gap-3">
                                <i class='bx bx-info-circle text-blue-500 text-2xl flex-shrink-0'></i>
                                <div>
                                    <h4 class="font-semibold text-blue-900 mb-1">Informasi Akun</h4>
                                    <p class="text-sm text-blue-700">
                                        Untuk mengubah data profil, silakan klik tombol "Edit Profil" di atas.
                                        Pastikan data yang dimasukkan adalah data yang valid dan benar.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
