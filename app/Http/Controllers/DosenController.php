<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Dosen;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    protected $dosenModel;

    public function __construct(Dosen $dosen)
    {
        $this->dosenModel = $dosen;
    }

    public function index(): JsonResponse
    {
        try {
            $dataSemuaDosen = $this->dosenModel::All();
            return response()->json($dataSemuaDosen, 200);
        } catch (Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function show($nid): JsonResponse
    {
        try {
            $dataTunggalDosen = $this->dosenModel::find($nid);
            return response()->json($dataTunggalDosen, 200);
        } catch (Throwable $th) {
            return response()->json($th);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'nid' => 'required|unique:Dosen',
                'nama' => 'required'
            ], [
                'nid.required' => 'Nomor Induk Dosen wajib diisi',
                'nid.unique' => 'Nomor Induk Dosen telah terdaftar',
                'nama.required' => 'Nama dosen wajib diisi'
            ]);

            $this->dosenModel::create([
                'nid' => $request->nid,
                'nama' => $request->nama,
            ]);

            return response()->json(['status' => 'Success to create Dosen'], 200);
        } catch (Throwable $th) {
            return response()->json($th);
        }
    }

    public function update(Request $request, $nid): JsonResponse
    {
        try {
            $this->validate($request, [
                'nid' => "required|unique:dosen,nid,{$nid},nid",
                'nama' => 'required'
            ], [
                'nid.required' => 'Nomor Induk Dosen wajib diisi',
                'nid.unique' => 'Nomor Induk Dosen telah terdaftar',
                'nama.required' => 'Nama dosen wajib diisi'
            ]);

            $this->dosenModel::where('nid', $nid)->update([
                'nid' => $request->nid,
                'nama' => $request->nama,
            ]);

            return response()->json(['status' => 'Success to update Dosen'], 200);
        } catch (Throwable $th) {
            return response()->json($th);
        }
    }

    public function destroy($nid): JsonResponse
    {
        try {
            $this->dosenModel::destroy($nid);
            return response()->json(['status' => 'Success to delete Dosen'], 200);
        } catch (Throwable $th) {
            return response()->json($th);
        }
    }
}
