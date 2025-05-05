<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Theme;
use App\Models\Undangan;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the fondend page.
     *
     * List Page of home etc. 
     */
    public function index() {
        return view('home',[
            "title" => "Home"
        ]);
    }

    public function indexAbout() {
        return view('about', [
            "title" => "About"
        ]);
    }

    public function indexHelp() {
        return view('help', [
            "title" => "Help"
        ]);
    }

    public function indexKatalog() {
        return view('katalog', [
            "title" => "Katalog"
        ]);
    }

    public function indexBlog() {
        return view('Blog', [
            "title" => "Blog"
        ]);
    }

    public function indexTestimoni() {
        return view('testimoni', [
            "title" => "Testimoni"
        ]);
    }

    /**
     * Display a listing of the katalog invitation.
     */
    public function indexDemoUndangan($slug ,Undangan $undangan, Request $request) {
        $undangan = Undangan::with(['couple', 'song', 'theme'])->where('id', $undangan->id)->first();
        // return $undangan;
        return view('/tema/pernikahan/akad-nikah', [
            "title" => "Axel & Michelle",
            "to" => $request->to,
            "undangan" => $undangan,
        ]);

    }

    /**
     * Display a listing of the backend page.
     */
    public function indexDashboard() {
        
        return view('dashboard.admin.index', [
            "title" => "Dashboard",
            "unprogress_orders" => Order::with('payment')->latest()->where('status', 'dp')->where('user_id', auth()->user()->id)->limit(5)->get(),
            "total_order_lunas" => Order::with('payment')->where('status', 'lunas')->count(),
            "total_undangan" => Undangan::count(),
            "penambahan_order_lunas" => Order::with('payment')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->where('status', 'lunas')->count(),
            "penurunan_order_batal" => Order::with('payment')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->where('status', 'batal')->count(),
            "penambahan_undangan" => Undangan::where('created_at', 'like', '%' . date('Y-m-d') . '%')->count(),
            "order_profil_lunas" => Order::with('payment')->where('status', 'lunas')->where('user_id', auth()->user()->id)->count(),
            "penambahan_order_profil_lunas" => Order::with('payment')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->where('status', 'lunas')->where('user_id', auth()->user()->id)->count(),
        ]);
    }


}
