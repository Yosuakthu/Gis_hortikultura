<x-layout>

    <x-slot:titel>{{$titel}}</x-slot:titel>
    <div class="card">
        <div class="card-body">

            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
            <button id="importdata" class="btn btn-success mb-3">Tambah Data</button>
            <table id="datacsv" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Nama Kebun</th>
                        <th>Luas</th>
                        <th>Elevasi</th>
                        <th>Kelompok Tani</th>
                        <th>Ketua Kelompok</th>
                        <th>No HP Ketua</th>
                        <th>Alamat Ketua</th>
                        <th>Komoditi</th>
                        <th>Varietas</th>
                        <th>Jenis Tanaman</th>
                        <th>Jumlah Bibit</th>
                        <th>GeoData</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <script type="text/javascript">
                $(function () {

                  var table = $('#datacsv').DataTable({
                    processing: true,
                    serverSide: true,
                     ajax: "{{ route('csv.table') }}",
                    scrollY: '50vh',
                    scrollX: true,
                    scrollCollapse: true,
                    paging: true,
                      columns: [
                          {data: 'nama', name: 'nama'},
                          {data: 'no_hp', name: 'no_hp'},
                          {data: 'lokasi', name: 'lokasi'},
                          {data: 'luas', name: 'luas'},
                          {data: 'elevasi', name: 'elevasi'},
                          {data: 'kelompok', name: 'kelompok'},
                          {data: 'leader', name: 'leader'},
                          {data: 'al_leader', name: 'al_leader'},
                          {data: 'no_leader', name: 'no_leader'},
                          {data: 'komoditi', name: 'komoditi'},
                          {data: 'varietas', name: 'varietas'},
                          {data: 'tanaman', name: 'tanaman'},
                          {data: 'jumb_bibit', name: 'jumb_bibit'},
                          {data: 'geojson_path', name: 'geojson_path'},
                          {data: 'action', name: 'action', orderable: false, searchable: false},
                      ]
                  });

                });

                $('#importdata').on('click', function () {
                window.location.href = '{{ route("import-geo.form") }}';

            });


        $('#datacsv').on('click', '.delete', function () {
            var id = $(this).data('id');
            if(confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url: '/showCsvTable/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        if (result.success) {
                            alert(result.success);
                            window.location.href = "{{ route('csv.table') }}";
                        } else if (result.error) {
                            alert(result.error);
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            }
        });

              </script>
</div>
</div>
</x-layout>
