<x-layout>

    <x-slot:titel>{{$titel}}</x-slot:titel>
    <div class="card">
        <div class="card-body">
                <h2>Edit User</h2>
                <form action="{{ url('pengguna/' . $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="level_id" class="form-label">Level Akses</label>
                        <select class="form-select" id="level_id" name="level_id" required>
                            <option value="" disabled>Pilih Level Akses</option>
                            <option value="1" {{ $user->level_id == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ $user->level_id == 2 ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>


</div>
</div>
</x-layout>
