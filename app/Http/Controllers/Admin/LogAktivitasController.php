<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $logs = LogAktivitas::with('user')
            ->when($request->search, fn ($q) => $q->where('aktivitas', 'like', "%{$request->search}%"))
            ->latest('timestamp')
            ->paginate(20)
            ->withQueryString();

        return view('admin.log.index', compact('logs'));
    }
}
