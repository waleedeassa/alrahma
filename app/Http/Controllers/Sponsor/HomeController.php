<?php

namespace App\Http\Controllers\Sponsor;


use App\Http\Controllers\Controller;
use App\Models\Orphan;

class HomeController extends Controller
{

  public function index()
  {
    // get the counts of sponsored and unsponsored orphans for the logged-in sponsor
    $sponsoredOrphansCount = auth()->user()->orphans()->count();
    $unsponsoredOrphansCount = Orphan::whereNull('sponsor_id')->where('sponsorship_status', 0)->count();
    $data = [
      'sponsoredOrphansCount' => $sponsoredOrphansCount,
      'unsponsoredOrphansCount' => $unsponsoredOrphansCount,
    ];
    return view('sponsors.index', $data);
  }
}