<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\AnggotaKK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kk = KK::orderBy('created_at', 'DESC')
               ->get();

        return view('kk.index', [
            'kk' => $kk
        ]);
    }

    public function select(Request $request)
    {
        $kk = [];
        $search = $request->q;
        if($request->has('q')){
            $kk= KK::select('id', 'no_kk', 'nama_kepala_keluarga')->where('nama_kepala_keluarga', 'LIKE', "%$search%")->get();
        }else{
            $kk = KK::select('id', 'no_kk', 'nama_kepala_keluarga')->limit(5)->get();
        }

        return response()->json($kk);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kk.create');
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
            "no_kk" => "required|numeric|digits:16|unique:kk,no_kk",
            "nama_kepala_keluarga" => "required",
            "alamat" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Simpan data kk
            $kk = KK::create([
                'no_kk' => $request->no_kk,
                'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
                'alamat' => $request->alamat,
            ]);

            DB::commit();

            return redirect()->route('kk.index')->with('message', 'Data berhasil disimpan!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    // Di dalam fungsi store_anggota_kk
    public function store_anggota_kk(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            "penduduk" => "required",
            "hubungan_keluarga" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Periksa apakah penduduk sudah menjadi anggota KK di KK lainnya
        $existingAnggota = AnggotaKK::where('penduduk_id', $request->penduduk)
            ->where('kk_id', '!=', $request->no_kk)
            ->exists();

        if ($existingAnggota) {
            return redirect()->back()->withErrors(['penduduk' => 'Penduduk sudah menjadi anggota KK di KK lainnya.']);
        }

        // Periksa apakah kombinasi penduduk_id dan kk_id sudah ada (untuk memastikan tidak ada redudansi data di dalam satu KK)
        $existingRedudancy = AnggotaKK::where('penduduk_id', $request->penduduk)
            ->where('kk_id', $request->no_kk)
            ->exists();

        if ($existingRedudancy) {
            return redirect()->back()->withErrors(['penduduk' => 'Penduduk sudah menjadi anggota KK di KK ini.']);
        }

        DB::beginTransaction();
        try {
            // Simpan data KK
            $anggota_kk = AnggotaKK::create([
                'penduduk_id' => $request->penduduk,
                'kk_id' => $request->no_kk,
                'hubungan_keluarga' => $request->hubungan_keluarga
            ]);

            DB::commit();

            return redirect()->back()->with('message', 'Data berhasil disimpan!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }


    public function delete_anggota_kk(AnggotaKK $anggota_kk)
    {
        DB::beginTransaction();
        try {
            $anggota_kk->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(KK $kk)
    {
        $anggota_kk = AnggotaKK::leftJoin('penduduk', 'anggota_kk.penduduk_id', '=', 'penduduk.id')
                ->leftJoin('kk', 'anggota_kk.kk_id', '=', 'kk.id')
                ->select('penduduk.*', 'kk.*', 'anggota_kk.*')
                ->where('anggota_kk.kk_id', $kk->id)
                ->orderBy('anggota_kk.created_at', 'ASC')
                ->get();

        // Periksa apakah penduduk sudah menjadi anggota KK di KK lainnya
        $existingAnggota = false; // Defaultnya false karena belum ada pemeriksaan

        return view('kk.detail', [
            'kk' => $kk,
            'anggota_kk' => $anggota_kk,
            'existingAnggota' => $existingAnggota // Kirim variabel existingAnggota ke tampilan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(KK $kk)
    {
        return view('kk.edit', [
            'kk' => $kk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KK $kk)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            "no_kk" => "required|numeric|digits:16|unique:kk,no_kk," .$kk->id,
            "nama_kepala_keluarga" => "required",
            "alamat" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Ubah data kk
            $kk->update([
                'no_kk' => $request->no_kk,
                'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
                'alamat' => $request->alamat,
            ]);

            DB::commit();

            return redirect()->route('kk.index')->with('message', 'Data berhasil diubah!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KK $kk)
    {
        DB::beginTransaction();
        try {
            $kk->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
