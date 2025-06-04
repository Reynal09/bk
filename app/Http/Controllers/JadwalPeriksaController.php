<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    // protected $fillable = [
    //     'id_dokter',
    //     'hari',
    //     'jam_mulai',
    //     'jam_selesai',
    //     'status' (boolean)
    // ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', auth()->id())
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();
        return view('dokter.jadwal-periksa.index', compact('jadwalPeriksas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'id_dokter' => 'required|exists:users,id',
            'hari' => 'required|string|max:10',
            // 'jam_mulai' => 'required|date_format:H:i',
            // 'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // ceck if the doctor already has a schedule for the same day and time
        $existingSchedule = JadwalPeriksa::where('id_dokter', auth()->id())
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
            })
            ->exists();
        if ($existingSchedule) {
            return redirect()->back()->withErrors(['jadwal' => 'Jadwal periksa untuk hari dan jam ini sudah ada.']);
        }

        // Assuming the authenticated user is a doctor
        $request->merge(['id_dokter' => auth()->id(), 'status' => false]);

        JadwalPeriksa::create($request->all());

        return redirect()->route('dokter.jadwal-periksa.index')->with('success', 'Jadwal Periksa berhasil dibuat.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPeriksa $jadwalPeriksa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalPeriksa $jadwalPeriksa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPeriksa $jadwalPeriksa)
    {
        //
    }

    public function toggleStatus(JadwalPeriksa $jadwalPeriksa)
    {
        // jadwal periksa untuk user ini hanya boleh 1 yang aktif, jika ada yang aktif maka nonaktifkan
        $existingActiveSchedule = JadwalPeriksa::where('id_dokter', auth()->id())
            ->where('status', true)
            ->get();
        // if ($existingActiveSchedule && $existingActiveSchedule->id !== $jadwalPeriksa->id) {
        if ($existingActiveSchedule) {
            foreach ($existingActiveSchedule as $schedule) {
                $schedule->status = false;
                $schedule->save();
            }
        }
        // Toggle the status of the selected schedule
        $jadwalPeriksa->status = !$jadwalPeriksa->status;


        // $jadwalPeriksa->status = !$jadwalPeriksa->status;
        $jadwalPeriksa->save();

        return redirect()->route('dokter.jadwal-periksa.index')->with('success', 'Status jadwal periksa berhasil diubah.');
    }
}
