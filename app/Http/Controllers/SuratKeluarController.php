<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:surat_keluar_show', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat_keluar = SuratKeluar::orderBy('created_at', 'DESC')
               ->get();

        return view('surat_keluar.index', [
            'surat_keluar' => $surat_keluar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat_keluar.create');
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
            $file_surat->move(public_path('surat_keluar'), $file_surat_name);

            // Buat objek SuratKeluar dengan atribut yang sesuai
            $surat_keluar = SuratKeluar::create([
                'no_surat' => $request->no_surat,
                'tgl_surat' => $request->tgl_surat,
                'asal_surat' => $request->asal_surat,
                'tujuan_surat' => $request->tujuan_surat,
                'lampiran' => $request->lampiran,
                'perihal' => $request->perihal,
                'file_surat' => $file_surat_name
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('surat_keluar.index')->with('message', 'Data berhasil disimpan!');
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
    public function show(SuratKeluar $surat_keluar)
    {
        return view('surat_keluar.detail', [
            'surat_keluar' => $surat_keluar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratKeluar $surat_keluar)
    {
        return view('surat_keluar.edit', [
            'surat_keluar' => $surat_keluar
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratKeluar $surat_keluar)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'no_surat' => 'required|string',
            'tgl_surat' => 'required|date',
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
                $oldFileName = $surat_keluar->file_surat;
                if ($oldFileName && file_exists(public_path('surat_keluar/'.$oldFileName))) {
                    unlink(public_path('surat_keluar/'.$oldFileName));
                }
            }

            // Mengunggah file surat baru dan menyimpan data surat masuk
            if ($request->hasFile('file_surat')) {
                $file_surat = $request->file('file_surat');
                $file_surat_name = time().'.'.$file_surat->extension(); 
                $file_surat->move(public_path('surat_keluar'), $file_surat_name); 
                $surat_keluar->file_surat = $file_surat_name;
            }

            // Buat objek SuratKeluar dengan atribut yang sesuai
            $surat_keluar->update([
                'no_surat' => $request->no_surat,
                'tgl_surat' => $request->tgl_surat,
                'asal_surat' => $request->asal_surat,
                'tujuan_surat' => $request->tujuan_surat,
                'lampiran' => $request->lampiran,
                'perihal' => $request->perihal,
                'file_surat' => $request->hasFile('file_surat') ? $file_surat_name : $surat_keluar->file_surat
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('surat_keluar.index')->with('message', 'Data berhasil diubah!');
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
    public function destroy(SuratKeluar $surat_keluar)
    {
        DB::beginTransaction();
        try {
            if ($surat_keluar->file_surat) {
                $gambarPath = public_path('surat_keluar/'.$surat_keluar->file_surat);
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }

            $surat_keluar->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
