<?php

namespace App\Services;

use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukService
{
    public function getAll() {
        return Produk::all();
    }

    public function createProduk(array $data) {
        return DB::transaction(fn() => Produk::create($data));
    }

    public function updateProduk($id, array $data) {
        $produk = Produk::findOrFail($id);
        $produk->update($data);
        return $produk;
    }

    public function deleteProduk($id) {
        return Produk::findOrFail($id)->delete();
    }
}