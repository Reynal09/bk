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
                            {{ __('Daftar Obat Terhapus') }}
                        </h2>
                    </header>

                    {{-- link to obat index --}}
                    <div class="mt-4">
                        <a href="{{ route('dokter.obat.index') }}" class="text-sm text-blue-600 hover:underline">
                            Kembali ke Daftar Obat
                        </a>
                    </div>

                    {{-- success flash message, auto hide in 3s with alpine --}}
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mt-4">
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif
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
                                   <form action="{{route('dokter.obat.restore', $obat->id)}}" method="POST">
                                       @csrf
                                       @method('PATCH')
                                       <button type="submit" class="btn btn-success btn-sm">Restore</button>
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
