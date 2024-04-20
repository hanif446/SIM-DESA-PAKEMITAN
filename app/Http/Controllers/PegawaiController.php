<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pegawai_show', ['only' => 'index']);
        $this->middleware('permission:pegawai_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pegawai_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pegawai_detail', ['only' => 'show']);
        $this->middleware('permission:pegawai_delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $pegawai = Pegawai::orderBy('created_at', 'DESC')
               ->get();

        return view('pegawai.index', [
            'pegawai' => $pegawai
        ]);
    }

    public function select(Request $request)
    {
        $pegawai = [];
        $search = $request->q;
        if($request->has('q')){
            $pegawai= Pegawai::select('id', 'nip', 'nama_pegawai')->where('nama_pegawai', 'LIKE', "%$search%")->get();
        }else{
            $pegawai = Pegawai::select('id',  'nip', 'nama_pegawai')->limit(5)->get();
        }

        return response()->json($pegawai);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                  "nip" => "required|numeric|digits:18|unique:pegawais,nip",
                  "nama_pegawai" => "required|string|max:30",
                  "jabatan" => ['required', Rule::unique('pegawais')
                    ->where('jabatan', $request->jabatan)
                    ],
                  "tempat_lhr" => 'required',
                  "tgl_lhr" => 'required',
                  "no_hp" => 'required',
                  "alamat" => 'required',
                  "pendidikan_terakhir" => 'required',
                  "no_sk_pengangkatan" => 'required',
                  "thn_sk_pengangkatan" => 'required',
                  "foto" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ],
        );

        DB::beginTransaction();
        try {
            $foto = $request->file('foto');
        
            $imageName = time().'.'.$foto->extension(); 
            $foto->move(public_path('pegawai'), $imageName);
        
            $pegawai = Pegawai::create([
                'nip' => $request->nip,
                'nama_pegawai'  => $request->nama_pegawai,
                'jabatan'  => $request->jabatan,
                'tempat_lhr' =>$request->tempat_lhr,
                'tgl_lhr' => $request->tgl_lhr,
                'no_hp' => $request->no_hp, 
                'alamat' => $request->alamat, 
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'no_sk_pengangkatan' => $request->no_sk_pengangkatan,
                'thn_sk_pengangkatan' => $request->thn_sk_pengangkatan,
                'foto' => $imageName
            ]);

            return redirect()->route('pegawai.index')->with('message', ' Data berhasil disimpan! ');

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        return view('pegawai.detail', [
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', [
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $pegawai = Pegawai::find($pegawai->id);

        $rules = [
            "nip" => "required|numeric|digits:18|unique:pegawais,nip," .$pegawai->id,
            "nama_pegawai" => "required|string|max:30",
            "tempat_lhr" => 'required',
            "tgl_lhr" => 'required',
            "no_hp" => 'required',
            "alamat" => 'required',
            "pendidikan_terakhir" => 'required',
            "no_sk_pengangkatan" => 'required',
            "thn_sk_pengangkatan" => 'required',
            "foto" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ];

        if($request->jabatan != $pegawai->jabatan){
            $rules['jabatan'] = ['required', Rule::unique('pegawais')
                ->where('jabatan', $request->jabatan)
            ];
        }

        $validator = $request->validate($rules);

        DB::beginTransaction();
        try {
            // Menghapus foto lama jika ada dan pengguna memilih untuk mengubah foto
            if ($request->hasFile('foto')) {
                $oldImageName = $pegawai->foto;
                if ($oldImageName && file_exists(public_path('pegawai/'.$oldImageName))) {
                    unlink(public_path('pegawai/'.$oldImageName));
                }
                // Mengunggah foto baru dan menyimpan data pegawai
                $foto = $request->file('foto');
                $imageName = time().'.'.$foto->extension(); 
                $foto->move(public_path('pegawai'), $imageName); 
                $pegawai->foto = $imageName;
            }

            $pegawai->update([
                'nip' => $request->nip,
                'nama_pegawai'  => $request->nama_pegawai,
                'jabatan'  => $request->jabatan,
                'tempat_lhr' =>$request->tempat_lhr,
                'tgl_lhr' => $request->tgl_lhr,
                'no_hp' => $request->no_hp, 
                'alamat' => $request->alamat, 
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'no_sk_pengangkatan' => $request->no_sk_pengangkatan,
                'thn_sk_pengangkatan' => $request->thn_sk_pengangkatan,
            ]);

            return redirect()->route('pegawai.index')->with('message', ' Data berhasil diubah! ');

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
        DB::beginTransaction();
        try {

            if ($pegawai->foto) {
                $gambarPath = public_path('pegawai/'.$pegawai->foto);
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }
            
            $pegawai->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
