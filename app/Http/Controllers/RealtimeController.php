<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Barang;
use App\Models\Ruangan;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RealtimeController extends Controller
{
    /**
     * Polling JSON Endpoint (Ringan, Cepat, Tanpa Beban Daemon)
     * Digunakan oleh JavaScript client di Admin, Kepsek, dan PJ
     */
    public function poll(Request $request)
    {
        $lastId = (int) $request->query('last_id', 0);
        $role = $request->query('role', 'admin');
        $userId = auth()->id();

        $unreadLaporanCount = Laporan::where('status', 'Menunggu Verifikasi')->count();
        $sedangDiprosesCount = Laporan::where('status', 'Sedang Diproses')->count();
        $totalBarang = Barang::sum('jumlah');
        $totalRuangan = Ruangan::count();

        // Laporan terbaru setelah lastId
        $query = Laporan::with(['pelapor', 'ruangan', 'barang'])->latest('id');
        if ($role === 'pj' && $userId) {
            $query->where('user_id', $userId);
        }
        
        $newReports = $query->when($lastId > 0, fn($q) => $q->where('id', '>', $lastId))
            ->limit(10)
            ->get()
            ->map(function ($lap) {
                return [
                    'id' => $lap->id,
                    'kode' => $lap->kode_laporan,
                    'pelapor' => $lap->pelapor?->name ?? 'PJ Lab',
                    'ruangan' => $lap->ruangan?->nama ?? '-',
                    'barang' => $lap->nama_barang,
                    'jenis' => $lap->jenis,
                    'urgensi' => $lap->urgensi,
                    'status' => $lap->status,
                    'waktu' => $lap->tanggal_lapor?->diffForHumans() ?? 'Baru saja',
                ];
            });

        return response()->json([
            'success' => true,
            'timestamp' => now()->timestamp,
            'unread_laporan_count' => $unreadLaporanCount,
            'sedang_diproses_count' => $sedangDiprosesCount,
            'total_barang' => $totalBarang,
            'total_ruangan' => $totalRuangan,
            'has_new' => $newReports->isNotEmpty(),
            'new_reports' => $newReports,
        ]);
    }

    /**
     * Server-Sent Events (SSE) Stream
     * Respons instan tanpa loop blocking demi performa cepat & anti-lag di local server
     */
    public function stream(Request $request)
    {
        return response()->json([
            'status' => 'online',
            'message' => 'Realtime service active via async poll.',
        ]);
    }
}
