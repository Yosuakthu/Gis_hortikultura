<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeoData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GeoDataImport;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PetaController extends Controller
{

    public function usrpeta()
    {
        return view('usrpeta',['titel' => 'Peta Zona']);
    }

    public function peta()
    {
        return view('peta',['titel' => 'Peta Zona']);
    }

    public function showForm()
    {
        return view('import_csv',['titel' => 'Import Data Zonah Nilai Tanah']);
    }

    //Star Note  https://docs.google.com/document/d/e/2PACX-1vTjuREUPY0Mf39ulOGH_Eh5DQMMm6xmsZXDC7vZ7vU1MnjaZ-y3vozqwanhRrBCzdb1SV-pyG1ttEyj/pub
    public function showCsvTable(Request $request)
    {
        if ($request->ajax()) {
            $data = GeoData::query();
            return DataTables::of($data)
            ->addColumn('action', function($row){
                $editBtn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id="'.$row->id.'">Edit</a>';
                $deleteBtn = '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                return $deleteBtn . ' ' .$editBtn;
            })
            ->addIndexColumn()
            ->make(true);
        }
        return view('datacsv',['titel' => 'Data Zonah Nilai Tanah']);
    }
    // End Note

    // Star Note  https://docs.google.com/document/d/e/2PACX-1vTn1Yyueno4u0I1PnHbzgBrrSb2bWNuIX8wAR0mS1Ll47f3EXZ9bPRK_CPIsYfr2IEUtenpdR5KEfz9/pub
    public function getGeoJson()
    {
      // Ambil semua data dari database
$geoDataList = GeoData::all();

// Struktur dasar GeoJSON
$geojsonArray = [
    "type" => "FeatureCollection",
    "features" => []
];

foreach ($geoDataList as $geoData) {
    // Ambil path file GeoJSON dari database
    $filePath = $geoData->geojson_path;

    // Periksa apakah file ada di storage
    if (Storage::exists($filePath)) {
        $geojsonContent = Storage::get($filePath);
        $geojsonDecoded = json_decode($geojsonContent, true);

        // Periksa apakah file valid dan memiliki fitur
        if (isset($geojsonDecoded['features'])) {
            foreach ($geojsonDecoded['features'] as &$feature) {
                // Tambahkan data dari database ke dalam properties GeoJSON
                $feature['properties']['tanaman'] = $geoData->tanaman;
                $feature['properties']['lokasi'] = $geoData->lokasi;
                $feature['properties']['luas'] = $geoData->luas;
                $feature['properties']['elevasi'] = $geoData->elevasi;
                $feature['properties']['no_hp'] = $geoData->no_hp;
                $feature['properties']['kelompok'] = $geoData->kelompok;
                $feature['properties']['leader'] = $geoData->leader;
                $feature['properties']['no_leader'] = $geoData->no_leader;
                $feature['properties']['al_leader'] = $geoData->al_leader;
                $feature['properties']['komoditi'] = $geoData->komoditi;
                $feature['properties']['varietas'] = $geoData->varietas;
                $feature['properties']['jumb_bibit'] = $geoData->jumb_bibit;

                // Tambahkan fitur yang sudah diperbarui ke dalam GeoJSON utama
                $geojsonArray['features'][] = $feature;
            }
        }
    }
}

// Kembalikan dalam format JSON
return response()->json($geojsonArray);

    }

    public function showFormGeo()
    {
        return view('import_geojson',['titel' => 'Import Data ']);
    }

    public function importGeoJSON(Request $request)
    {

try {
    $request->validate([
        'geojson_file' => 'required|file|mimes:json,geojson',
        'nama' => 'required|string',
        'tanaman' => 'required|string',
        'lokasi' => 'nullable|string',
        'luas' => 'nullable|numeric',
        'elevasi' => 'required|numeric',
        'no_hp' => 'nullable|string',
        'kelompok' => 'nullable|string',
        'leader' => 'nullable|string',
       'no_leader' => 'nullable|string',
        'al_leader' => 'nullable|string',
        'komoditi' => 'required|string',
        'varietas' => 'required|string',
        'jumb_bibit' => 'nullable|integer',
    ]);
} catch (ValidationException $e) {
    dd($e->errors());
}




        // Simpan file
        $filePath = $request->file('geojson_file')->store('geojson_files');



        // Simpan data ke database
        GeoData::create([
            'nama' => $request->nama,
            'tanaman' => $request->tanaman,
            'lokasi' => $request->lokasi,
            'luas' => $request->luas,
            'elevasi' => $request->elevasi,
            'no_hp' => $request->no_hp,
            'kelompok' => $request->kelompok,
            'leader' => $request->leader,
            'no_leader' => $request->no_leader,
            'al_leader' => $request->al_leader,
            'komoditi' => $request->komoditi,
            'varietas' => $request->varietas,
            'jumb_bibit' => $request->jumb_bibit,
            'geojson_path' => $filePath
        ]);

        return redirect()->route('csv.table')->with('success', 'Data berhasil diimport!');
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
        $data = GeoData::find($id);
        if ($data) {
            $data->delete();
            return response()->json(['success' => 'Data deleted successfully.']);
        } else {
            return response()->json(['error' => 'Data not found.'], 404);
        }
    }
}
