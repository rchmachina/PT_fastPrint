<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use DB;

class storeController extends Controller
{
    public function index()
    {
        $barangAvaibles = DB::table('crudBarang')->where('status',"bisa dijual")->orderBy('no', 'asc')->simplePaginate(10);;

        return view('tableView', compact('barangAvaibles'));
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'noProduk' => 'required|numeric',
            'nameProduk' => 'required|string',
            'harga' => 'required|numeric',
            'kategori' => 'required|string',
            'ketersediaan' =>'required|string'
        ]);

        $inserDatabase =[
            'no' => $validatedData['noProduk'],
            'nama_produk' => $validatedData['nameProduk'],
            'harga' => $validatedData['harga'],
            'kategori' => $validatedData['kategori'],
            'status' => $validatedData['ketersediaan']
        ];

        DB::table('crudBarang')->insert($inserDatabase);
        return redirect("/")->with('message', 'data added');;
    }


    public function delete($idBarang)
    {
        DB::table('crudBarang')->where('id_produk',$idBarang)->delete();
        return redirect("/")->with('message', 'barang terhapus');;;
    }


    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'noProduk' => 'required|numeric',
            'nameProduk' => 'required|string',
            'harga' => 'required|numeric',
            'kategori' => 'required|string',
            'id' => 'required|numeric',
        ]);

        $insertDatabase =[
            'no' => $validatedData['noProduk'],
            'nama_produk' => $validatedData['nameProduk'],
            'harga' => $validatedData['harga'],
            'kategori' => $validatedData['kategori'],
            'status' => 'bisa dijual',
        ];

        DB::table('crudBarang')->where('id_produk', $request->id)->update($insertDatabase);
        return redirect("/")->with('message', 'data updated');;
    }



    public function destroy($id)
    {
      
    }
}
