<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    //Menampilkan Halaman Login User Admin
    public function indexLogin(){
        return view('dashboard.auth.login-admin', [
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
            
            if (auth()->user()->isadmin == "0") {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->with('loginError', 'Status Admin non-Aktif!!');
            }
            return redirect()->intended('admin/dashboard');
            
        }
        return back()->with('loginError', 'Data login Salah!!');
    }
    //Proses Logout User
    public function adminLogout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin');
    }

    public function index_verifyEmail() {
        return view('dashboard.auth.verify-email', [
            "title" => "Verifikasi Email Ulang"
        ]);
    }

    public function token_verifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/admin/dashboard');
    }

    // public function verifyFulfill(){
        
    // }

    public function verifyResend(Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verifikasi email dikirim!');
    }
}
