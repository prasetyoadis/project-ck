<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        # Set limit value from request or default is 5.
        $limit = $request->input('limit', 5);
        
        return view('dashboard.admin.orders.index',[
            "title" => "Orders",
            "orders" => Order::with(['payment', 'undangan'])->filter(request(['search']))->latest()->where('status', 'dp')->where('user_id', auth()->user()->id)->paginate($limit)->appends(request()->all()),
            "limit" => $limit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.orders.create', [
            "title" => "Create Order",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Validasi form input.
        $dataValid = $request->validate([
            'uuid' => 'required|unique:orders',
            'nama' => 'required|min:3',
            'email' => 'required|email',
            'no_hp' => 'required|min:9|max:15',
            'tgl_order' => 'required',
            'bukti_bayar' => 'required|image|file|max:2042|mimes:jpeg,png',
        ]);
        # Set input file ke dalam var foto.
        $foto = $request->file('bukti_bayar');

        # Kalau ada input file foto.
        if ($foto) {
            # Menyimpan Data File foto Pada Directory Public Web dan Isi dataValid dengan Path Lokasi Gambar
            
            /**
             * Cara 1.
             * Menggunakan fitur laravel Storage::disk()->put().
             * 
             * @param use Illuminate\Support\Facades\Storage;
             */
            # $dataPayment['bukti_bayar'] = Storage::disk('public-web')->put('img/payments', $request->file('bukti_bayar'));
            
            /**
             * Cara 2.
             * Mengunakan fitur php move(), jika ingin project dihosting.
             *
             * @param use Illuminate\Support\Str;
             */

            # Set nama dari foto yang diupload.
            $foto_nama = Str::random(40). '.'. $foto->getClientOriginalExtension();
            # Simpan slug foto ke dataPayment->bukti_bayar.
            $dataPayment['bukti_bayar'] = 'img/payments/'. $foto_nama;
            # Proses penyimpanan.
            $foto->move('img/payments/', $foto_nama);
        }
        # Set data user_id dan status dalam var dataValid.
        $dataValid['user_id'] = auth()->user()->id;
        $dataValid['status'] = "dp";
        # Menghapus array object 'bukti_bayar' dalam var dataValid.
        unset($dataValid['bukti_bayar']);
        
        # Menyimpan dataValid ke model User.
        Order::create($dataValid);
        # Set data order yang baru dibuat kedalam var order.
        $order = Order::firstWhere('uuid', $request->uuid);

        # Set data order_id dan tgl_bayar dalam var dataPayment.
        $dataPayment['order_id'] = $order->id;
        $dataPayment['tgl_bayar'] = $dataValid['tgl_order'];
        
        # Menyimpan dataPaymen ke model Payment.
        Payment::create($dataPayment);
        
        # Mengalihkan ke halaman admin menu orders dengan success massage.
        return redirect('/admin/orders')->with('success', 'Data Order Berhasil Ditambahkan');
    }

    public function update(Request $request, Order $order)
    {
        # Mengalihkan proses berdasarkan $request->req.
        switch ($request->req) {
            case 'pelunasan':
                # Validasi form input.
                $dataPayment = $request->validate([
                    'tgl_bayar' => 'required',
                    'bukti_bayar' => 'required|image|file|max:2042',
                ]);
        
                # Kalau ada input file foto.
                if ($request->file('bukti_bayar')) {
                    # Menyimpan Data File foto Pada Directory Public Web dan Isi dataValid dengan Path Lokasi Gambar
            
                    /**
                     * Cara 1.
                     * Menggunakan fitur laravel Storage::disk()->put().
                     * 
                     * @param use Illuminate\Support\Facades\Storage;
                     */
                    # $dataPayment['bukti_bayar'] = Storage::disk('public-web')->put('img/payments', $request->file('bukti_bayar'));
                    
                    /**
                     * Cara 2.
                     * Mengunakan fitur php move(), jika ingin project dihosting.
                     *
                     * @param use Illuminate\Support\Str;
                     */

                    # Set input file ke dalam var foto.
                    $foto = $request->file('bukti_bayar');
                    # Set nama dari foto yang diupload.
                    $foto_nama = Str::random(40). '.'. $foto->getClientOriginalExtension();
                    # Simpan slug foto ke dataPayment->bukti_bayar.
                    $dataPayment['bukti_bayar'] = 'img/payments/'. $foto_nama;
                    # Proses penyimpanan.
                    $foto->move('img/payments/', $foto_nama);
                }
                $dataPayment['order_id'] = $order->id;
               
                # Menyimpan dataPayment ke model Payment.
                Payment::create($dataPayment);
                
                # Update data status model Order dengan lunas.
                Order::where('id', $order->id)->update(['status' => 'lunas']);
        
                # Mengalihkan ke halaman admin menu order dengan success message.
                return redirect('/admin/orders')->with('success', 'Orders Telah Lunas');
                break;
            case 'pembatalan':
                return $order;
                # Update data status model Order dengan batal.
                Order::where('id', $order->id)->update(['status' => 'batal']);

                # Mengalihkan ke halaman admin menu order dengan success message.
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
