<?php

namespace App\Http\Controllers\Frontend;

use Carbon\carbon;
use App\Models\kamar;
use App\Models\Promo;
use App\Models\SimpanKamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendsController extends Controller
{
    // Homepage
    public function homepage(Request $request)
    {
        $cari = $request->cari;
        $kamar = kamar::with('promo')
            ->when(isset($cari), function ($a) use ($cari) {
                $a->whereHas('provinsi', function ($q) use ($cari) {
                    $q->where('name', 'like', "%" . $cari . "%");
                })
                    ->orwhereHas('regencies', function ($q) use ($cari) {
                        $q->where('name', 'like', "%" . $cari . "%");
                    })
                    ->orwhereHas('district', function ($q) use ($cari) {
                        $q->where('name', 'like', "%" . $cari . "%");
                    });
                $a->orwhere('nama_kamar', 'like', "%" . $cari . "%");
            })
            ->where('status', 1)
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(8);
        $promo = Promo::whereHas('kamar', function ($a) {
            $a->where('status', 1)->where('is_active', 1);
        })->where('end_date_promo', '>=', carbon::now()->format('d F, Y'))->get();
        return view('front.index', \compact('kamar', 'promo'));
    }

    // Show Kamar
    public function showkamar($slug)
    {
        $kamar = kamar::with('province')
            ->with('promo', function ($q) {
                $q->where('status', '1');
            })
            ->where('slug', $slug)->first();
        $fav = SimpanKamar::where('kamar_id', $kamar->id)->where('user_id', Auth::id())->first();
        $relatedKos = kamar::with(['promo' => function ($a) {
            $a->where('end_date_promo', '>=', carbon::now()->format('d F, Y'));
        }])->whereNotIn('slug', [$slug])
            ->where('province_id', [$kamar->province_id])
            ->where('status', 1)
            ->where('is_active', 1)
            ->limit(4)->get();

        return view('front.show', compact('kamar', 'relatedKos', 'fav'));
    }

    // Show semua kamar
    public function showAllKamar(Request $request)
    {
        $cari = $request->cari;
        $allKamar = kamar::with(['promo' => function ($a) {
            $a->where('end_date_promo', '>=', carbon::now()->format('d F, Y'));
        }])
            ->when(isset($cari), function ($a) use ($cari) {
                $a->whereHas('provinsi', function ($q) use ($cari) {
                    $q->where('name', 'like', "%" . $cari . "%");
                })
                    ->orwhereHas('regencies', function ($q) use ($cari) {
                        $q->where('name', 'like', "%" . $cari . "%");
                    })
                    ->orwhereHas('district', function ($q) use ($cari) {
                        $q->where('name', 'like', "%" . $cari . "%");
                    });

                $a->orwhere('nama_kamar', 'like', "%" . $cari . "%");
                $a->orwhereHas('favorite', function ($q) use ($cari) {
                    $q->where('user_id', 'like', "%" . $cari . "%")
                        ->where('user_id', Auth::id());
                });
            })
            ->where('status', 1)
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        $provinsi = Kamar::with([
            'provinsi',
            'promo' => function ($a) {
                $a->where('end_date_promo', '>=', carbon::now()->format('d F, Y'));
            }
        ])->select('province_id')
            ->groupby('province_id')
            ->where('status', 1)
            ->where('is_active', 1)
            ->get();
        $select = [];
        $select['jenis_kamar'] = $request->jenis_kamar;
        $select['name']        = $request->nama_provinsi;
        $select['user_id']     = $request->user;
        return view('front.allCardContent', \compact('allKamar', 'select', 'provinsi', 'cari'));
    }

    // Filter kamar
    public function filterKamar(Request $request)
    {
        if ($request->nama_provinsi != 'all' && $request->jenis_kamar != 'all') {
            $allKamar = kamar::with([
                'promo' => function ($a) {
                    $a->where('end_date_promo', '>=', carbon::now()->format('d F, Y'));
                }
            ])->whereHas('provinsi', function ($q) use ($request) {
                $q->where('name', $request->nama_provinsi);
            })
                ->where('jenis_kamar', $request->jenis_kamar)
                ->where('status', 1)
                ->where('is_active', 1)
                ->paginate(12);
        } elseif ($request->nama_provinsi == 'all' && $request->jenis_kamar != 'all') {
            $allKamar = kamar::with([
                'promo' => function ($a) {
                    $a->where('end_date_promo', '>=', carbon::now()->format('d F, Y'));
                }
            ])->where('jenis_kamar', $request->jenis_kamar)
                ->where('status', 1)
                ->where('is_active', 1)
                ->paginate(12);
        } elseif ($request->nama_provinsi != 'all' && $request->jenis_kamar == 'all') {
            $allKamar = kamar::with([
                'promo' => function ($a) {
                    $a->where('end_date_promo', '>=', carbon::now()->format('d F, Y'));
                }
            ])->whereHas('provinsi', function ($q) use ($request) {
                $q->where('name', $request->nama_provinsi);
            })
                ->where('status', 1)
                ->where('is_active', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        } else {
            $allKamar = kamar::with([
                'promo' => function ($a) {
                    $a->where('end_date_promo', '>=', carbon::now()->format('d F, Y'));
                }
            ])->where('status', 1)
                ->where('is_active', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        }


        $select = [];
        $select['jenis_kamar'] = $request->jenis_kamar;
        $select['name']        = $request->nama_provinsi;

        // select provinsi
        $provinsi = Kamar::with([
            'provinsi',
            'promo' => function ($a) {
                $a->where('end_date_promo', '>=', carbon::now()->format('d F, Y'));
            }
        ])->select('province_id')
            ->where('status', 1)
            ->where('is_active', 1)
            ->groupby('province_id')
            ->get();
        return view('front.allCardContent', \compact('allKamar', 'select', 'provinsi'));
    }

    // Show by kota
    public function showByKota(Request $request)
    {
        $kota = $request->kota;
        $kamar = kamar::with('promo')
            ->when(isset($kota), function ($a) {
                $a->where('status', 1)->where('is_active', 1);
            })
            ->whereHas('provinsi', function ($q) use ($kota) {
                $q->where('name', $kota);
            })
            ->orwhereHas('regencies', function ($q) use ($kota) {
                $q->where('name', $kota);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(12);
        return view('front.showByKota', \compact('kamar', 'kota'));
    }

    // Simpan kamar
    public function simpanKamar(Request $request)
    {
        $simpan = new SimpanKamar;
        $simpan->user_id  = Auth::id();
        $simpan->kamar_id = $request->id;
        $simpan->save();

        return back();
    }

    // Hapus kamar disimpan
    public function hapusKamar(Request $request)
    {
        $hapus = SimpanKamar::find($request->id);
        $hapus->delete();

        return back();
    }
}
