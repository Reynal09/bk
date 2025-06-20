<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Janji Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Buat Janji Periksa') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Atur jadwal pertemuan dengan dokter untuk mendapatkan layanan konsultasi dan pemeriksaan kesehatan sesuai kebutuhan Anda.') }}
                            </p>
                        </header>

                        <form class="mt-6" action="">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nomor Rekam Medis</label>
                                <input type="text" class="rounded form-control" id="formGroupExampleInput"
                                    placeholder="Example input" value="2025001-1210" readonly>
                            </div>
                            <div class="form-group">
                                <label for="dokterSelect">Dokter</label>
                                <select class="form-control" id="dokterSelect" required>
                                    <option>Pilih Dokter</option>
                                    <option>Dr. Maya Sari - Spesialis Mata | Jumat, 08:00 - 12:00</option>
                                    <option>Dr. Ahmad Santoso - Spesialis Jantung | Senin, 08:00 - 12:00</option>
                                    <option>Dr. Siti Nurhaliza - Spesialis Anak | Selasa, 09:00 - 13:00</option>
                                    <option>Dr. Budi Hartono - Spesialis Penyakit Dalam | Rabu, 08:00 - 12:00</option>
                                    <option>Dr. Ratna Dewi - Spesialis Kandungan | Kamis, 14:00 - 18:00</option>
                                    <option>Dr. Eko Prasetyo - Spesialis Orthopedi | Jumat, 09:00 - 15:00</option>
                                    <option>Dr. Hendra Wijaya - Spesialis THT | Sabtu, 08:00 - 12:00</option>
                                    <option>Dr. Indira Putri - Spesialis Saraf | Senin, 13:00 - 17:00</option>
                                    <option>Dr. Dian Sari - Spesialis Kulit | Selasa, 14:00 - 18:00</option>
                                    <option>Dr. Rizki Pratama - Spesialis Bedah | Rabu, 13:00 - 17:00</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <textarea class="form-control" id="keluhan" rows="3" required></textarea>
                            </div>
                            <div class="flex items-center gap-4">
                                <button type="submit" class="btn btn-primary">Submit</button>

                                @if (session('status') === 'janji-periksa-created')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Berhasil Dibuat.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>