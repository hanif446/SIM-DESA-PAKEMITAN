<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:agenda_show', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agenda = Agenda::orderBy('created_at', 'DESC')
               ->get();

        return view('konten.agenda.index', [
            'agenda' => $agenda
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('konten.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                  "judul" => 'required',
                  "deskripsi" => 'required',
                  "tgl_kegiatan" => 'date|required',
                  "waktu_mulai" => 'required',
                  "waktu_selesai" => 'required',
                  "tempat" => 'required'
            ],
        );

        DB::beginTransaction();
        try {
            $agenda= Agenda::create([
                'judul' => $request->judul,
                'deskripsi'  => $request->deskripsi,
                'tgl_kegiatan' => $request->tgl_kegiatan,
                'waktu_mulai'  => $request->waktu_mulai,
                'waktu_selesai'  => $request->waktu_selesai,
                'tempat'  => $request->tempat
            ]);

            return redirect()->route('agenda.index')->with('message', ' Data berhasil disimpan! ');

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
    public function edit(Agenda $agenda)
    {
        return view('konten.agenda.edit', [
            'agenda' => $agenda
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validator = Validator::make(
            $request->all(),
            [
                  "judul" => 'required',
                  "deskripsi" => 'required',
                  "tgl_kegiatan" => 'date|required',
                  "waktu_mulai" => 'required',
                  "waktu_selesai" => 'required',
                  "tempat" => 'required'
            ],
        );

        DB::beginTransaction();
        try {
            $agenda->update([
                'judul' => $request->judul,
                'deskripsi'  => $request->deskripsi,
                'tgl_kegiatan' => $request->tgl_kegiatan,
                'waktu_mulai'  => $request->waktu_mulai,
                'waktu_selesai'  => $request->waktu_selesai,
                'tempat'  => $request->tempat
            ]);

            return redirect()->route('agenda.index')->with('message', ' Data berhasil diubah! ');

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
    public function destroy(Agenda $agenda)
    {
        DB::beginTransaction();
        try {
            $agenda->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
