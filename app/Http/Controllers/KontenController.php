<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use App\Models\Sejarah;
use App\Models\Geografis;
use App\Models\Demografi;
use App\Models\StrukturOrganisasi;
use App\Models\Kontak;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class KontenController extends Controller
{
    public function visi_misi()
    {
        $visi_misi = VisiMisi::where('visi_misis.id', '=', 1)
                            ->first();
        
        $cek_data = VisiMisi::count();

        return view('konten.profil_desa.visi_misi', compact('visi_misi', 'cek_data'));
    }

    public function store_visi_misi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "visi" => 'required',
                "misi" => "required"
            ]
        );

        DB::beginTransaction();
        try {
            $visi = $request->visi;
            $misi = $request->misi;

            $visiMisi = VisiMisi::updateOrCreate(
                ['id' => 1],
                ['visi' => $visi, 'misi' => $misi]
            );

            if ($visiMisi->wasRecentlyCreated) {
                return redirect()->route('visi_misi')->with('message', 'Data berhasil disimpan!');
            } else {
                return redirect()->route('visi_misi')->with('message', 'Data berhasil diubah!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    public function sejarah()
    {
        $sejarah = Sejarah::where('sejarah_desas.id', '=', 1)
                            ->first();
        
        $cek_data = Sejarah::count();

        return view('konten.profil_desa.sejarah', compact('sejarah', 'cek_data'));
    }

    public function store_sejarah(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "sejarah" => 'required'
            ]
        );

        DB::beginTransaction();
        try {
            $sejarah = $request->sejarah;

            $sejarahDesa = Sejarah::updateOrCreate(
                ['id' => 1],
                ['sejarah' => $sejarah]
            );

            if ($sejarahDesa->wasRecentlyCreated) {
                return redirect()->route('sejarah')->with('message', 'Data berhasil disimpan!');
            } else {
                return redirect()->route('sejarah')->with('message', 'Data berhasil diubah!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    public function geografis()
    {
        $geografis = Geografis::where('geografis_desas.id', '=', 1)
                            ->first();
        
        $cek_data = Geografis::count();

        return view('konten.profil_desa.geografis', compact('geografis', 'cek_data'));
    }

    public function store_geografis(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "geografis" => 'required'
            ]
        );

        DB::beginTransaction();
        try {
            $geografis = $request->geografis;

            $geografisDesa = Geografis::updateOrCreate(
                ['id' => 1],
                ['geografis' => $geografis]
            );

            if ($geografisDesa->wasRecentlyCreated) {
                return redirect()->route('geografis')->with('message', 'Data berhasil disimpan!');
            } else {
                return redirect()->route('geografis')->with('message', 'Data berhasil diubah!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    public function demografi()
    {
        $demografi = Demografi::where('demografi_desas.id', '=', 1)
                            ->first();
        
        $cek_data = Demografi::count();

        return view('konten.profil_desa.demografi', compact('demografi', 'cek_data'));
    }

    public function store_demografi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "demografi" => 'required'
            ]
        );

        DB::beginTransaction();
        try {
            $demografi = $request->demografi;

            $demografiDesa = Demografi::updateOrCreate(
                ['id' => 1],
                ['demografi' => $demografi]
            );

            if ($demografiDesa->wasRecentlyCreated) {
                return redirect()->route('demografi')->with('message', 'Data berhasil disimpan!');
            } else {
                return redirect()->route('demografi')->with('message', 'Data berhasil diubah!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    public function struktur_organisasi()
    {
        $struktur_organisasi = StrukturOrganisasi::where('struktur_organisasis.id', '=', 1)
                            ->first();
        
        $cek_data = StrukturOrganisasi::count();

        return view('konten.pemerintahan.struktur_organisasi', compact('struktur_organisasi', 'cek_data'));
    }

    public function store_struktur_organisasi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'struktur_organisasi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        DB::beginTransaction();
        try {
            $struktur_organisasi = $request->file('struktur_organisasi');

            $oldStruktur = StrukturOrganisasi::find(1);
            if ($oldStruktur) {
                // Debug: Periksa apakah file lama ada dan dapat dihapus
                $oldImageName = $oldStruktur->struktur_organisasi;
                if ($oldImageName && file_exists(public_path('struktur_organisasi/'.$oldImageName))) {
                    if (!unlink(public_path('struktur_organisasi/'.$oldImageName))) {
                        throw new \Exception('Failed to delete old image.');
                    }
                }
            }
        
            $imageName = time().'.'.$struktur_organisasi->extension(); // Perbaikan di sini
            $struktur_organisasi->move(public_path('struktur_organisasi'), $imageName); // Perbaikan di sini
        
            $strukturOrganisasiDesa = StrukturOrganisasi::updateOrCreate(
                ['id' => 1],
                ['struktur_organisasi' => $imageName]
            );
        
            if ($strukturOrganisasiDesa->wasRecentlyCreated) {
                return redirect()->route('struktur_organisasi')->with('message', 'Data berhasil disimpan!');
            } else {
                return redirect()->route('struktur_organisasi')->with('message', 'Data berhasil diubah!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }        
    }

    public function kontak()
    {
        $kontak = Kontak::where('kontak.id', '=', 1)
                            ->first();
        
        $cek_data = Kontak::count();

        return view('konten.kontak.kontak', compact('kontak', 'cek_data'));
    }

    public function store_kontak(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "alamat" => 'required',
                "no_hp" => 'required|numeric',
                "email" => 'required|email'
            ]
        );

        DB::beginTransaction();
        try {
            $alamat = $request->alamat;
            $no_hp = $request->no_hp;
            $email = $request->email;

            $kontakDesa = Kontak::updateOrCreate(
                ['id' => 1],
                ['alamat' => $alamat, 'no_hp' => $no_hp, 'email' => $email]
            );

            if ($kontakDesa->wasRecentlyCreated) {
                return redirect()->route('kontak')->with('message', 'Data berhasil disimpan!');
            } else {
                return redirect()->route('kontak')->with('message', 'Data berhasil diubah!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    public function galeri()
    {
        $galeri = Galeri::orderBy('created_at', 'DESC')
                    ->get();

        return view('konten.galeri.galeri', compact('galeri'));
    }

    public function create_galeri()
    {
        return view('konten.galeri.create');
    }

    public function edit_galeri(Galeri $galeri)
    {
        return view('konten.galeri.edit', [
            'galeri' => $galeri
        ]);
    }

    public function store_galeri(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'jenis_foto' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        DB::beginTransaction();
        try {
            $foto = $request->file('foto');
        
            $imageName = time().'.'.$foto->extension(); 
            $foto->move(public_path('galeri'), $imageName); 
        
            $galeriDesa = Galeri::create(
                ['jenis_foto' => $request->jenis_foto, 'foto' => $imageName]
            );
        
            return redirect()->route('galeri')->with('message', 'Data berhasil disimpan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }        
    }

    public function update_galeri(Request $request, Galeri $galeri)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'jenis_foto' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        DB::beginTransaction();
        try {
            $foto = $request->file('foto');

            // Jika ada file foto baru diunggah, proses perubahan
            if ($foto) {
                // Menghapus foto lama jika ada
                if ($galeri->foto) {
                    $oldImageName = $galeri->foto;
                    if (file_exists(public_path('galeri/'.$oldImageName))) {
                        unlink(public_path('galeri/'.$oldImageName));
                    }
                }
            
                // Menyimpan foto baru
                $imageName = time().'.'.$foto->extension();
                $foto->move(public_path('galeri'), $imageName);

                // Perbarui data galeri
                $galeri->update(['jenis_foto' => $request->jenis_foto, 'foto' => $imageName]);
            } else {
                // Jika tidak ada file foto baru diunggah, hanya perbarui jenis foto
                $galeri->update(['jenis_foto' => $request->jenis_foto]);
            }
        
            return redirect()->route('galeri')->with('message', 'Data berhasil diubah!');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }        
    }



    public function delete_galeri(Galeri $galeri)
    {
        DB::beginTransaction();
        try {
            // Menghapus gambar dari direktori public/galeri
            if ($galeri->foto) {
                $gambarPath = public_path('galeri/'.$galeri->foto);
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }

            // Menghapus entri galeri dari database
            $galeri->delete();

            DB::commit();
            return redirect()->back()->with('message', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data galeri.');
        }
    }

}
