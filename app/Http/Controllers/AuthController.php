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
    /**
     * Display Halaman Login User Admin.
     */
    public function indexLogin(){
        return view('auth.login-admin', [
            "title" => "Login Admin Undangan"
        ]);
    }

    /**
     * Proses Login User Admin.
     */
    public function adminLogin(Request $request){
        # Validasi form input.
        $formValid = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        # Konversi data formValid 'username' dengan huruf kecil.
        $formValid['username'] = strtolower($formValid['username']);

        # Kalau data fromValid cocok autentik dengan model User.
        if (Auth::attempt($formValid)) {
            # Memperbarui session.
            $request->session()->regenerate();
            
            # Kalau data 'isactive' user adalah 0, false.
            if (auth()->user()->isactive == "0") {
                # Melogout akun user.
                Auth::logout();

                # Membatalkan session dan memperbarui token session.
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                # Return fail massage
                return back()->with('fail', 'Status Admin non-Aktif!');
            }
            # Mengalihkan ke halaman Admin Dashboard.
            return redirect()->intended('admin/dashboard');
        }
        # Return fail massage jika proses login tidak berhasil.
        return back()->with('fail', 'Data login Salah!');
    }

    /**
     * Proses Logout User Admin.
     */
    public function adminLogout(Request $request){
        # Melogout akun user.
        Auth::logout();

        # Membatalkan session dan memperbarui token session.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        # Mengalihkan ke halaman Login Admin.
        return redirect('/admin');
    }

    # Menampilkan Halaman Verify Email User Admin.
    public function index_verifyEmail() {
        return view('auth.verify-email', [
            "title" => "Verifikasi Email Ulang"
        ]);
    }

    /**
     * Proses Memverifikasi Token Verify Email.
     */
    public function token_verifyEmail(EmailVerificationRequest $request) {
        # Mengisi data 'email_verified_at' pada model user dengan datetime now.
        $request->fulfill();

        # Mengalihkan ke halaman Admin Dashboard.
        return redirect('/admin/dashboard');
    }

    /**
     * Proses Verifikasi Ulang Email.
     */
    public function verifyResend(Request $request) {
        # Send email verification notification.
        $request->user()->sendEmailVerificationNotification();
        
        # Return success message.
        return back()->with('success', 'Verifikasi Email Berhasil dikirim!');
    }

    /** 
     * Display Halaman Lupa Password User Admin.
     */
    public function indexForgotPass(){
        return view('auth.forgot-password', [
            "title" => "Lupa Password"
        ]);
    }

    /**
     * Proses Lupa Password.
     */
    public function forgotPass(Request $request){
        # Validasi form input.
        $formValid = $request->validate([
            'email' => 'required|email',
        ]);
        # Cek input email adalah bagian dari staff admin.
        $user = User::firstWhere('email', $formValid['email']);
        
        # Kalau ada data user dari input email, jika tidak return fail message.
        if ($user) {
            # Update data 'isrequest' user request dengan 1, true.
            User::where('id', $user->id)->update(['isreqreset' => '1']);
            
            # Add data 'timenow' user dengan date().
            $user['timenow'] = date('Y-m-d H:i:s');

            # Mengirim email ke email CeritaKita.
            Mail::to(new Address('ceritakita2509@gmail.com', 'CeritaKita'))->send(new ReqResetPassword($user));

            # Return success message.
            return back()->with('success', 'Permintaan Reset Password Berhasil dikirim!');
        } else{
            # Return fail message.
            return back()->with('fail', 'Email Tidak Ada Dalam Daftar Staff Admin!');
        }
    }
}
