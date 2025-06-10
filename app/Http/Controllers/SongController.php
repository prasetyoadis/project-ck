<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        //set limit value from request or default is 5
        $limit = $request->input('limit', 5);

        return view('dashboard.admin.songs.index', [
            "title" => "Songs",
            "songs" => Song::filter(request(['search']))->latest()->paginate($limit)->appends(request()->all()),
            "limit" => $limit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.admin.songs.create', [
            "title" => "Create Song",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi Data Input
        $dataValid = $request->validate([
            'nama_lagu' => 'required',
            'slug' => 'required|file|max:5120|mimes:mp3',
        ]);
        $dataValid['uuid'] = uniqid();
        //Jika Terdapat Request file foto
        if ($request->file('slug')) {
            //Menyimpan Data File foto Pada Directory Public Web dan Isi dataValid dengan Path Lokasi Gambar
            $dataValid['slug'] = Storage::disk('public-web')->put('media/audio', $request->file('slug'));
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
        
        //Menyimpan dataValid Ke Model User
        Song::create($dataValid);
        
        //Redirect Halaman Admin Menu Orders
        return redirect('/admin/songs')->with('success', 'Data Song Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        //
        return view('dashboard.admin.songs.edit', [
            "title" => "Edit Song", 
            "song" => $song, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        //
        $rules = [
            'nama_lagu' => 'required',
        ];
        if ($request->file('slug')) $rules['slug'] = 'required|file|max:5120|mimes:mp3';

        $validator = Validator::make($request->all(), $rules);

        // Retrieve the validated input
        $dataValid = $validator->validated();

        if ($request->file('slug')) {
            //Hapus lagu yang ingin diganti
            Storage::disk('public-web')->delete($song->slug);
            //Menyimpan Data File lagu Pada Directory Public Web dan Isi dataValid dengan Path Lokasi Gambar
            $dataValid['slug'] = Storage::disk('public-web')->put('media/audio', $request->file('slug'));
            /**
             * Jika Mau di upload di hosting bisa pakai
             *
             * @param use Illuminate\Support\Str;
             *
             * $lagu = $request->file('slug');
             * $lagu_nama =  Str::random(40). '.'. $lagu->getClientOriginalExtension();
             * $dataValid['slug'] = 'media/audio/'. $lagu_nama;
             * $lagu->move('media/audio/', $lagu_nama);
             */
        }

        Song::where('id', $song->id)->update($dataValid);

        return redirect('/admin/songs')->with('success', 'Data Song Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        //
        Storage::disk('public-web')->delete($song->slug);

        Song::destroy($song->id);

        return redirect('/admin/songs')->with('success', 'Data Song Berhasil Dihapus');
    }

}
