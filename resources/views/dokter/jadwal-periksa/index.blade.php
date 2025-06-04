<!-- resources/views/jadwal-periksa/index-dummy.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Jadwal Periksa') }}
                        </h2>

                        <div class="flex-col items-center justify-center text-center">
                            <a type="button" class="btn btn-primary" href="{{ route('dokter.jadwal-periksa.create') }}">Tambah Jadwal Periksa</a>
                        </div>
                    </header>

                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Mulai</th>
                                <th scope="col">Selesai</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalPeriksas as $jadwal)
                                <tr>
                                    <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                    <td class="align-middle text-start">{{ $jadwal->hari }}</td>
                                    <td class="align-middle text-start">{{ $jadwal->jam_mulai }}</td>
                                    <td class="align-middle text-start">{{ $jadwal->jam_selesai }}</td>
                                    <td class="align-middle text-start">
                                        <span class="badge badge-pill {{ $jadwal->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $jadwal->status ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-start">
                                        <form action="{{ route('dokter.jadwal-periksa.toggle-status', $jadwal) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-{{ $jadwal->status ? 'danger' : 'success' }} btn-sm">
                                                {{ $jadwal->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <tr>
                                <th scope="row" class="align-middle text-start">1</th>
                                <td class="align-middle text-start">Senin</td>
                                <td class="align-middle text-start">08.00</td>
                                <td class="align-middle text-start">12.00</td>
                                <td class="align-middle text-start">
                                    <span class="badge badge-pill badge-success">Aktif</span>
                                </td>
                                <td class="align-middle text-start">
                                    <button type="button" class="btn btn-success btn-sm">Aktifkan</button>
                                    <button type="button" class="btn btn-danger btn-sm">Nonaktifkan</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="align-middle text-start">2</th>
                                <td class="align-middle text-start">Selasa</td>
                                <td class="align-middle text-start">13.00</td>
                                <td class="align-middle text-start">17.00</td>
                                <td class="align-middle text-start">
                                    <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                </td>
                                <td class="align-middle text-start">
                                    <button type="button" class="btn btn-success btn-sm">Aktifkan</button>
                                    <button type="button" class="btn btn-danger btn-sm">Nonaktifkan</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="align-middle text-start">3</th>
                                <td class="align-middle text-start">Rabu</td>
                                <td class="align-middle text-start">09.00</td>
                                <td class="align-middle text-start">15.00</td>
                                <td class="align-middle text-start">
                                    <span class="badge badge-pill badge-success">Aktif</span>
                                </td>
                                <td class="align-middle text-start">
                                    <button type="button" class="btn btn-success btn-sm">Aktifkan</button>
                                    <button type="button" class="btn btn-danger btn-sm">Nonaktifkan</button>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
