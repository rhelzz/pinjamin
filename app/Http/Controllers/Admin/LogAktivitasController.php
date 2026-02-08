<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $logs = LogAktivitas::with('user')
            ->when($request->search, fn ($q) => $q->where('aktivitas', 'like', "%{$request->search}%"))
            ->orderBy($sortBy, $sortDirection)
            ->paginate(15)
            ->withQueryString();

        return view('admin.log.index', compact('logs'));
    }
}
