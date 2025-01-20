<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeoData;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
use League\Csv\Statement;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GeoDataImport;
use Yajra\DataTables\Facades\DataTables;
class PetaController extends Controller
{

    public function usrpeta()
    {
        return view('usrpeta',['titel' => 'Peta Zonah Nilai Tanah']);
    }

    public function peta()
    {
        return view('peta',['titel' => 'Peta Zonah Nilai Tanah']);
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
        try {
            $geoData = GeoData::all();

            Log::info('GeoData:', $geoData->toArray()); // Log data dari database

            $features = $geoData->map(function($item) {

                $cleanRpbulat = str_replace(['Rp.', '.'], '', $item->rpbulat); // Hapus Rp. dan titik
                $rpbulat = (int)$cleanRpbulat; // Konversi ke integer

                $color = 'green'; // Default warna
                if ($rpbulat >= 1000000) {
                    $color = 'Coral';
                } elseif ($rpbulat >= 500000) {
                    $color = 'lime';
                }elseif ($rpbulat >= 300000) {
                    $color = 'yellow';
                } elseif ($rpbulat >= 150000) {
                    $color = 'orange';
                } elseif ($rpbulat >= 100000) {
                    $color = 'red';
                } elseif ($rpbulat >= 50000) {
                $color = '#90EE90';
                } elseif ($rpbulat >= 1000) {
                    $color = 'Teal';
                }
                return [
                    'type' => 'Feature',
                    'properties' => [
                        'FID_garisp' => $item->fid_garisp,
                        'FID_Zona_L' => $item->fid_zona_l,
                        'OBJECTID' => $item->objectid,
                        'JENIS_ZONA' => $item->jenis_zona,
                        'Shape_Leng' => $item->shape_leng,
                        'Shape_Area' => $item->shape_area,
                        'PSTDDEV' => $item->pstddev,
                        'STDDEV' => $item->stddev,
                        'MEAN' => $item->mean,
                        'COUNT_' => $item->count,
                        'MIN_' => $item->min,
                        'MAX_' => $item->max,
                        'NOZONE' => $item->nozone,
                        'RPBULAT' => $item->rpbulat,
                        'SUM_Nilai_' => $item->sum_nilai,
                        'RANGE_Nila' => $item->range_nila,
                        'RPBULAT_1' => $item->rpbulat_1,
                        'SUM_Nilai1' => $item->sum_nilai1,
                        'RANGE_Ni_1' => $item->range_ni_1,
                        'RP_1' => $item->rp_1,
                        'rp_2' => $item->rp_2,
                        'color'=> $color
                    ],
                    'geometry' => [
                        'type' => 'MultiPolygon',
                        'coordinates' => json_decode($item->geometry)
                    ]
                ];
            });

            $geoJson = [
                'type' => 'FeatureCollection',
                'features' => $features
            ];

            Log::info('GeoJSON:', $geoJson);

            return response()->json($geoJson);
        } catch (\Exception $e) {
            Log::error('Error fetching GeoJSON:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error fetching GeoJSON'], 500);
        }
    }

    public function showFormGeo()
    {
        return view('import_geojson',['titel' => 'Import Data ']);
    }

    // Star Note  https://docs.google.com/document/d/e/2PACX-1vRXC9Z1opkAmK_e9j6UY5-y7oFuXB-ZcwTQS-sgkFahhdwkm5f4nN7MAWRoV9JaAVhPgE5nxw3C_9qY/pub
    public function importGeoJSON(Request $request)
    {
        $request->validate([
            'geojson_file' => 'required|file|mimes:json,geojson|max:5048',
        ]);

        try {
            // Membaca file GeoJSON
            $fileContent = file_get_contents($request->file('geojson_file')->getPathname());
            $geoJsonData = json_decode($fileContent, true);

            if (!$geoJsonData || !isset($geoJsonData['features'])) {
                return redirect()->back()->with('error', 'File GeoJSON tidak valid.');
            }

            // Iterasi melalui features dan menyimpan ke database
            foreach ($geoJsonData['features'] as $feature) {
                $properties = $feature['properties'] ?? [];
                $geometry = $feature['geometry'] ?? null;

                if (!$geometry || $geometry['type'] !== 'MultiPolygon') {
                    Log::warning('Geometry tidak valid atau bukan MultiPolygon', ['feature' => $feature]);
                    continue; // Lewati jika geometry tidak valid
                }

                GeoData::create([
                    'fid_garisp'   => $properties['FID_garisp'] ?? null,
                    'fid_zona_l'   => $properties['FID_Zona_L'] ?? null,
                    'objectid'     => $properties['OBJECTID'] ?? null,
                    'jenis_zona'   => $properties['JENIS_ZONA'] ?? null,
                    'shape_leng'   => $properties['Shape_Leng'] ?? null,
                    'shape_area'   => $properties['Shape_Area'] ?? null,
                    'pstddev'      => $properties['PSTDDEV'] ?? null,
                    'stddev'       => $properties['STDDEV'] ?? null,
                    'mean'         => $properties['MEAN'] ?? null,
                    'count'        => $properties['COUNT_'] ?? null,
                    'min'          => $properties['MIN_'] ?? null,
                    'max'          => $properties['MAX_'] ?? null,
                    'nozone'       => $properties['NOZONE'] ?? null,
                    'rpbulat'      => $properties['RPBULAT'] ?? null,
                    'sum_nilai'    => $properties['SUM_Nilai_'] ?? null,
                    'range_nila'   => $properties['RANGE_Nila'] ?? null,
                    'rpbulat_1'    => $properties['RPBULAT_1'] ?? null,
                    'sum_nilai1'   => $properties['SUM_Nilai1'] ?? null,
                    'range_ni_1'   => $properties['RANGE_Ni_1'] ?? null,
                    'rp_1'         => $properties['RP_1'] ?? null,
                    'rp_2'         => $properties['rp_2'] ?? null,
                    'geometry'     => json_encode($geometry['coordinates']), // Menyimpan koordinat sebagai JSON
                ]);
            }

            return redirect()->route('csv.table')->with('success', 'File GeoJSON berhasil diimpor.');
        } catch (\Exception $e) {
            Log::error('Error importing GeoJSON:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor GeoJSON.');
        }
    }

// End Note



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
