<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user_show', ['only' => 'index']);
        $this->middleware('permission:user_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user_detail', ['only' => 'show']);
        $this->middleware('permission:user_delete', ['only' => 'destroy']);
        $this->middleware('permission:edit_profil_update', ['only' => ['edit_profil', 'update_profil']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $perPage = 5;
    public function index(Request $request)
    {
        $users = [];

        if($request->get('keyword')){
            $users = User::search($request->keyword)->paginate($this->perPage);
        } else {
            $users = User::orderBy('created_at', 'DESC')->paginate($this->perPage);
        }

        return view('user.index', [
            'users' => $users->appends(['keyword' => $request->keyword]),
        ]);
    }

    public function select(Request $request)
    {
        $user = [];
        if($request->has('q')){
            $user= User::select('id', 'email')->search($request->q)->get();
        }else{
            $user = User::select('id',  'email')->limit(5)->get();
        }

        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
                  "username" => "required|string|max:30",
                  "email" => "required|email|unique:users,email",
                  "role" => "required",
                  "password" => "required|min:6|confirmed"
            ],
        );

        if($validator->fails()){
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        //Input Process
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->assignRole($request->role);

            return redirect()->route('user.index')->with('message', ' Data berhasil disimpan! ');
        }catch (\Throwable $th){
            DB::rollBack();
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('user.edit', [
            'user' => $user,
            'roleSelected' => $user->roles->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //validation
        $validator = Validator::make( 
            $request->all(),
            [
                  "username" => "required|string|max:30",
                  "email" => "required|email|unique:users,email," .$user->id,
                  "role" => "required",
            ],
        );

        if($validator->fails()){
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        //Input Process
        DB::beginTransaction();
        try {
            $user->update([
                'username' => $request->username,
                'email' => $request->email
            ]);
            $user->syncRoles($request->role);

            return redirect()->route('user.index')->with('message', ' Data berhasil diubah! ');
        }catch (\Throwable $th){
            DB::rollBack();
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->removeRole($user->roles->first());
            $user->delete();

            return redirect()->back()->with('message','Data berhasil dihapus!');

        }catch (\Throwable $th){
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }

    public function change_password()
    {
      return view('user.change_password');
    }

    public function update_password(Request $request){
      $validator = Validator::make( 
            $request->all(),
            [
                  "old_password" => "required|min:6|max:100",
                  "new_password" => 'required|min:6|max:100',
                  "confirm_password" => 'required|same:new_password'
            ],
      );

      if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        //dd($request->all());
      
      $current_user=Auth::user();

      if(Hash::check($request->old_password, $current_user->password)){
        $current_user->update([
            'password'=>Hash::make($request->new_password)
        ]);
        return redirect()->route('user.change_password')->with('message', 'Password berhasil diubah.');
      }else{
        return redirect()->route('user.change_password')->with('danger', 'Password lama tidak sama.');
      }
    }

    public function edit_profil(User $user)
    {
        return view('user.edit_profil', [
            'user' => $user,
            'pegawai' => $user->pegawai
        ]);
    }

    public function update_profil(Request $request, User $user)
    {
        //validation

        $pegawai = $user->pegawai;
        $validator = Validator::make( 
            $request->all(),
            [
                  "username" => "required|string|max:30",
                  "email" => "required|email|unique:users,email," .$user->id,
                  "nip" => "required|numeric|digits:18|unique:pegawais,nip," .$pegawai->id,
                  "nama_pegawai" => "required|string|max:30",
                  "tempat_lhr" => 'required',
                  "tgl_lhr" => 'required',
                  "no_hp" => 'required|numeric',
                  "alamat" => 'required',
                  "pendidikan" => 'required',
                  "jurusan" => 'required',
                  "diklat_pim" => 'required',
                  "thn_lulus" => 'required|numeric',
                  "uker" => 'required'
            ])->validate();

        DB::beginTransaction();
        try {
            $user->update([
                'username' => $request->username,
                'email' => $request->email
            ]);

            Pegawai::where('user_id', $user->id)->update([
                'nip' => $request->nip,
                'nama_pegawai'  => $request->nama_pegawai,
                'tempat_lhr' =>$request->tempat_lhr,
                'tgl_lhr' => $request->tgl_lhr,
                'no_hp' => $request->no_hp, 
                'alamat' => $request->alamat,
                'pendidikan' => $request->pendidikan,
                'jurusan' => $request->jurusan,
                'diklat_pim' => $request->diklat_pim,
                'thn_lulus' => $request->thn_lulus,
                'uker' => $request->uker
            ]);
            Alert::success('Profil', 'Berhasil Diubah!');
            return redirect()->route('dashboard.index');
        }catch (\Throwable $th){
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }
    }
}
