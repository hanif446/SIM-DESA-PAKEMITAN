<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penduduk = Penduduk::orderBy('created_at', 'DESC')
               ->get();

        return view('penduduk.index', [
            'penduduk' => $penduduk
        ]);
    }

    public function select(Request $request)
    {
        $penduduk = [];
        $search = $request->q;
        if($request->has('q')){
            $penduduk= Penduduk::select('id', 'nik', 'nama')->where('nama', 'LIKE', "%$search%")->get();
        }else{
            $penduduk = Penduduk::select('id',  'nik', 'nama')->limit(5)->get();
        }

        return response()->json($penduduk);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penduduk.create');
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
            "nik" => "required|numeric|digits:16|unique:penduduk,nik",
            "nama" => "required",
            "jk" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required|date",
            "agama" => "required",
            "pendidikan" => "required",
            "pekerjaan" => "required",
            "gol_darah" => "required",
            "status_kawin" => "required",
            "tgl_kawin" => "nullable|date",
            "kewarganegaraan" => "required",
            "nama_ayah" => "required",
            "nama_ibu" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Simpan data penduduk
            $penduduk = Penduduk::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'pendidikan' => $request->pendidikan,
                'pekerjaan' => $request->pekerjaan,
                'gol_darah' => $request->gol_darah,
                'status_kawin' => $request->status_kawin,
                'tgl_kawin' => $request->tgl_kawin,
                'kewarganegaraan' => $request->kewarganegaraan,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
            ]);

            DB::commit();

            return redirect()->route('penduduk.index')->with('message', 'Data berhasil disimpan!');
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
    public function show(Penduduk $penduduk)
    {
        return view('penduduk.detail', [
            'penduduk' => $penduduk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', [
            'penduduk' => $penduduk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        $penduduk = Penduduk::find($penduduk->id);
        // Validasi data
        $validator = Validator::make($request->all(), [
            "nik" => "required|numeric|digits:16|unique:penduduk,nik," .$penduduk->id,
            "nama" => "required",
            "jk" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required|date",
            "agama" => "required",
            "pendidikan" => "required",
            "pekerjaan" => "required",
            "gol_darah" => "required",
            "status_kawin" => "required",
            "tgl_kawin" => "nullable|date",
            "kewarganegaraan" => "required",
            "nama_ayah" => "required",
            "nama_ibu" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Simpan data penduduk
            $penduduk->update([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'pendidikan' => $request->pendidikan,
                'pekerjaan' => $request->pekerjaan,
                'gol_darah' => $request->gol_darah,
                'status_kawin' => $request->status_kawin,
                'tgl_kawin' => $request->tgl_kawin,
                'kewarganegaraan' => $request->kewarganegaraan,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
            ]);

            DB::commit();

            return redirect()->route('penduduk.index')->with('message', 'Data berhasil diubah!');
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Ubah Gaji Pokok penduduk', 'Error' . $th->getMessage());
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penduduk $penduduk)
    {
        DB::beginTransaction();
        try {
            $penduduk->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
