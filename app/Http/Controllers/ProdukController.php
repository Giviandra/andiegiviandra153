<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Services\ProdukService;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    protected $service;

    public function __construct(ProdukService $service) {
        $this->service = $service;
    }

    public function index() {
        return response()->json($this->service->getAll());
    }

    public function store(StoreProdukRequest $request) {
        try {
            $data = $this->service->createProduk($request->validated());
            return response()->json(['msg' => 'Berhasil tambah produk', 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id) {
        $data = $this->service->updateProduk($id, $request->all());
        return response()->json(['msg' => 'Berhasil ubah data', 'data' => $data]);
    }

    public function destroy($id) {
        $this->service->deleteProduk($id);
        return response()->json(['msg' => 'Data dihapus']);
    }
}