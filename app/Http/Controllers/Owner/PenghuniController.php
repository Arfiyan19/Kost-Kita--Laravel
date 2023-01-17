<?php

namespace App\Http\Controllers\Owner;
use ErrorException;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Owner\PenghuniService;

class PenghuniController extends Controller
{
  protected $penghuni;

  public function __construct(PenghuniService $penghuni)
  {
    $this->penghuni = $penghuni;
  }
    //Penghuni
    public function penghuni()
    {
      try {
        $result = $this->penghuni->penghuni();
        return $result;
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }
}
