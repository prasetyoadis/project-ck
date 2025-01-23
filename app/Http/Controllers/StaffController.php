<?php

namespace App\Http\Controllers;

use App\Events\ReverifyEmail;
use App\Models\User;
use App\Notifications\PasswordResetEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Hi');
        $greeting = " ";
        if (($now >= "0000") && ($now <= "0400")) { $greeting = "Malam"; }
        elseif (($now >= "0401") && ($now <= "1100")) { $greeting = "Pagi"; }
        elseif (($now >= "1101") && ($now <= "1500")) { $greeting = "Siang";}
        elseif (($now >= "1501") && ($now <= "1830")) { $greeting = "Sore";}
        elseif (($now >= "1831")) { $greeting = "Malam";} 
        
        return view('dashboard.admin.staff.index', [
            "title" => "Staff Admin",
            "users" => User::latest()->where('role', 'staff')->paginate(5)->appends(request()->all()),
            "salam" => $greeting
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.admin.staff.create',[
            "title" => "Add New Staff"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi Data Input
        $dataValid = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'name' => 'required|min:3',
            'email' => 'required',
            'no_hp' => 'required|min:9|max:15',
            'gender' => 'required',
            'role' => 'required|not_in:"-- Pilih Jabatan --"',
        ]);
        $dataValid['password'] = Hash::make($request->password);
        $dataValid['foto'] = ($request->gender=='l') ? "img/users/default_profile_male.png" : "img/users/default_profile_female.png";
        $dataValid['isadmin'] = "1";

        $user = User::create($dataValid);

        $user['pass'] = $request->password;
        $user['admin'] = auth()->user()->name;

        event(new Registered($user));

        //Redirect Halaman Admin Menu Staff
        return redirect('/admin/staff')->with('success', 'Data Staff Baru Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.admin.staff.edit',[
            "title" => "Edit Data Staff",
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        switch ($request->req) {
            case 'edit':
                //Data Rules for Input Request
                $dataRules = [
                    'name' => 'required|min:3',
                    'email' => 'required|email',
                    'no_hp' => 'required|min:9|max:15',
                    'gender' => 'required',
                ];
                
                //Jika Request Role Tidak Sama Dengan Data Role User Isi Rule Data Role
                if ($request->role != $user->role) $dataRules['role'] = 'required|not_in:"-- Pilih Jabatan --"';
                //Validasi Data dengan dataRules
                $dataValid = $request->validate($dataRules);

                if($request->email != $user->email){
                    $dataValid['email_verified_at'] = null;
                }
                //Update Dengan dataValid Pada Model User Berdasarkan id User
                $status = User::where('id', $user->id)->update($dataValid);

                if($request->email != $user->email){
                    if ($status) {
                        event(new ReverifyEmail($user));
                    }
                }
                //Redirect Halaman Admin Menu Staff
                return redirect('/admin/staff')->with('success', 'Data Staff Berhasil Diperbaharui');
                break;

            case 'resetPass':
                $randPass = substr(str_shuffle('!@#$%^&*()-_+=<>?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=<>?'), 0,10);
                $hashPass = Hash::make($randPass);
                
                $status = User::where('id', $user->id)->update(['password' => $hashPass]);
                
                if ($status) {
                    # code...
                    $user['pass'] = $randPass;
                    $user['admin'] = auth()->user()->name;
                    
                    $user->notify(new PasswordResetEmail($user));
                    
                    return redirect('/admin/staff')->with('success', 'Password Staff Telah Direset! Notifikasi Email Telah Dikirim.');
                } else {
                    # code...
                    return redirect('/admin/staff')->with('fail', 'Password Staff Gagal Direset!');
                }
                break;

            case 'status':
                User::where('id', $user->id)->update(['isadmin' => ($user->isadmin==='0') ? '1' : '0']);
                //Redirect Halaman Admin Menu Staff
                return redirect('/admin/staff')->with('success', 'Status Staff Telah Diubah');
                break;
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
