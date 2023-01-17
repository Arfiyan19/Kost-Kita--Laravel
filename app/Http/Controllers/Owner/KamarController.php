<?php

namespace App\Http\Controllers\Owner;
use ErrorException;

use App\Models\kamar;
use Illuminate\Http\Request;
use App\Http\Requests\KamarRequest;
use App\Http\Controllers\Controller;
use App\Services\Owner\KamarService;
use Illuminate\Support\Facades\Session;
use App\Models\{Province,regency,District};

class KamarController extends Controller
{
    protected $kamar;

    public function __construct(KamarService $kamar)
    {
      $this->kamar = $kamar;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        $result = $this->kamar->index();
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      try {
        $result = $this->kamar->create();
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KamarRequest $request)
    {
      try {
        $result = $this->kamar->store($request);
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      try {
        $result = $this->kamar->show($slug);
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      try {
        $result = $this->kamar->edit($slug);
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
      try {
        $result = $this->kamar->update($id,$request);
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Select Regency
    public function selectRegency(Request $request)
    {
      $regency = regency::where('province_id',$request->province_id)->get();
      return \response()->json($regency);
    }

     // Select District
    public function selectDistrict(Request $request)
    {
      $district = District::where('regency_id',$request->regency_id)->get();
      return \response()->json($district);
    }

    // Del Fasilitas Kamar
    public function delFasilitasKamarService($id)
    {
      return $this->kamar->delFasilitasKamar($id);
    }

    // Del Fasilitas Kamar Mandi
    public function delFasilitasKamarMandiService($id)
    {
      return $this->kamar->delFasilitasKamarMandi($id);
    }

    // Del Fasilitas Bersama
    public function delFasilitasBersamaService($id)
    {
      return $this->kamar->delFasilitasBersama($id);
    }

    // Del Fasilitas Parkir
    public function delFasilitasParkirService($id)
    {
      return $this->kamar->delFasilitasParkir($id);
    }

    // Del Area
    public function delAreaService($id)
    {
      return $this->kamar->delArea($id);
    }

     // Del Foto Kamar
    public function delFotoKamarService($image)
    {
      return $this->kamar->delFotoKamar($image);
    }

    // Non-aktif dan aktifkan kamar
    public function statusKamar(Request $params)
    {
        return $this->kamar->isActive($params);
    }
}

