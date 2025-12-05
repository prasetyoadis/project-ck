<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Support\Str;
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
        # Set limit value from request or default is 5.
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
        return view('dashboard.admin.songs.create', [
            "title" => "Create Song",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Validasi form input.
        $dataValid = $request->validate([
            'nama_lagu' => 'required',
            'slug' => 'required|file|max:5120|mimes:mp3',
        ]);
        # set data dataValid 'uuid' dengan uniqid().
        $dataValid['uuid'] = uniqid();

        # Jika terdapat input file lagu.
        if ($request->file('slug')) {
            # Menyimpan Data File lagu Pada Directory Public Web dan Isi dataValid dengan Path Lokasi Gambar
            
            /**
             * Cara 1.
             * Menggunakan fitur laravel Storage::disk()->put().
             * 
             * @param use Illuminate\Support\Facades\Storage;
             */
            # $dataValid['slug'] = Storage::disk('public-web')->put('media/audio', $request->file('slug'));
            
            /**
             * Cara 2.
             * Mengunakan fitur php move(), jika ingin project dihosting.
             *
             * @param use Illuminate\Support\Str;
             */

            # Set input file ke dalam var lagu.
            $lagu = $request->file('slug');
            # Set nama dari lagu yang diupload.
            $lagu_nama = Str::random(40). '.'. $lagu->getClientOriginalExtension();
            # Simpan slug lagu ke dataValid->slug.
            $dataValid['slug'] = 'media/audio/'. $lagu_nama;
            # Proses penyimpanan.
            $lagu->move('media/audio/', $lagu_nama);
        }
        
        # Menyimpan dataValid ke model User.
        Song::create($dataValid);
        
        # mengalihkan ke halaman admin menu orders dengan success message.
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
        # Set rules of validation.
        $rules = [
            'nama_lagu' => 'required',
        ];
        # set rules jika ada input file mp3.
        if ($request->file('slug')) $rules['slug'] = 'required|file|max:5120|mimes:mp3';

        # Validasi form input dengan rules.
        $validator = Validator::make($request->all(), $rules);
        # Retrieve the validated input to dataValid
        $dataValid = $validator->validated();

        # Kalau ada input file lagu.
        if ($request->file('slug')) {
            # Hapus lagu yang ingin diganti.
            Storage::disk('public-web')->delete($song->slug);
            # Menyimpan Data File lagu Pada Directory Public Web dan Isi dataValid dengan Path Lokasi Gambar
            
            /**
             * Cara 1.
             * Menggunakan fitur laravel Storage::disk()->put().
             * 
             * @param use Illuminate\Support\Facades\Storage;
             */
            # $dataValid['slug'] = Storage::disk('public-web')->put('media/audio', $request->file('slug'));
            
            /**
             * Cara 2.
             * Mengunakan fitur php move(), jika ingin project dihosting.
             *
             * @param use Illuminate\Support\Str;
             */

            # Set input file ke dalam var lagu.
            $lagu = $request->file('slug');
            # Set nama dari lagu yang diupload.
            $lagu_nama = Str::random(40). '.'. $lagu->getClientOriginalExtension();
            # Simpan slug lagu ke dataValid->slug.
            $dataValid['slug'] = 'media/audio/'. $lagu_nama;
            # Proses penyimpanan.
            $lagu->move('media/audio/', $lagu_nama);
        }

        # Update data model song dengan dataValid.
        Song::where('id', $song->id)->update($dataValid);

        # Mengalihkan ke halaman admin menu songs dengan success message.
        return redirect('/admin/songs')->with('success', 'Data Song Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        # Hapus lagu yang berkaitan dengan data yang akan dihapus.
        Storage::disk('public-web')->delete($song->slug);

        # Delete data from model Song.
        Song::destroy($song->id);

        # Mengalihkan ke halaman admin menu songs dengan success message.
        return redirect('/admin/songs')->with('success', 'Data Song Berhasil Dihapus');
    }

}
