<div>
    <div class="font-bold text-white text-center mb-5">
        <h1 class="text-3xl font-extrabold">oneInfo</h1>
        <p class="xl">masuk untuk mengetahui info menarik lainnya</p>
    </div>
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-3xl shadow-2xl p-8 space-y-6">
                <form wire:submit.prevent="login" class="space-y-5">
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                            Email
                        </label>
                        <input type="email" id="email" wire:model="email" placeholder="masukkan email anda"
                            class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                            Password
                        </label>
                        <input type="password" id="password" wire:model="password" placeholder="masukkan password anda"
                            class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />

                    </div>
                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 rounded-lg transition duration-200 transform hover:scale-105 active:scale-95">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
