<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\Jenis;
use Exception;

class HargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uoms = Jenis::select('uom')
                       ->whereNotNull('uom')
                       ->distinct()
                       ->pluck('uom');

        $mata_uangs = Jenis::select('mata_uang')
                       ->whereNotNull('mata_uang')
                       ->distinct()
                       ->pluck('mata_uang');         

        return view('data.harga', compact('uoms','mata_uangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data dengan kolom optional, termasuk mata_uang
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255',
            'harga' => 'required|numeric|min:1',
            'mata_uang' => 'required|string|max:10', 
            'uom' => 'required|string|max:255',
            'vendor' => 'required|string|max:255',
        ]);

        try {
            // Cari record yang ada
            $sparepart = Sparepart::where('nama_barang', $validatedData['nama_barang'])
                                ->where('kode_barang', $validatedData['kode_barang'])
                                ->first();

            if ($sparepart) {
                // Jika record ada, perbarui data
                $sparepart->harga = $validatedData['harga'] ?? $sparepart->harga;
                $sparepart->mata_uang = $validatedData['mata_uang'] ?? $sparepart->mata_uang;
                $sparepart->uom = $validatedData['uom'] ?? $sparepart->uom;
                $sparepart->vendor = $validatedData['vendor'] ?? $sparepart->vendor;
                $sparepart->save();
            } else {
                // Jika record tidak ada, buat record baru
                Sparepart::create([
                    'nama_barang' => $validatedData['nama_barang'],
                    'kode_barang' => $validatedData['kode_barang'],
                    'harga' => $validatedData['harga'] ?? 0,
                    'mata_uang' => $validatedData['mata_uang'] ?? null,
                    'uom' => $validatedData['uom'] ?? null,
                    'vendor' => $validatedData['vendor'] ?? null,
                ]);
            }

            return redirect()->route('harga.create')->with('success', 'Data berhasil disimpan.');

        } catch (Exception $e) {
            return redirect()->route('harga.create')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
