<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeoData;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = session('user');
         $total = GeoData::count();
          $totaluser = User::count();
        $totalCabe = GeoData::where('tanaman', 'cabe')->count();
        $totalTomat = GeoData::where('tanaman', 'tomat')->count();
         $totalTerong = GeoData::where('tanaman', 'Terong')->count();
        $totalKetimun = GeoData::where('tanaman', 'ketimun')->count();
         $totalBuncis = GeoData::where('tanaman', 'buncis')->count();
        $totalCaisin = GeoData::where('tanaman', 'caisin')->count();
        $jenisTanaman = DB::table('geo_data')
        ->select('tanaman', DB::raw('count(*) as total'))
        ->groupBy('tanaman')
        ->get();

        return view('admin.index', compact('user'),[
            'titel' => 'Dashboard',
            'totalTanaman' => $total,
            'tomat' => $totalTomat,
            'cabe' => $totalCabe,
            'terong' => $totalTerong,
            'ketimun' => $totalKetimun,
            'buncis' => $totalBuncis,
            'caisin' => $totalCaisin,
             'jenisTanaman' => $jenisTanaman,
             'totaluser' => $totaluser,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
