<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use DB;

class fetchingApi extends Controller
{
    public function fetchingApiFromFastPrint(Request $request)
    {
        $response = Http::asForm()->post('https://recruitment.fastprint.co.id/tes/api_tes_programmer', [
            'username' => 'tesprogrammer090623C21',
            'password' => 'abbce956095d68e6f75bc05a5f08e1d9',

        ]);

        $resp = $response['data'];
        foreach ($resp as $item) {
            $data = [
                'id_produk' => $item['id_produk'],
                'nama_produk' => $item['nama_produk'],
                'kategori' => $item['kategori'],
                'harga' => $item['harga'],
                'no' => $item['no'],
                'status' => $item['status'],

            ];

            // Set other columns as needed
            DB::table('crudBarang')->insert($data);
        }

        return "Data saved to the database.";
    }
}


