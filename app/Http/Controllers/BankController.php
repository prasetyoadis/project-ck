<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bank\StoreBankRequest;
use App\Http\Requests\Bank\UpdateBankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display Halaman Bank Admin Dashboard.
     * 
     * @param $request -> input('limit') or ('search')
     * 
     * @return view banks.index with title, banks, limit
     */
    public function index(Request $request)
    {
        # Set limit value from request or default is 5.
        $limit = $request->input('limit', 5);
        # Query Select data terbaru Bank dengan filter search dan paginate limit.
        $banks = Bank::filter(request(['search']))->latest()->paginate($limit)->appends(request()->all());

        return view('dashboard.admin.banks.index', [
            "title" => "Data Banks",
            "banks" => $banks,
            "limit" => $limit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return view banks.create with title
     */
    public function create()
    {
        return view('dashboard.admin.banks.create', [
            "title" => "Create Data Bank",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param ..\Request\Tag\StoreBankRequest $request -> inputan form
     * 
     * @return redirect halaman banks with success massage
     */
    public function store(StoreBankRequest $request)
    {
        # Validasi form input.
        $dataValid = $request->validated();

        # Menyimpan data valid ke model Bank.
        Bank::create($dataValid);
        
        # Mengalihkan ke halaman menu admin banks dengan success massage.
        return redirect('/admin/banks')->with('success', 'Data Bank Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param ..\Models\Bank $bank -> data model dari Route
     * 
     * @return view banks.edit with title, bank
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
     * 
     * @param ..\Request\Tag\UpdateBankRequest $request -> inputan form
     *        ..\Models\Bank $bank -> data model dari Route
     * 
     * @return redirect halaman banks with success massage
     */
    public function update(UpdateBankRequest $request, Bank $bank)
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
                    # Set massage.
                    $massage = 'Bank Telah Dinonaktifkan';
                } else {
                    # Set massage.
                    $massage = 'Bank Telah Aktifkan';
                }
                
                # Mengalihkan ke halaman menu admin banks dengan success massage.
                return redirect('/admin/banks')->with('success', $massage);
            break;
            case 'edit':
                # Validasi form input.
                $dataValid = $request->validated();
                
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
