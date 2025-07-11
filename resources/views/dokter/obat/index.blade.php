<!-- resources/views/obat/index-dummy.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat') }}
                        </h2>

                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{route('dokter.obat.create')}}" class="btn btn-primary">Tambah Obat</a>
                        </div>
                    </header>

                    {{-- lihat obat terhapus --}}
                    <div class="mt-4">
                        <a href="{{ route('dokter.obat.bin') }}" class="text-sm text-blue-600 hover:underline">
                            Lihat Obat Terhapus
                        </a>
                    </div>

                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Kemasan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obats as $obat )
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $obat->id }}</th>
                                <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                <td class="align-middle text-start">{{ $obat->harga }}</td>
                                <td class="flex items-center gap-3">
                                    <a href="{{route('dokter.obat.edit', $obat->id  )}}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{route('dokter.obat.destroy', $obat->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
