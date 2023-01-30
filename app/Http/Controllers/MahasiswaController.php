<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Mahasiswa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    protected $mahasiswaModel;

    public function __construct(Mahasiswa $mahasiswa)
    {
        $this->mahasiswaModel = $mahasiswa;
    }

    public function index(): JsonResponse
    {
        try {
            $dataSemuaMahasiswa = $this->mahasiswaModel::All();
            return response()->json($dataSemuaMahasiswa, 200);
        } catch (Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function show($nim): JsonResponse
    {
        try {
            $dataTunggalMahasiswa = $this->mahasiswaModel::find($nim);
            return response()->json($dataTunggalMahasiswa, 200);
        } catch (Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'nim' => 'required|unique:mahasiswa',
                'nama' => 'required'
            ], [
                'nim.required' => 'Nomor Induk Mahasiswa wajib diisi',
                'nim.unique' => 'Nomor Induk Mahasiswa telah terdaftar',
                'nama.required' => 'Nama mahasiswa wajib diisi'
            ]);

            $this->mahasiswaModel::create([
                'nim' => $request->nim,
                'nama' => $request->nama,
            ]);

            return response()->json(['status' => 'Success to create mahasiswa'], 200);
        } catch (Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function update(Request $request, $nim): JsonResponse
    {
        try {
            $this->validate($request, [
                'nim' => "required|unique:mahasiswa,nim,{$nim},nim",
                'nama' => 'required'
            ], [
                'nim.required' => 'Nomor Induk Mahasiswa wajib diisi',
                'nim.unique' => 'Nomor Induk Mahasiswa telah terdaftar',
                'nama.required' => 'Nama mahasiswa wajib diisi'
            ]);

            $this->mahasiswaModel::where('nim', $nim)->update([
                'nim' => $request->nim,
                'nama' => $request->nama,
            ]);

            return response()->json(['status' => 'Success to update mahasiswa'], 200);
        } catch (Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function destroy($nim): JsonResponse
    {
        try {
            $this->mahasiswaModel::destroy($nim);
            return response()->json(['status' => 'Success to delete mahasiswa'], 200);
        } catch (Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
