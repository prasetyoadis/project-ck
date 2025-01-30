<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return view('dashboard.admin.profile', [
            "title" => "My Profile"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // return $user;
        return view('dashboard.admin.profile-edit', [
            "title" => "Edit My Profile",
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $dataRules = [
            'name' => 'required|min:3',
            'foto' => 'image|file|max:1042',
            'gender' => 'required',
            'no_hp' => 'required|min:9|max:15',
        ];
        if ($request->username != $user->username) $dataRules['username'] = 'required|unique:users';
        //Validasi Data dengan dataRules
        $dataValid = $request->validate($dataRules);

        if ($request->file('foto')) {
            //Hapus Foto Profile Lama
            if ($user->foto != "img/users/default_profile_male.png" && $user->foto != "img/users/default_profile_female.png") {
                /**
                 * Jika Mau di upload di hosting bisa pakai
                 *
                 * @param use Illuminate\Support\Facades\File;
                 *
                 * File::delete('/home/namafolder/public_html/'. $user->foto);
                 */
                Storage::disk('public-web')->delete($user->foto);
            }
            /**
             * Jika Mau di upload di hosting bisa pakai
             *
             * @param use Illuminate\Support\Str;
             *
             * $foto = $request->file('foto');
             * $foto_nama =  $gambar_nama =  Str::random(40). '.'. $request->file('foto')->getClientOriginalExtension();
             * $dataValid['foto'] = 'img/users/'. $foto_nama;
             * $foto->move('img/users', $foto_nama);
             */
            //Upload Foto Profile
            $dataValid['foto'] = Storage::disk('public-web')->put('img/users', $request->file('foto'));
        }
        
        //Update Dengan dataValid Pada Model User Berdasarkan id User
        $status = User::where('id', $user->id)->update($dataValid);

        if ($request->username != $user->username) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/admin')->with('success', 'Username Berhasil diganti!');
        }else {
            //Redirect Halaman Admin Menu Staff
            return redirect('/admin/@'. $user->username)->with('success', 'Data Staff Berhasil Diperbaharui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
