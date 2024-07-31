<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Menampilkan Halaman Login User Admin
    public function indexLogin(){
        return view('dashboard.login', [
            "title" => "Login Admin Undangan"
        ]);
    }
    //Proses Login User Admin
    public function adminLogin(Request $request){
        $formValid = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $formValid['username'] = strtolower($formValid['username']);

        if (Auth::attempt($formValid)) {
            $request->session()->regenerate();
            
            if (auth()->user()->iadmin == "0") {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->with('loginError', 'Status Admin non-Aktif!!');
            }
            return redirect()->intended('/dashboard');
            
        }
        return back()->with('loginError', 'Data login Salah!!');
    }
    //Proses Logout User
    public function adminLogout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
