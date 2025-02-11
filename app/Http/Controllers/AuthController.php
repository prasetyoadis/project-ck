<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ReqResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    //Menampilkan Halaman Login User Admin
    public function indexLogin(){
        return view('auth.login-admin', [
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
            
            if (auth()->user()->isactive == "0") {
                Auth::logout();
                
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->with('error', 'Status Admin non-Aktif!!');
            }
            return redirect()->intended('admin/dashboard');
            
        }
        return back()->with('error', 'Data login Salah!!');
    }
    //Proses Logout User
    public function adminLogout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin');
    }

    public function index_verifyEmail() {
        return view('auth.verify-email', [
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
     
        return back()->with('success', 'Verifikasi Email Berhasil dikirim!');
    }

    public function indexForgotPass(){
        return view('auth.forgot-password', [
            "title" => "Lupa Password"
        ]);
    }

    public function forgotPass(Request $request){
        //Cek input Email adalah bagian dari staff admin
        $formValid = $request->validate([
            'email' => 'required|email',
        ]);
        $isExist = User::where('email', $formValid['email'])->get();
        
        if ($isExist->count() == 1) {
            User::where('id', $isExist[0]->id)->update(['isreqreset' => '1']);

            $isExist[0]['timenow'] = date('Y-m-d H:i:s');

            Mail::to(new Address('ceritakita2509@gmail.com', 'CeritaKita'))->send(new ReqResetPassword($isExist));

            return back()->with('success', 'Permintaan Reset Password Berhasil dikirim!');
        } else{
            return back()->with('error', 'Email Tidak Ada Dalam Daftar Staff Admin!');
        }
    }
}
