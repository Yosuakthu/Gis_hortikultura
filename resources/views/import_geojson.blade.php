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
                    <button type="submit" class="btn btn-primary">Import</button>
                    <a href="{{ route('csv.table') }}" class="btn btn-secondary">Kembali ke Tabel Data</a>
                </form>
            </div>
        </div>
    </div>
</x-layout>
