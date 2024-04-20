<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SuratMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:surat_masuk_show', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat_masuk = SuratMasuk::orderBy('created_at', 'DESC')
               ->get();

        return view('surat_masuk.index', [
            'surat_masuk' => $surat_masuk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat_masuk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'no_surat' => 'required|string',
            'tgl_surat' => 'required|date',
            'tgl_diterima' => 'required|date',
            'asal_surat' => 'required|string',
            'tujuan_surat' => 'required|string',
            'lampiran' => 'required|string',
            'perihal' => 'required|string',
            'file_surat' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $file_surat = $request->file('file_surat');
            $file_surat_name = time().'.'.$file_surat->extension(); 
            $file_surat->move(public_path('surat_masuk'), $file_surat_name);

            // Buat objek SuratMasuk dengan atribut yang sesuai
            $surat_masuk = SuratMasuk::create([
                'no_surat' => $request->no_surat,
                'tgl_surat' => $request->tgl_surat,
                'tgl_diterima' => $request->tgl_diterima,
                'asal_surat' => $request->asal_surat,
                'tujuan_surat' => $request->tujuan_surat,
                'lampiran' => $request->lampiran,
                'perihal' => $request->perihal,
                'file_surat' => $file_surat_name
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('surat_masuk.index')->with('message', 'Data berhasil disimpan!');
        } catch (\Throwable $th) {
            DB::rollback();
            // Jika terjadi kesalahan, kembalikan ke halaman sebelumnya dengan input yang dimasukkan sebelumnya dan pesan kesalahan
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
    public function show(SuratMasuk $surat_masuk)
    {
        return view('surat_masuk.detail', [
            'surat_masuk' => $surat_masuk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $surat_masuk)
    {
        return view('surat_masuk.edit', [
            'surat_masuk' => $surat_masuk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMasuk $surat_masuk)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'no_surat' => 'required|string',
            'tgl_surat' => 'required|date',
            'tgl_diterima' => 'required|date',
            'asal_surat' => 'required|string',
            'tujuan_surat' => 'required|string',
            'lampiran' => 'required|string',
            'perihal' => 'required|string',
            'file_surat' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            // Menghapus file surat lama jika ada
            if ($request->hasFile('file_surat')) {
                $oldFileName = $surat_masuk->file_surat;
                if ($oldFileName && file_exists(public_path('surat_masuk/'.$oldFileName))) {
                    unlink(public_path('surat_masuk/'.$oldFileName));
                }
            }

            // Mengunggah file surat baru dan menyimpan data surat masuk
            if ($request->hasFile('file_surat')) {
                $file_surat = $request->file('file_surat');
                $file_surat_name = time().'.'.$file_surat->extension(); 
                $file_surat->move(public_path('surat_masuk'), $file_surat_name); 
                $surat_masuk->file_surat = $file_surat_name;
            }


            // Buat objek SuratMasuk dengan atribut yang sesuai
            $surat_masuk->update([
                'no_surat' => $request->no_surat,
                'tgl_surat' => $request->tgl_surat,
                'tgl_diterima' => $request->tgl_diterima,
                'asal_surat' => $request->asal_surat,
                'tujuan_surat' => $request->tujuan_surat,
                'lampiran' => $request->lampiran,
                'perihal' => $request->perihal,
                'file_surat' => $request->hasFile('file_surat') ? $file_surat_name : $surat_masuk->file_surat
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('surat_masuk.index')->with('message', 'Data berhasil diubah!');
        } catch (\Throwable $th) {
            DB::rollback();
            // Jika terjadi kesalahan, kembalikan ke halaman sebelumnya dengan input yang dimasukkan sebelumnya dan pesan kesalahan
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
    public function destroy(SuratMasuk $surat_masuk)
    {
        DB::beginTransaction();
        try {
            if ($surat_masuk->file_surat) {
                $gambarPath = public_path('surat_masuk/'.$surat_masuk->file_surat);
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }

            $surat_masuk->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
