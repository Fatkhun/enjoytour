<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemPaket;
use App\UserAdmin;
use Auth;
use Illuminate\Auth\RequestGuard;

class ItemPaketController extends Controller
{

    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paket = new ItemPaket;
          $res['success'] = true;
          $res['message'] = 'Success get all paket';
          $res['result'] = $paket->all()->toArray();
          return response($res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paket = new ItemPaket;
        $paket->admin_id = Auth::user()->id;
        $paket->nama = $request->input('nama');
        $paket->deskripsi = $request->input('deskripsi');
        $paket->info = $request->input('info');
        $paket->penginapan = $request->input('penginapan');
        $paket->transportasi = $request->input('transportasi');
        $paket->makan = $request->input('makan');
        $paket->lokasi = $request->input('lokasi');
        $file = $request->file('gambar');
        $ext = $file->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $file->move('uploads/file',$newName);
        $paket->gambar = $newName;
        $paket->tiket = $request->input('tiket');
        $paket->harga = $request->input('harga');
        $paket->save();
          if($paket->save()){
            $res['success'] = true;
            $res['message'] = 'Success add new paket';
            $res['result'] = $paket;
            return response($res);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $paket = ItemPaket::where('id',$id)->first();
              if ($paket !== null) {
                $res['success'] = true;
                $res['message'] = 'Find paket';
                $res['result'] = $paket;
                return response($res);
              }else{
                $res['success'] = false;
                $res['message'] = 'Paket not found!';
                return response($res);
              }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paket = ItemPaket::where('id',$id)->first();
        $paket->admin_id = Auth::user()->id;
        $paket->nama = $request->input('nama');
        $paket->deskripsi = $request->input('deskripsi');
        $paket->info = $request->input('info');
        $paket->penginapan = $request->input('penginapan');
        $paket->transportasi = $request->input('transportasi');
        $paket->makan = $request->input('makan');
        $paket->lokasi = $request->input('lokasi');
        if (empty($request->file('gambar'))){
              $paket->gambar = $paket->gambar;
        }else{
              unlink('uploads/file/'.$paket->gambar); //menghapus file lama
              $file = $request->file('gambar');
              $ext = $file->getClientOriginalExtension();
              $newName = rand(100000,1001238912).".".$ext;
              $file->move('uploads/file',$newName);
              $paket->gambar = $newName;
        }
        $paket->tiket = $request->input('tiket');
        $paket->harga = $request->input('harga');
        $paket->save();
        if ($paket) {
          $res['success'] = true;
          $res['message'] = 'Success update paket';
          $res['data'] = $paket;
          return response($res);
        }else{
          $res['success'] = false;
          $res['message'] = 'Failed update paket!';
          return response($res);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $paket = ItemPaket::where('id',$id)->first();
          if ($paket->delete($id)) {
              $res['success'] = true;
              $res['message'] = 'Success delete paket';
              $res['result'] = $paket;
              return response($res);
          }else{
                $res['success'] = false;
                $res['message'] = 'Failed delete paket!';
                return response($res);
          }
    }
}
