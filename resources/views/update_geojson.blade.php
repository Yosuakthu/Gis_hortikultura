<x-layout>
    <x-slot:titel>Edit Data GeoJSON</x-slot:titel>

    <div class="card">
        <div class="card-body">
            <div class="container mx-5 my-2">
                <form action="{{ route('geojson.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="geojson_file">GeoJSON File (Kosongkan jika tidak diubah)</label>
                        <input type="file" class="form-control @error('geojson_file') is-invalid @enderror" name="geojson_file" accept=".json,.geojson">
                        @error('geojson_file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if (!empty($data->geojson_path))
        <small class="form-text text-muted mt-2">
            File saat ini: 
            <a href="{{ asset('storage/' . $data->geojson_path) }}" target="_blank" download>
                {{ basename($data->geojson_path) }}
            </a>
        </small>
    @else
        <small class="form-text text-muted mt-2">Belum ada file GeoJSON diupload.</small>
    @endif
                    </div>

                    {{-- Semua inputan data --}}
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama', $data->nama) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="tanaman">Tanaman</label>
                            <input type="text" class="form-control" name="tanaman" value="{{ old('tanaman', $data->tanaman) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi', $data->lokasi) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="luas">Luas</label>
                            <input type="number" step="0.01" class="form-control" name="luas" value="{{ old('luas', $data->luas) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="elevasi">Elevasi</label>
                            <input type="number" class="form-control" name="elevasi" value="{{ old('elevasi', $data->elevasi) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="kelompok">Kelompok</label>
                            <input type="text" class="form-control" name="kelompok" value="{{ old('kelompok', $data->kelompok) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="leader">Leader</label>
                            <input type="text" class="form-control" name="leader" value="{{ old('leader', $data->leader) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="no_leader">No Leader</label>
                            <input type="text" class="form-control" name="no_leader" value="{{ old('no_leader', $data->no_leader) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="al_leader">Alamat Leader</label>
                            <input type="text" class="form-control" name="al_leader" value="{{ old('al_leader', $data->al_leader) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="komoditi">Komoditi</label>
                            <input type="text" class="form-control" name="komoditi" value="{{ old('komoditi', $data->komoditi) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="varietas">Varietas</label>
                            <input type="text" class="form-control" name="varietas" value="{{ old('varietas', $data->varietas) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="jumb_bibit">Jumlah Bibit</label>
                            <input type="number" class="form-control" name="jumb_bibit" value="{{ old('jumb_bibit', $data->jumb_bibit) }}" required>
                        </div>
                    </div>

                    <div class="form-group mt-3">
    <label for="images">Upload Gambar (bisa lebih dari satu)</label>
    <input type="file" class="form-control" name="images[]" multiple accept="image/*">

         @if (!empty($data->images) && count($data->images) > 0)
        <div class="mt-2">
            <strong>Gambar Saat Ini:</strong>
            <div class="row">
               @foreach ($data->images as $img)
    @if(!empty($img))
    <div class="col-md-3 mb-2 position-relative" style="max-width: 150px;">
        <img src="{{ asset('storage/images/' . $img) }}" class="img-thumbnail w-100" alt="image">
        <div class="form-check position-absolute" style="top:5px; right:5px;">
            <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $img }}" id="remove_{{ $loop->index }}">
            <label class="form-check-label text-danger" for="remove_{{ $loop->index }}"></label>
        </div>
    </div>
    @endif
@endforeach
            </div>
        </div>
    @endif
                    </div>


                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                    <a href="{{ route('csv.table') }}" class="btn btn-secondary mt-3">Kembali ke Tabel Data</a>
                </form>
            </div>
        </div>
    </div>
</x-layout>
