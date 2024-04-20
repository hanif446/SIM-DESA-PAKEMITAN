<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pengumuman_show', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('created_at', 'DESC')
               ->get();

        return view('konten.pengumuman.index', [
            'pengumuman' => $pengumuman
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('konten.pengumuman.create');
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
                  "judul" => 'required',
                  "isi_pengumuman" => 'required',
                  "penerbit" => 'required',
                  "gambar" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ],
        );

        DB::beginTransaction();
        try {
            $gambar = $request->file('gambar');
        
            $imageName = time().'.'.$gambar->extension(); 
            $gambar->move(public_path('pengumuman'), $imageName);
        
            $pengumuman= Pengumuman::create([
                'judul' => $request->judul,
                'isi_pengumuman'  => $request->isi_pengumuman,
                'gambar' => $imageName,
                'penerbit'  => $request->penerbit
            ]);

            return redirect()->route('pengumuman.index')->with('message', ' Data berhasil disimpan! ');

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
    public function edit(Pengumuman $pengumuman)
    {
        return view('konten.pengumuman.edit', [
            'pengumuman' => $pengumuman
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                  "judul" => 'required',
                  "isi_pengumuman" => 'required',
                  "penerbit" => 'required',
                  "gambar" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ],
        );

        DB::beginTransaction();
        try {
            if ($request->hasFile('gambar')) {
                $oldImageName = $pengumuman->gambar;
                if ($oldImageName && file_exists(public_path('pengumuman/'.$oldImageName))) {
                    unlink(public_path('pengumuman/'.$oldImageName));
                }
                // Mengunggah gambar baru dan menyimpan data pengumuman
                $gambar = $request->file('gambar');
                $imageName = time().'.'.$gambar->extension(); 
                $gambar->move(public_path('pengumuman'), $imageName); 
                $pengumuman->gambar = $imageName;
            }
        
            $pengumuman->update([
                'judul' => $request->judul,
                'isi_pengumuman'  => $request->isi_pengumuman,
                'penerbit'  => $request->penerbit
            ]);

            return redirect()->route('pengumuman.index')->with('message', ' Data berhasil diubah! ');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman)
    {

        DB::beginTransaction();
        try {

            if ($pengumuman->gambar) {
                $gambarPath = public_path('pengumuman/'.$pengumuman->gambar);
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }
            
            $pengumuman->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
