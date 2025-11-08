<div class="bg-gray-100 text-gray-800">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white p-6 space-y-6">
      <h1 class="text-xl font-bold">Admin OneInfo</h1>
      <nav class="space-y-2">
        <a href="{{ route('admin.kategori-program') }}" class="block hover:bg-blue-600 rounded px-3 py-2">Kategori</a>
        <a href="{{ route('admin.program') }}" class="block hover:bg-blue-600 rounded px-3 py-2">Program</a>
        <a href="{{ route('admin.perizinan') }}" class="block hover:bg-blue-600 rounded px-3 py-2">Perizinan</a>
      </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-8">
      @yield('content')
    </main>
  </div>
  @livewireScripts
</div>
