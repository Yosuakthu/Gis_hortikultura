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
                        <th>FID Garis P</th>
                        <th>FID Zona L</th>
                        <th>Objectid</th>
                        <th>Jenis Zona</th>
                        <th>Shape Leng</th>
                        <th>Shape Area</th>
                        <th>PSTDDEV</th>
                        <th>STDDEV</th>
                        <th>Mean</th>
                        <th>Count</th>
                        <th>Min</th>
                        <th>Max</th>
                        <th>No Zona</th>
                        <th>Rp Bulat</th>
                        <th>Sum Nilai</th>
                        <th>Range Nilai</th>
                        <th>Rp Bulat 1</th>
                        <th>Sum Nilai 1</th>
                        <th>Range Nilai 1</th>
                        <th>Rp 1</th>
                        <th>Rp 2</th>
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
                          {data: 'fid_garisp', name: 'fid_garisp'},
                          {data: 'fid_zona_l', name: 'fid_zona_l'},
                          {data: 'objectid', name: 'objectid'},
                          {data: 'jenis_zona', name: 'jenis_zona'},
                          {data: 'shape_leng', name: 'shape_leng'},
                          {data: 'shape_area', name: 'shape_area'},
                          {data: 'pstddev', name: 'pstddev'},
                          {data: 'stddev', name: 'stddev'},
                          {data: 'mean', name: 'mean'},
                          {data: 'count', name: 'count'},
                          {data: 'min', name: 'min'},
                          {data: 'max', name: 'max'},
                          {data: 'nozone', name: 'nozone'},
                          {data: 'rpbulat', name: 'rpbulat'},
                          {data: 'sum_nilai', name: 'sum_nilai'},
                          {data: 'range_nila', name: 'range_nila'},
                          {data: 'rpbulat_1', name: 'rpbulat_1'},
                          {data: 'sum_nilai1', name: 'sum_nilai1'},
                          {data: 'range_ni_1', name: 'range_ni_1'},
                          {data: 'rp_1', name: 'rp_1'},
                          {data: 'rp_2', name: 'range_nila'},
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
