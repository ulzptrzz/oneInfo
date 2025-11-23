<?php

namespace App\Livewire\Admin;

use App\Models\Artikel;
use App\Models\Program;
use App\Models\Prestasi;
use App\Models\Dokumentasi;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalProgram;
    public $totalDokumentasi;
    public $totalPrestasi;
    public $totalArtikel;
    public $activities = []; // ← Tambah ini

    public function mount()
    {
        $this->totalProgram = Program::count();
        $this->totalDokumentasi = Dokumentasi::count();
        $this->totalPrestasi = Prestasi::count();
        $this->totalArtikel = Artikel::count();

        $this->loadRecentActivities();
    }

    public function loadRecentActivities()
    {
        $activities = collect();

        // 1. Program terbaru
        Program::latest()->take(5)->get()->each(function ($item) use ($activities) {
            $activities->push([
                'icon' => 'bx-receipt',
                'color' => 'blue',
                'title' => 'Program baru ditambahkan',
                'description' => $item->judul ?? 'Program baru',
                'time' => $item->created_at->diffForHumans(), 
                'created_at' => $item->created_at,
            ]);
        });

        Dokumentasi::latest()->take(5)->get()->each(function ($item) use ($activities) {
            $activities->push([
                'icon' => 'bx-camera',
                'color' => 'green',
                'title' => 'Dokumentasi ditambahkan',
                'description' => $item->judul,
                'time' => $item->created_at->diffForHumans(),
                'created_at' => $item->created_at,
            ]);
        });

        Prestasi::latest()->take(5)->get()->each(function ($item) use ($activities) {
            $activities->push([
                'icon' => 'bx-trophy',
                'color' => 'yellow',
                'title' => 'Prestasi baru tercatat',
                'description' => $item->nama_prestasi ?? 'Prestasi siswa',
                'time' => $item->created_at->diffForHumans(),
                'created_at' => $item->created_at,
            ]);
        });

        Artikel::latest()->take(5)->get()->each(function ($item) use ($activities) {
            $activities->push([
                'icon' => 'bx-news',
                'color' => 'purple',
                'title' => 'Artikel baru dipublikasikan',
                'description' => $item->judul,
                'time' => $item->created_at->diffForHumans(),
                'created_at' => $item->created_at,
            ]);
        });

        $this->activities = $activities
            ->sortByDesc('created_at')
            ->take(5)
            ->values();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}