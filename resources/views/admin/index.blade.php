<x-layout>

    <x-slot:titel>{{$titel}}</x-slot:titel>
    <div class="card">
        <div class="card-body">
    <h3>Selamat Datang {{optional($user)->name}}</h3>

</div>
</div>
</x-layout>
