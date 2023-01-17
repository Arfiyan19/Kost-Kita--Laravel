<?php

namespace App\Http\Controllers;

use ErrorException;
use Illuminate\Http\Request;
use App\Services\GlobalService;

class GlobalController extends Controller
{
  protected $global;

  public function __construct(GlobalService $global)
  {
    $this->global = $global;
  }

  // Profile
  public function profile()
  {
    try {
      $result = $this->global->profile();
      return $result;
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Profile Update
  public function profileUpdate($id, Request $Request)
  {
    try {
      $result = $this->global->profileUpdate($id, $Request);
      return $result;
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }


}
