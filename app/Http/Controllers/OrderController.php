<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('dashboard.admin.orders.index',[
            "title" => "Orders",
            "orders" => Order::with('payment')->latest()->where('status', 'dp')->where('user_id', auth()->user()->id)->paginate(5)->appends(request()->all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.admin.orders.create', [
            "title" => "Create Order",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi Data Input
        $dataValid = $request->validate([
            'uuid' => 'required|unique:orders',
            'nama' => 'required|min:3',
            'email' => 'required|email',
            'no_hp' => 'required|min:9|max:15',
            'tgl_order' => 'required',
            'bukti_bayar' => 'required|image|file|max:2042|mimes:jpeg,png',
        ]);
        //Jika Terdapat Request file foto
        if ($request->file('bukti_bayar')) {
            //Menyimpan Data File foto Pada Directory Public Web dan Isi dataValid dengan Path Lokasi Gambar
            $dataPayment['bukti_bayar'] = Storage::disk('public-web')->put('img/payments', $request->file('bukti_bayar'));
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
        }
        
        $dataValid['user_id'] = auth()->user()->id;
        $dataValid['status'] = "dp";
        unset($dataValid['bukti_bayar']);
        
        //Menyimpan dataValid Ke Model User
        Order::create($dataValid);
        $order = Order::firstWhere('uuid', $request->uuid);

        $dataPayment['order_id'] = $order->id;
        $dataPayment['tgl_bayar'] = $dataValid['tgl_order'];
        Payment::create($dataPayment);
        
        //Redirect Halaman Admin Menu Orders
        return redirect('/admin/orders')->with('success', 'Data Order Berhasil Ditambahkan');
    }

    public function update(Request $request, Order $order)
    {
        //
        switch ($request->req) {
            case 'pelunasan':
                $dataPayment = $request->validate([
                    'tgl_bayar' => 'required',
                    'bukti_bayar' => 'required|image|file|max:2042',
                ]);
        
        
                if ($request->file('bukti_bayar')) {
                    //Menyimpan Data File foto Pada Directory Public Web dan Isi dataValid dengan Path Lokasi Gambar
                    $dataPayment['bukti_bayar'] = Storage::disk('public-web')->put('img/payments', $request->file('bukti_bayar'));
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
                }
                $dataPayment['order_id'] = $order->id;
               
                //Menyimpan data pelunasan payment
                Payment::create($dataPayment);
                //Mengupdate status Order
                Order::where('id', $order->id)->update(['status' => 'lunas']);
        
                //Redirect Halaman Admin Menu Transaksi Buku dengan get URL u=kd_anggota
                return redirect('/admin/orders')->with('success', 'Orders Telah Lunas');
                break;
            case 'pembatalan':
                return $order;
                Order::where('id', $order->id)->update(['status' => 'batal']);
                return redirect('/admin/orders')->with('success', 'Orders Telah Dibatalkan');
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
