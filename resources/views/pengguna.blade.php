<x-layout>

    <x-slot:titel>{{$titel}}</x-slot:titel>
    <div class="card">
        <div class="card-body">

            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
            <button id="tambahPenggunaBtn" class="btn btn-success mb-3">Tambah Pengguna</button>
            <table id="pengguna" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Level Akses</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <script type="text/javascript">
                $(function () {

                var table = $('#pengguna').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pengguna') }}",
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'level_name', name: 'level_name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                  // Handle delete button click
        $('#pengguna').on('click', '.delete', function () {
            var id = $(this).data('id');
            if(confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url: '/pengguna/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        if (result.success) {
                            table.ajax.reload();
                            alert(result.success);
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

        // Handle edit button click
        $('#pengguna').on('click', '.edit', function () {
                var id = $(this).data('id');
                // Here you would typically open a modal or redirect to an edit page
                window.location.href = '/pengguna/' + id + '/edit';
            });

            // Handle tambah pengguna button click
            $('#tambahPenggunaBtn').on('click', function () {
                window.location.href = '{{ route("pengguna.create") }}';
            });

                });
              </script>
</div>
</div>
</x-layout>
