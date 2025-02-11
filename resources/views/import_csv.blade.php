<x-layout>

    <x-slot:titel>{{$titel}}</x-slot:titel>
    <div class="card">
        <div class="card-body">
    <div class="container mx-5 my-2">
        <form action="{{ route('import-csv.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="csv_file">CSV file</label>
                <input type="file" class="form-control" id="csv_file" name="csv_file" required>
            </div>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div>
</div>
</div>
</div>
</x-layout>

