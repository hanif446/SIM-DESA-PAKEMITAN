<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisi;
use App\Models\Sejarah;
use App\Models\Geografis;
use App\Models\Demografi;
use App\Models\StrukturOrganisasi;
use App\Models\Pegawai;
use App\Models\Kontak;
use App\Models\Galeri;
use App\Models\Agenda;
use App\Models\Pengumuman;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        return view('layouts.home');
    }

    public function visi_misi()
    {
        $visi_misi = VisiMisi::where('visi_misis.id', '=', 1)
                            ->first();

        return view('homepage.visi_misi', compact('visi_misi'));
    }

    public function sejarah()
    {
        $sejarah = Sejarah::where('sejarah_desas.id', '=', 1)
                            ->first();

        return view('homepage.sejarah', compact('sejarah'));
    }

    public function geografis()
    {
        $geografis = Geografis::where('geografis_desas.id', '=', 1)
                            ->first();

        return view('homepage.geografis', compact('geografis'));
    }

    public function demografi()
    {
        $demografi = Demografi::where('demografi_desas.id', '=', 1)
                            ->first();

        return view('homepage.demografi', compact('demografi'));
    }

    public function struktur_organisasi()
    {
        $struktur_organisasi = StrukturOrganisasi::where('struktur_organisasis.id', '=', 1)
                            ->first();

        return view('homepage.struktur_organisasi', compact('struktur_organisasi'));
    }

    private $perPage = 8;
    public function perangkat_desa()
    {
        $perangkat_desa = [];

        $perangkat_desa = Pegawai::orderBy('created_at', 'ASC')->paginate($this->perPage);

        return view('homepage.perangkat_desa', compact('perangkat_desa'));
    }

    public function kontak()
    {
        $kontak = Kontak::where('kontak.id', '=', 1)
                            ->first();

        return view('homepage.kontak', compact('kontak'));
    }

    private $perPageGaleri = 9;

    public function galeri()
    {
        $galeri = Galeri::orderBy('created_at', 'DESC')->paginate($this->perPageGaleri);
        $galeri_wisata = Galeri::where('jenis_foto', 'Wisata')->orderBy('created_at', 'desc')->paginate($this->perPageGaleri);
        $galeri_kegiatan = Galeri::where('jenis_foto', 'Kegiatan')->orderBy('created_at', 'desc')->paginate($this->perPageGaleri);

        $galeri_combined = $galeri->merge($galeri_wisata)->merge($galeri_kegiatan);

        return view('homepage.galeri', compact('galeri_combined'));
    }

    private $perPagePengumuman = 12;
    public function pengumuman()
    {
        $pengumuman = [];

        $pengumuman = Pengumuman::orderBy('created_at', 'DESC')->paginate($this->perPage);

        return view('homepage.pengumuman', compact('pengumuman'));
    }

    private $perPageAgenda = 1;

    public function agenda()
    {
        $agenda = Agenda::orderBy('created_at', 'DESC')->paginate($this->perPageAgenda);

        return view('homepage.agenda', compact('agenda'));
    }

    public function pengumuman_detail($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('homepage.pengumuman_detail', compact('pengumuman'));
    }

    public function pengaduan()
    {
        return view('homepage.pengaduan');
    }

    public function store_pengaduan(Request $request)
    {
        try {
            $pengaduan = Pengaduan::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);
            return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim pengaduan. Silakan coba lagi.')->withErrors([$e->getMessage()]);
        }
    }


}
