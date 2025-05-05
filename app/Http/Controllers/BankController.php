<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('dashboard.admin.banks.index', [
            "title" => "Data Banks",
            "banks" => Bank::latest()->paginate(5)->appends(request()->all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.admin.banks.create', [
            "title" => "Create Data Bank",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $dataValid = $request->validate([
            'code' => 'required',
            'nama_bank' => 'required|min:3',
            'isactive' => 'required',
        ]);

        Bank::create($dataValid);

        return redirect('/admin/banks')->with('success', 'Data Bank Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        //
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
        //
        switch ($request->req) {
            case 'status':
                $status = ($bank->isactive == '1') ? '0' : '1' ;

                Bank::where('id', $bank->id)->update(['isactive' => $status]);
                if ($status=='0') {
                    # code...
                    return redirect('/admin/banks')->with('success', 'Bank Telah Dinonaktifkan');
                } else {
                    # code...
                    return redirect('/admin/banks')->with('success', 'Bank Telah Aktifkan');
                }
                
            break;
            case 'edit':
                $dataValid = $request->validate([
                    'code' => 'required',
                    'nama_bank' => 'required|min:3'
                ]);
        
                Bank::where('id', $bank->id)->update($dataValid);
        
                return redirect('/admin/banks')->with('success', 'Data Bank Berhasil Diedit');
            break;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        //
    }
}
