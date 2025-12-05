<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display Halaman Bank Admin Dashboard.
     */
    public function index(Request $request)
    {
        # Set limit value from request or default is 5.
        $limit = $request->input('limit', 5);

        return view('dashboard.admin.banks.index', [
            "title" => "Data Banks",
            "banks" => Bank::filter(request(['search']))->latest()->paginate($limit)->appends(request()->all()),
            "limit" => $limit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.banks.create', [
            "title" => "Create Data Bank",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Validasi form input.
        $dataValid = $request->validate([
            'code' => 'required',
            'nama_bank' => 'required|min:3',
            'isactive' => 'required',
        ]);

        # Menyimpan data valid ke model Bank.
        Bank::create($dataValid);
        
        # Mengalihkan ke halaman menu admin banks dengan success massage.
        return redirect('/admin/banks')->with('success', 'Data Bank Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        return view('dashboard.admin.banks.edit', [
            "title" => "Edit Data Bank",
            "bank" => $bank,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        # Mengalihkan proses berdasarkan $request->req.
        switch ($request->req) {
            case 'status':
                # set status dengan kondisi jika isactive model Bank adalah 1 maka isi 0 jika tidak isi 1.
                $status = ($bank->isactive == '1') ? '0' : '1' ;

                # Update data isactive model Bank dengan status.
                Bank::where('id', $bank->id)->update(['isactive' => $status]);
                
                # Kalau status merupakan 0 beri pesan success ".. dinonaktifkan", selain itu beri pesan success ".. aktifkan".
                if ($status=='0') {
                    # Mengalihkan ke halaman menu admin banks dengan success massage.
                    return redirect('/admin/banks')->with('success', 'Bank Telah Dinonaktifkan');
                } else {
                    # Mengalihkan ke halaman menu admin banks dengan success massage.
                    return redirect('/admin/banks')->with('success', 'Bank Telah Aktifkan');
                }
                
            break;
            case 'edit':
                # Validasi form input.
                $dataValid = $request->validate([
                    'code' => 'required',
                    'nama_bank' => 'required|min:3'
                ]);
                
                # Update model bank dengan dataValid.
                Bank::where('id', $bank->id)->update($dataValid);
                
                # Mengalihkan ke halaman menu admin banks dengan success massage.
                return redirect('/admin/banks')->with('success', 'Data Bank Berhasil Diedit');
            break;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        #
    }
}
