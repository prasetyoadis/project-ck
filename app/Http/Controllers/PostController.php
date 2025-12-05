<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Couple;
use App\Models\Donation;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Song;
use App\Models\Story;
use App\Models\Theme;
use App\Models\Undangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        # Set limit value from request or default is 5.
        $limit = $request->input('limit', 5);
        
        return view('dashboard.admin.posts.index',[
            "title" => "Undangan",
            "posts" => Undangan::with(['order', 'theme', 'events'])->filter(request(['search']))->latest()->whereRelation('order', 'user_id', auth()->user()->id)->paginate($limit)->appends(request()->all()),
            "limit" => $limit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $undangan = Undangan::with(['order', 'couple', 'theme', 'song'])->whereRelation('order', 'uuid', $request->oid)->get();
        // return $undangan;
        
        if ($undangan->count()) {
            $undanganid = $request->uid ?? "" ;
            $event = Event::with('undangan')->whereRelation('undangan', 'slug', $undanganid)->get();
            # code...
            if ($event->count()) {
                $story = Story::with('undangan')->whereRelation('undangan', 'slug', $undanganid)->get();
                if ($story->count()) {
                    $gallery = Gallery::with('undangan')->whereRelation('undangan', 'slug', $undanganid)->get();
                    if ($gallery->count()) {
                        $donation = Donation::with(['bank','undangan'])->whereRelation('undangan', 'slug', $undanganid)->get();
                        if ($donation->count()) {
                            session()->forget('step');
                            session()->put('step', '6');
                            session()->put('step', '6');
                        } else {
                            session()->forget('step');
                            session()->put('step', '5');
                        }
                        
                    } else {
                        session()->forget('step');
                        session()->put('step', '4');
                    }
                } else {
                    session()->forget('step');
                    session()->put('step', '3');
                }
            } else {
                session()->forget('step');
                session()->put('step', '2');
            }
            
            return view('dashboard.admin.posts.create', [
                "title" => "Create Post Undangan",
                "songs" => Song::all(),
                "themes" => Theme::all(),
                "banks" => Bank::all(),
                "undangan" => $undangan ?? [],
                "events" => $event ?? [],
                "stories" => $story ?? [],
                "galleries" => $gallery ?? [],
                "donations" => $donation ?? [],
            ]);
        }else {
            # code...
            session()->forget('step');
            return view('dashboard.admin.posts.create', [
                "title" => "Create Post Undangan",
                "songs" => Song::all(),
                "themes" => Theme::all(),
                "banks" => Bank::all(),
                "undangan" => [],
                "events" => [],
                "stories" => [],
                "galleries" => [],
                "donations" => [],
            ]);
        }
    }

    /**
     * Store a newly Post Invitations created resource in storage.
     */
    public function store(Request $request)
    {
        # Validasi form input.
        $dataValid = $request->validate([
            'uuid' => 'required',
            'slug' => 'required|min:3',
            'nama_pria' => 'required|min:3',
            'ayah_pria' => 'required|min:3',
            'ibu_pria' => 'required|min:3',
            'nama_wanita' => 'required|min:3',
            'ayah_wanita' => 'required|min:3',
            'ibu_wanita' => 'required|min:3',
            'theme_id' => 'required|not_in:"-- Pilih Tema --"',
            'song_id' => 'required|not_in:"-- Pilih Lagu --"',
        ]);
        # Set data order yang sesuai request uuid kedalam var order.
        $order = Order::firstWhere('uuid', $request->uuid);
        
        # Set data order_id, slug, theme_id dan song_id dalam var dataUndangan.
        $dataUndangan['order_id'] = $order->id;
        $dataUndangan['slug'] = $request->slug;
        $dataUndangan['theme_id'] = $request->theme_id;
        $dataUndangan['song_id'] = $request->song_id;

        // return $dataUndangan;
        # Menghapus array object "bukti_bayar" dalam var dataValid.
        unset($dataValid['song_id']);
        unset($dataValid['theme_id']);
        unset($dataValid['slug']);
        unset($dataValid['uuid']);
        
        // return $dataValid;
        # Menyimpan dataValid ke model Couple.
        Couple::create($dataValid);
        # Set data couple yang baru dibuat kedalam var couple.
        $couple = Couple::where('nama_pria', $request->nama_pria)->where('nama_wanita', $request->nama_wanita)->first();
        
        # Set data couple_id dengan couple->id.
        $dataUndangan['couple_id'] = $couple->id;
        # Menyimpan dataUndangan ke model Undangan.
        Undangan::create($dataUndangan);

        # Mengalihkan ke halaman admin menu invitations/create dengan oid = request->uuid dan uid = request->slug serta success massage dan step 2.
        return redirect('/admin/invitations/create?oid='.$request->uuid.'&uid='.$request->slug)->with('success', 'Undangan Berhasil Dibuat')->with('step', '2');
    }

    /**
     * Store a newly Events created resource in storage.
     */
    public function storeEvents(Request $request)
    {
        $undangan = Undangan::with('order')->where('slug', $request->uid)->whereRelation('order', 'uuid', $request->oid)->first();
        // return $undangan;
        $dataValid = $request->validate([
            'namaAcara.*' => 'required|min:3',
            'tgl_acara.*' => 'required|min:3',
            'lokasi.*' => 'required|min:3',
            'gmap.*' => 'required|min:3',
        ]);

        $data['undangan_id'] = $undangan->id;
        foreach ($request->namaAcara as $key => $value) {
            $data['nama_acara'] = $value;
            $data['tgl_acara'] = $request->tgl_acara[$key];
            $data['lokasi'] = $request->lokasi[$key];
            $data['link_gmaps'] = $request->gmap[$key];

            Event::create($data);
        }
        return redirect('/admin/invitations/create?oid='.$request->oid.'&uid='.$request->uid)->with('success', 'Data Events Berhasil Dilengkapi')->with('step', '3');
    }
    /**
     * Store a newly Stories created resource in storage.
     */
    public function storeStories(Request $request)
    {
        $undangan = Undangan::with('order')->where('slug', $request->uid)->whereRelation('order', 'uuid', $request->oid)->first();
        // return $undangan;
        $dataValid = $request->validate([
            'gambar.*' => 'required|min:3',
            'judul.*' => 'required|min:3',
            'deskripsi.*' => 'required|min:3',
        ]);

        $data['undangan_id'] = $undangan->id;
        foreach ($request->judul as $key => $value) {
            $data['judul'] = $value;
            $data['deskripsi'] = $request->deskripsi[$key];
            $data['gambar'] = Storage::disk('public-web')->put('img/stories/'. $request->uid, $request->file('gambar')[$key]);

            Story::create($data);
        }
        return redirect('/admin/invitations/create?oid='.$request->oid.'&uid='.$request->uid)->with('success', 'Data Stories Berhasil Dilengkapi')->with('step', '4');
    }
    /**
     * Store a newly Galleries created resource in storage.
     */
    public function storeGalleries(Request $request)
    {
        info($request->file('images'));
        $arr = array('oid' => $request->oid, 'uid' => $request->uid);
        echo json_encode($arr);
        $undangan = Undangan::with('order')->where('slug', $request->uid)->whereRelation('order', 'uuid', $request->oid)->first();
        
        $data['undangan_id'] = $undangan->id;
        if ($request->file('images')) {
            //Menyimpan data file gambar pada directory public-web dan isi dataValid dengan path lokasi gambar
            foreach ($request->file('images') as $key => $img) {
                $data['slug'] = Storage::disk('public-web')->put('img/galleries/'. $request->uid, $request->file('images')[$key]);
                
                Gallery::create($data);
            }

            /**
             * Jika Mau di upload di hosting bisa pakai
             *
             * @param use Illuminate\Support\Str;
             *
             * $gambar = $request->file('gambar');
             * $gambar_nama = Str::random(40). '.'. $request->file('gambar')->getClientOriginalExtension();
             * $dataValid['gambar'] = 'img/stories/'. $request->uid. $gambar_nama;
             * $gambar->move('img/stories/'. $request->uid, $gambar_nama);
             */
        }
    }
    function returnGallery(Request $request){
        return redirect('/admin/invitations/create?oid='.$request->oid.'&uid='.$request->uid)->with('success', 'Data Galleries Berhasil Dilengkapi')->with('step', '5');
    }
    /**
     * Store a newly Stories created resource in storage.
     */
    public function storeDonations(Request $request)
    {
        $undangan = Undangan::with('order')->where('slug', $request->uid)->whereRelation('order', 'uuid', $request->oid)->first();
        // return $undangan;
        $dataValid = $request->validate([
            'bank_id.*' => 'required|not_in:"-- Pilih Bank --"',
            'nama_pemilik.*' => 'required|min:3',
            'no_rek.*' => 'required|min:3',
        ]);

        $data['undangan_id'] = $undangan->id;
        foreach ($request->nama_pemilik as $key => $value) {
            $data['bank_id'] = $request->bank_id[$key];
            $data['nama_pemilik'] = $value;
            $data['no_rek'] = $request->no_rek[$key];

            Donation::create($data);
        }
        return redirect('/admin/invitations/create?oid='.$request->oid.'&uid='.$request->uid)->with('success', 'Data Donations Berhasil Dilengkapi')->with('step', '6');
    }

    /**
     * Display the specified resource.
     */
    public function show(Undangan $undangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Undangan $undangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Undangan $undangan)
    {
        //
        switch ($request->type) {
            case 'complete':
                # code...
                Undangan::where('id', $undangan->id)->update(['iscomplete' => '1']);
        
                return redirect('/admin/invitations/')->with('success', 'Undangan Berhasil Dipublish');
            break;
            default:
                $undangan = Undangan::with('order')->where('order_id', $undangan->order_id)->first();
                $dataRules = [
                    'theme_id' => 'required|not_in:"-- Pilih Tema --"',
                    'song_id' => 'required|not_in:"-- Pilih Lagu --"',
                ];
                //Jika Request slug Tidak Sama Dengan Data slug Undangan Isi Rule Data
                if($undangan->slug != $request->slug){
                    $dataRules['slug'] = 'required|unique:undangans';
                }
                
                //Validasi Data dengan dataRules
                $dataValid = $request->validate($dataRules);
        
                Undangan::where('id', $undangan->id)->update($dataValid);
        
                return redirect('/admin/invitations/create?oid='.$undangan->order->uuid.'&uid='.$undangan->slug. '#undangan')->with('success', 'Data Undangan Berhasil Diedit')->with('step', '6');
            break;
        }
    }
    
    public function updateCouple(Request $request, Couple $couple)
    {
        //Validasi request data input mempelai method post
        // return $couple;
        $dataValid = $request->validate([
            'nama_pria' => 'required|min:3',
            'ayah_pria' => 'required|min:3',
            'ibu_pria' => 'required|min:3',
            'nama_wanita' => 'required|min:3',
            'ayah_wanita' => 'required|min:3',
            'ibu_wanita' => 'required|min:3',
        ]);

        Couple::where('id', $couple->id)->update($dataValid);
    
        return redirect('/admin/invitations/create?oid='.$request->oid.'&uid='.$request->uid. '#couples')->with('success', 'Data Mempelai Berhasil Diedit')->with('step', '6');
    }
    
    public function updateEvent(Request $request, Event $event)
    {
        //Validasi request data input event method post
        // return $event;
        $dataValid = $request->validate([
            'nama_acara' => 'required|min:3',
            'tgl_acara' => 'required|min:3',
            'lokasi' => 'required|min:3',
            'link_gmaps' => 'required|min:3',
        ]);

        Event::where('id', $event->id)->update($dataValid);

        return redirect('/admin/invitations/create?oid='.$request->oid.'&uid='.$request->uid. '#events')->with('success', 'Data Event Berhasil Diedit')->with('step', '6');
    }

    public function updateStory(Request $request, Story $story)
    {
        //
        $dataRules = [
            'gambar' => 'image|file|max:2042',
            'judul' => 'required|min:3',
            'deskripsi' => 'required|min:3',
        ];
        $dataValid = $request->validate($dataRules);

        if ($request->file('gambar')) {
            //Hapus Data gambar story pada directory public web
            Storage::disk('public-web')->delete($story->gambar);
            /**
             * Jika Mau di upload di hosting bisa pakai
             *
             * @param use Illuminate\Support\Facades\File;
             *
             * File::delete('/home/folderweb/public_html/. $story->gambar);
             */

            //Menyimpan data file gambar pada directory public-web dan isi dataValid dengan path lokasi gambar
            $dataValid['gambar'] = Storage::disk('public-web')->put('img/stories/'. $request->uid, $request->file('gambar'));
            /**
             * Jika Mau di upload di hosting bisa pakai
             *
             * @param use Illuminate\Support\Str;
             *
             * $gambar = $request->file('gambar');
             * $gambar_nama = Str::random(40). '.'. $request->file('gambar')->getClientOriginalExtension();
             * $dataValid['gambar'] = 'img/stories/'. $request->uid. $gambar_nama;
             * $gambar->move('img/stories/'. $request->uid, $gambar_nama);
             */
        }
        //Validasi Data dengan dataRules
        
        Story::where('id', $story->id)->update($dataValid);

        return redirect('/admin/invitations/create?oid='.$request->oid.'&uid='.$request->uid. '#stories')->with('success', 'Data Story Berhasil Diedit')->with('step', '6');
    }

    public function updateGallery(Request $request, Gallery $gallery)
    {
        //
        $dataValid = $request->validate([
            'slug' => 'image|file|max:2042',
        ]);

        if ($request->file('slug')) {
            //Hapus Data gambar gallery pada directory public web
            Storage::disk('public-web')->delete($gallery->slug);
            /**
             * Jika Mau di upload di hosting bisa pakai
             *
             * @param use Illuminate\Support\Facades\File;
             *
             * File::delete('/home/folderweb/public_html/. $gallery->slug);
             */

            //Menyimpan data file gambar pada directory public-web dan isi dataValid dengan path lokasi gambar
            $dataValid['slug'] = Storage::disk('public-web')->put('img/galleries/'. $request->uid, $request->file('slug'));
            /**
             * Jika Mau di upload di hosting bisa pakai
             *
             * @param use Illuminate\Support\Str;
             *
             * $gambar = $request->file('gambar');
             * $gambar_nama = Str::random(40). '.'. $request->file('gambar')->getClientOriginalExtension();
             * $dataValid['gambar'] = 'img/galleries/'. $request->uid. $gambar_nama;
             * $gambar->move('img/galleries/'. $request->uid, $gambar_nama);
             */
        }

        Gallery::where('id', $gallery->id)->update($dataValid);

        return redirect('/admin/invitations/create?oid='.$request->oid.'&uid='.$request->uid. '#galleries')->with('success', 'Data Gallery Berhasil Diedit')->with('step', '6');
    }

    public function updateDonation(Request $request, Donation $donation)
    {
        //
        $dataValid = $request->validate([
            'bank_id' => 'required|not_in:"-- Pilih Bank --"',
            'nama_pemilik' => 'required|min:3',
            'no_rek' => 'required|min:3',
        ]);

        Donation::where('id', $donation->id)->update($dataValid);

        return redirect('/admin/invitations/create?oid='.$request->oid.'&uid='.$request->uid. '#donations')->with('success', 'Data Donasi Berhasil Diedit')->with('step', '6');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Undangan $undangan)
    {
        //
    }
}
