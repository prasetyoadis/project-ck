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

    public function indexSettings() {
        return view('dashboard.settings', [
            "title" => "Settings",
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
    public function indexDemoUndangan(Theme $theme, Request $request) {
        $undangan = Undangan::with(['donations', 'donations.bank'])->firstWhere('id', 1);
        
        $theme = Theme::with('category')->firstWhere('id', $theme->id);
        // return $theme;
        $data = (object) [
            "slug" => "tulus-eva",
            "iscomplate" => "1",
            "couple" => (object) [
                "nama_pria" => "Muhammad Tulus",
                "ayah_pria" => "Lucas",
                "ibu_pria" => "Salsabila",
                "nama_wanita" => "Lidya Nurmala Eva",
                "ayah_wanita" => "Alfaruq",
                "ibu_wanita" => "Wati"
            ],
            "song" => (object) [
                "nama_lagu" => "Teman Hidup - Tulus",
                "slug" => "media\/audio\/mEhJh5S99M6jF4pwQn0x57tJXi3hOY2C9CjKaPM3.mp3"
            ],
            "events" => [
                (object) [
                    "nama_acara" => "Akad Nikah",
                    "tgl_acara" => "2025-10-26 08:00:00",
                    "lokasi" => "Masjid Baiturrahim",
                    "link_gmaps" => "https:\/\/maps.app.goo.gl\/FsbNUHELqkTUv6h89"
                ],
                (object) [
                    "nama_acara" => "Resepsi Pernikahan",
                    "tgl_acara" => "2025-10-26 10:00:00",
                    "lokasi" => "Kediaman Mempelai Wanita",
                    "link_gmaps" => "https:\/\/maps.app.goo.gl\/z8iJh56zuko4h7y89"
                ]
            ],
            "stories" => [
                (object) [
                    "judul" => "First Meet at Terminal Giwangan",
                    "deskripsi" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda corporis incidunt ducimus voluptatibus, debitis cum voluptate beatae eveniet provident pariatur explicabo mollitia consectetur impedit magni!",
                    "gambar" => "assets\/img\/undangan\/pernikahan\/stories\/tulus-eva\/1.terminal-giwangan.jpg"
                ],
                (object) [
                    "judul" => "First Date",
                    "deskripsi" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda corporis incidunt ducimus voluptatibus, debitis cum voluptate beatae eveniet provident pariatur explicabo mollitia consectetur impedit magni!",
                    "gambar" => "assets\/img\/undangan\/pernikahan\/stories\/tulus-eva\/2.parangtritis.jpg"
                ],
                (object) [
                    "judul" => "In Relationship",
                    "deskripsi" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda corporis incidunt ducimus voluptatibus, debitis cum voluptate beatae eveniet provident pariatur explicabo mollitia consectetur impedit magni!",
                    "gambar" => "assets\/img\/undangan\/pernikahan\/stories\/tulus-eva\/3.relationship.jpg"
                ],
                (object) [
                    "judul" => "Engagement",
                    "deskripsi" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda corporis incidunt ducimus voluptatibus, debitis cum voluptate beatae eveniet provident pariatur explicabo mollitia consectetur impedit magni!",
                    "gambar" => "assets\/img\/undangan\/pernikahan\/stories\/tulus-eva\/4.engagement.jpg"
                ],
                (object) [
                    "judul" => "Planning to Wedding's",
                    "deskripsi" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda corporis incidunt ducimus voluptatibus, debitis cum voluptate beatae eveniet provident pariatur explicabo mollitia consectetur impedit magni!",
                    "gambar" => "assets\/img\/undangan\/pernikahan\/stories\/tulus-eva\/5.nikah.jpg"
                ],
            ],
            "galleries" => [
                (object) [
                    "slug" => "assets\/img\/undangan\/pernikahan\/galleries\/tulus-eva\/1.webp"
                ],
                (object) [
                    "slug" => "assets\/img\/undangan\/pernikahan\/galleries\/tulus-eva\/2.webp"
                ],
                (object) [
                    "slug" => "assets\/img\/undangan\/pernikahan\/galleries\/tulus-eva\/3.webp"
                ],
                (object) [
                    "slug" => "assets\/img\/undangan\/pernikahan\/galleries\/tulus-eva\/4.webp"
                ],
                (object) [
                    "slug" => "assets\/img\/undangan\/pernikahan\/galleries\/tulus-eva\/5.webp"
                ],
                (object) [
                    "slug" => "assets\/img\/undangan\/pernikahan\/galleries\/tulus-eva\/6.webp"
                ],
                (object) [
                    "slug" => "assets\/img\/undangan\/pernikahan\/galleries\/tulus-eva\/7.webp"
                ],
                (object) [
                    "slug" => "assets\/img\/undangan\/pernikahan\/galleries\/tulus-eva\/8.png"
                ],
            ],
            "donations" => [
                (object) [
                    "bank_id" => 2,
                    "nama_pemilik" => "MUHAMMAD TULUS",
                    "no_rek" => "89888889988",
                    "bank" => (object) [
                        "code" => "999",
                        "nama_bank" => "DANA"
                    ],
                ],
                (object) [
                    "bank_id" => 3,
                    "nama_pemilik" => "LIDYA NURMALA EVA",
                    "no_rek" => "78786789908987",
                    "bank" => (object) [
                        "code" => "014",
                        "nama_bank" => "BCA"
                    ],
                ],
            ],
        ];
        // return $data;

        return view('/tema/'. $theme->category->slug .'/'. $theme->slug, [
            "title" => "Axel & Michelle",
            "to" => $request->to,
            "undangan" => $data,
        ]);

    }

    /**
     * Display a listing of the backend page.
     */
    public function indexDashboard() {
        $unprogressOrders = Order::with('payment')->latest()->where('status', 'dp')->where('user_id', auth()->user()->id)->limit(5)->get();
        $totalOrdersLunas = Order::with('payment')->where('status', 'lunas')->count();
        $totalUndangan = Undangan::count();
        $countNowOrderLunas = Order::with('payment')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->where('status', 'lunas')->count();
        $countNowOrderBatal = Order::with('payment')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->where('status', 'batal')->count();
        $countNowUndangan = Undangan::where('created_at', 'like', '%' . date('Y-m-d') . '%')->count();
        $userDoneOrder = Order::with('payment')->where('status', 'lunas')->where('user_id', auth()->user()->id)->count();
        $countNowUserDoneOrder = Order::with('payment')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->where('status', 'lunas')->where('user_id', auth()->user()->id)->count();

        return view('dashboard.admin.index', [
            "title" => "Dashboard",
            "unprogress_orders" => $unprogressOrders,
            "total_order_lunas" => $totalOrdersLunas,
            "total_undangan" => $totalUndangan,
            "penambahan_order_lunas" => $countNowOrderLunas,
            "penurunan_order_batal" => $countNowOrderBatal,
            "penambahan_undangan" => $countNowUndangan,
            "order_profil_lunas" => $userDoneOrder,
            "penambahan_order_profil_lunas" => $countNowUserDoneOrder,
        ]);
    }


}
