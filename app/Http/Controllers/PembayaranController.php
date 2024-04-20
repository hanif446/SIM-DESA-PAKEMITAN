<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pembayaran_show', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::leftJoin('kk', 'pembayaran.kk_id', '=', 'kk.id')
                ->select('pembayaran.*', 'kk.*', 'pembayaran.created_at as tgl_pembayaran', 'pembayaran.id as pembayaran_id')
                ->orderBy('pembayaran.created_at', 'DESC')
                ->get();

        return view('pembayaran.index', [
            'pembayaran' => $pembayaran
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            "kk" => "required",
            "jenis_pembayaran" => "required",
            "total_pembayaran" => "required|numeric",
            "keterangan" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Simpan data pembayaran
            $pembayaran = Pembayaran::create([
                'kk_id' => $request->kk,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'total_pembayaran' => $request->total_pembayaran,
                'keterangan' => $request->keterangan,
            ]);

            DB::commit();

            return redirect()->route('pembayaran.index')->with('message', 'Data berhasil disimpan!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        return view('pembayaran.edit', [
            'pembayaran' => $pembayaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            "kk" => "required",
            "jenis_pembayaran" => "required",
            "total_pembayaran" => "required|numeric",
            "keterangan" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Ubah data pembayaran
            $pembayaran->update([
                'kk_id' => $request->kk,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'total_pembayaran' => $request->total_pembayaran,
                'keterangan' => $request->keterangan,
            ]);

            DB::commit();

            return redirect()->route('pembayaran.index')->with('message', 'Data berhasil diubah!');
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Tambah Gaji Pokok Pegawai', 'Error' . $th->getMessage());
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        DB::beginTransaction();
        try {
            $pembayaran->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
