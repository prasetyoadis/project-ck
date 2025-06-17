<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\ReverifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return view('dashboard.profile', [
            "title" => "My Profile"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.profile-edit', [
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
            'gender' => 'required',
            'no_hp' => 'required|min:9|max:15',
        ];
        if ($request->username != $user->username) $dataRules['username'] = 'required|unique:users';
        if ($request->foto != $user->foto) $dataRules['foto'] = 'image|file|max:1042|mimes:jpeg,png';

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

            return redirect('/admin')->with('success', 'Username Berhasil diganti. Silahkan Login Ulang!');
        }else {
            //Redirect Halaman Admin Menu Staff
            return redirect('/admin/@'. $user->username)->with('success', 'Data Staff Berhasil Diperbaharui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function passConfirm(Request $request)
    {
        $data = $request->validate([
            'confirmPass' => 'required'
        ]);

        if (password_verify($data['confirmPass'], auth()->user()->password)) {
            return back()->with('isConfirm', true);
        }else {
            return back()->with('isConfirm', false)->with('failPass', 'Password Salah!');
        }

    }

    public function passEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'newPass' => 'required',
            'repeatPass' => 'required|same:newPass',
        ]);
 
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->with('isConfirm', true)
                        ->withErrors($validator)
                        ->withInput();
        }
 
        // Retrieve the validated input...
        $data = $validator->validated();
        $passHash = Hash::make($data['newPass']);

        if (password_verify($data['newPass'], auth()->user()->password)) {
            # code...
            return redirect()->back()->with('isConfirm', true)->with('failPass', 'Password Sama Dengan Password Sebelumnya!');
        }else {
            # code...
            User::where('id', auth()->user()->id)->update(['password' => $passHash]);
            
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/admin')->with('success', 'Password Berhasil diganti. Silahkan Login Ulang!');
        }
    }

    public function emailEdit(Request $request)
    {
        if ($request->email != auth()->user()->email) {
            $dataRules['email'] = 'required|email';
        }else {
            return redirect()->back()->with('failEmail', 'Email Sama dengan Email Sebelumnya!');
        }
        //Validasi Data dengan dataRules
        $dataValid = $request->validate($dataRules);
        $dataValid['email_verified_at'] = null;
        
        //Update Dengan dataValid Pada Model User Berdasarkan id User
        $status = User::where('id', auth()->user()->id)->update($dataValid);

        $user = User::where('id', auth()->user()->id)->get();

        if ($status) {
            event(new ReverifyEmail($user[0]));
        }
        //Redirect Halaman Admin Menu Staff
        return redirect('email/verify')->with('success', 'Email Berhasil Diperbaharui. Silahkan Verifikasi Ulang!');
    }
}
