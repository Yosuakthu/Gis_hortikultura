<x-layout>
    <x-slot:titel>{{ $titel }}</x-slot:titel>

    <div class="card">
        <div class="card-body">
            <div class="container mx-5 my-2">
                <form action="{{ route('import.geojson') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="geojson_file">GeoJSON File</label>
                        <input type="file" class="form-control @error('geojson_file') is-invalid @enderror" id="geojson_file" name="geojson_file" accept=".json,.geojson" required>
                        @error('geojson_file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama">Nama Pemilik</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanaman">Tanaman</label>
                                <input type="text" class="form-control" id="tanaman" name="tanaman" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lokasi">Nama Kebun</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="luas">Luas</label>
                                <input type="number" step="0.01" class="form-control" id="luas" name="luas" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="elevasi">Elevasi</label>
                                <input type="number" class="form-control" id="elevasi" name="elevasi" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_hp">Kontak Pemilik</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelompok">Kelompok Tani</label>
                                <input type="text" class="form-control" id="kelompok" name="kelompok" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="leader">Ketua Kelompok</label>
                                <input type="text" class="form-control" id="leader" name="leader" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_leader">Kontak Ketua</label>
                                <input type="text" class="form-control" id="no_leader" name="no_leader" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="al_leader">Alamat Ketua</label>
                                <input type="text" class="form-control" id="al_leader" name="al_leader" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="komoditi">Komoditi</label>
                                <input type="text" class="form-control" id="komoditi" name="komoditi" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="varietas">Varietas Tanaman</label>
                                <input type="text" class="form-control" id="varietas" name="varietas" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumb_bibit">Jumlah Tanaman</label>
                                <input type="number" class="form-control" id="jumb_bibit" name="jumb_bibit" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Import</button>
                    <a href="{{ route('csv.table') }}" class="btn btn-secondary">Kembali ke Tabel Data</a>
                </form>
            </div>
        </div>
    </div>

</x-layout>
