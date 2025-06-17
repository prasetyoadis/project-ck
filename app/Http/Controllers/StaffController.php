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
    public function index(Request $request)
    {
        # Set greeting sesuai dengan waktu sekarang.
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Hi');
        $greeting = " ";
        if (($now >= "0000") && ($now <= "0400")) { $greeting = "Malam"; }
        elseif (($now >= "0401") && ($now <= "1100")) { $greeting = "Pagi"; }
        elseif (($now >= "1101") && ($now <= "1500")) { $greeting = "Siang";}
        elseif (($now >= "1501") && ($now <= "1830")) { $greeting = "Sore";}
        elseif (($now >= "1831")) { $greeting = "Malam";} 

        # Set limit value from request or default is 5.
        $limit = $request->input('limit', 5);
        
        return view('dashboard.admin.staff.index', [
            "title" => "Staff Admin",
            "users" => User::latest()->where('role', 'staff')->paginate($limit)->appends(request()->all()),
            "salam" => $greeting,
            "limit" => $limit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.staff.create',[
            "title" => "Add New Staff"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Validasi form input.
        $dataValid = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email',
            'no_hp' => 'required|min:9|max:15',
            'gender' => 'required',
            'role' => 'required|not_in:"-- Pilih Jabatan --"',
        ]);
        # set data dataValid 'password' dengan eksripsi input 'password', 'foto' dengan default sesuai gender, dan 'isactive' dengan default 1 true.
        $dataValid['password'] = Hash::make($request->password);
        $dataValid['foto'] = ($request->gender=='l') ? "img/users/default_profile_male.png" : "img/users/default_profile_female.png";
        $dataValid['isactive'] = "1";

        # Menyimpan dataValid ke model User.
        $user = User::create($dataValid);

        # set data user 'pass' dengan password sebelum di enkripsi, dan 'admin' dengan nama user yang sedang login.
        $user['pass'] = $request->password;
        $user['admin'] = auth()->user()->name;

        # Menjalankan event baru Registered dengan membawa data user.
        event(new Registered($user));

        # Mengalihkan ke halaman admin menu staff dengan success massage.
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
        # Mengalihkan proses berdasarkan $request->req.
        switch ($request->req) {
            case 'edit':
                # Make data rules for input request.
                $dataRules = [
                    'name' => 'required|min:3',
                    'email' => 'required|email',
                    'no_hp' => 'required|min:9|max:15',
                    'gender' => 'required',
                ];
                # Jika input role tidak sama dengan data role user set dataRules.
                if ($request->role != $user->role) $dataRules['role'] = 'required|not_in:"-- Pilih Jabatan --"';
                # Validasi Data dengan dataRules
                $dataValid = $request->validate($dataRules);

                # Kalau input email tidak sama dengan data email user.
                if($request->email != $user->email){
                    # set dataValid 'email_verified_at' dengan null.
                    $dataValid['email_verified_at'] = null;
                }
                
                # Update model User dengan dataValid berdasarkan user->id.
                $status = User::where('id', $user->id)->update($dataValid);

                # Set userUpdate dengan data user yang baru.
                $userUpdate = User::firstWhere('id', $user->id);

                # Kalau input email tidak sama dengan data email user.
                if($request->email != $user->email){
                    # Kalau status update berhasil.
                    if ($status) {
                        # Menjalankan event baru ReverifyEmail dengan membawa data userUpdate.
                        event(new ReverifyEmail($userUpdate));
                    }
                }
                
                # Mengalihkan ke halaman admin menu staff dengan success massage.
                return redirect('/admin/staff')->with('success', 'Data Staff Berhasil Diperbaharui');
                break;

            case 'resetPass':
                # Set randPass dengan string random dengan panjang 10 huruf, kemudian enkripsi randPass dan simpan di hashPass.
                $randPass = substr(str_shuffle('!@#$%^&*()-_+=<>?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=<>?'), 0,10);
                $hashPass = Hash::make($randPass);
                
                # Update data password, dan isrequest model User dengan hasPass, dan 0/false.
                $status = User::where('id', $user->id)->update(['password' => $hashPass, 'isreqreset' => '0']);
                
                # Kalau update berhasil.
                if ($status) {
                    # set data user 'pass' dengan randPass, dan 'admin' dengan nama user yang sedang login.
                    $user['pass'] = $randPass;
                    $user['admin'] = auth()->user()->name;
                    
                    # Kirim notify user PasswordResetEmail dengan membawa data user.
                    $user->notify(new PasswordResetEmail($user));
                    
                    # Mengalihkan ke halaman admin menu staff dengan success massage.
                    return redirect('/admin/staff')->with('success', 'Password Staff Telah Direset! Notifikasi Email Telah Dikirim.');
                } else {
                    # Mengalihkan ke halaman admin menu staff dengan fail massage.
                    return redirect('/admin/staff')->with('fail', 'Password Staff Gagal Direset!');
                }
                break;

            case 'status':
                # set status dengan kondisi jika isactive data user adalah 0 maka isi 1 jika tidak isi 2.
                $status = ($user->isactive == '0') ? '1' : '0';
                
                # Update data isactive model User dengan status.
                User::where('id', $user->id)->update(['isactive' => $status]);
                
                # Mengalihkan ke halaman admin menu staff dengan success massage.
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
