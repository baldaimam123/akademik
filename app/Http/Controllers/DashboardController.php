<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
    $dashboardData = Siswa::with('kelas')->select('kelas_id')->selectraw('COUNT(*) as total')->groupBy('kelas_id')->get();
    $jumlahdash = Siswa::count();
        return view('admin.dashboard-admin', compact('dashboardData', 'jumlahdash'));
    }
}
