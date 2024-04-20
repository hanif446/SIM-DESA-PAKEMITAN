<?php

namespace App\Http\Controllers;

use App\Models\GajiPokok;
use App\Models\Pegawai;
use App\Models\GolonganGaji;
use App\Models\PotonganGajiPokok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GajiPokokController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:gaji_pokok_pegawai_show', ['only' => 'index']);
        $this->middleware('permission:gaji_pokok_pegawai_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gaji_pokok_pegawai_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gaji_pokok_pegawai_detail', ['only' => 'show']);
        $this->middleware('permission:gaji_pokok_pegawai_delete', ['only' => 'destroy']);
        $this->middleware('permission:gaji_pokok_pegawai_cetak', ['only' => 'cetak']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gaji_pokok = [];
        $gaji_pokok = GajiPokok::leftJoin('pegawais', 'gaji_pokoks.pegawai_id', '=', 'pegawais.id')
                ->select('gaji_pokoks.*', 'pegawais.nip', 'pegawais.nama_pegawai')
                ->orderBy('created_at', 'DESC')
                ->get();

        return view('gaji_pokok.index', [
            'gaji_pokok' => $gaji_pokok
        ]);
    }

    public function cetak(Request $request)
    {
        $bulanGaji = $request->input('bulan_gaji');
        $tahunGaji = $request->input('tahun_gaji');

        $gaji_pokok = GajiPokok::leftJoin('pegawais', 'gaji_pokoks.pegawai_id', '=', 'pegawais.id')
            ->select('gaji_pokoks.*', 'pegawais.nip', 'pegawais.nama_pegawai', 'pegawais.jabatan')
            ->where('gaji_pokoks.bulan_gaji', $bulanGaji)
            ->where('gaji_pokoks.tahun_gaji', $tahunGaji)
            ->orderBy('gaji_pokoks.created_at', 'DESC')
            ->get();
        
        $totalGaji = $gaji_pokok->sum('jumlah_gaji');

        $kepala_desa = Pegawai::where('jabatan', 'Kepala Desa')
                    ->first();
                    
        $kaur_keuangan = Pegawai::where('jabatan', 'Kaur Keuangan')
                    ->first();

        return view('gaji_pokok.cetak', [
            'gaji_pokok' => $gaji_pokok,
            'kepala_desa' => $kepala_desa,
            'kaur_keuangan' => $kaur_keuangan,
            'bulanGaji' => $bulanGaji,
            'tahunGaji' => $tahunGaji,
            'totalGaji' => $totalGaji
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gaji_pokok.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //dd($request);
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                  "pegawai" => 'required',
                  "bulan_gaji" => ['required', Rule::unique('gaji_pokoks')
                    ->where('pegawai_id', $request->pegawai)
                    ->where('tahun_gaji', $request->tahun_gaji)
                    ],
                  "tahun_gaji" => 'required',
                  "jumlah_gaji" => 'required|numeric'
            ],
        );

        if($validator->fails()){
            $request['pegawai'] = Pegawai::select('id', 'nip', 'nama_pegawai')->find($request->pegawai);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        //Input Process
        DB::beginTransaction();
        try {
            $gaji_pokok = GajiPokok::create([
                'pegawai_id' => $request->pegawai,
                'bulan_gaji' => $request->bulan_gaji,
                'tahun_gaji' => $request->tahun_gaji,
                'jumlah_gaji' => $request->jumlah_gaji
            ]);

            return redirect()->route('gaji-pokok.index')->with('message', 'Data berhasil disimpan!');
        }catch (\Throwable $th){
            DB::rollBack();
            Alert::error('Tambah Gaji Pokok Pegawai', 'Error' . $th->getMessage());
            $request['pegawai'] = Pegawai::select('id', 'nip', 'nama_pegawai')->find($request->pegawai);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GajiPokok  $gajiPokok
     * @return \Illuminate\Http\Response
     */
    public function show(GajiPokok $gaji_pokok)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GajiPokok  $gajiPokok
     * @return \Illuminate\Http\Response
     */
    public function edit(GajiPokok $gaji_pokok)
    {
        return view('gaji_pokok.edit', [
            'gaji_pokok' => $gaji_pokok,
            'pegawai' => $gaji_pokok->pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GajiPokok  $gajiPokok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GajiPokok $gaji_pokok)
    {
        //validation
        $rules = [
                  "pegawai" => 'required',
                  "tahun_gaji" => 'required',
                  "jumlah_gaji" => 'required|numeric'
            ];

        if($request->bulan_gaji != $gaji_pokok->bulan_gaji){
            $rules['bulan_gaji'] = ['required', Rule::unique('gaji_pokoks')
                    ->where('pegawai_id', $request->pegawai)
                    ->where('tahun_gaji', $request->tahun_gaji)
                    ];
        }

        $validator = $request->validate($rules);

        //Input Process
        DB::beginTransaction();
        try {
            $gaji_pokok->update([
                'pegawai_id' => $request->pegawai,
                'bulan_gaji' => $request->bulan_gaji,
                'tahun_gaji' => $request->tahun_gaji,
                'jumlah_gaji' => $request->jumlah_gaji
            ]);

            return redirect()->route('gaji-pokok.index')->with('message', 'Data berhasil diubah!');
        }catch (\Throwable $th){
            DB::rollBack();
            Alert::error('Ubah Gaji Pokok Pegawai', 'Error' . $th->getMessage());
            $request['pegawai'] = Pegawai::select('id', 'nip', 'nama_pegawai')->find($request->pegawai);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GajiPokok  $gajiPokok
     * @return \Illuminate\Http\Response
     */
    public function destroy(GajiPokok $gaji_pokok)
    {
        DB::beginTransaction();
        try {
            $gaji_pokok->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
