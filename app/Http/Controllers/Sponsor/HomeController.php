<?php

namespace App\Http\Controllers\Sponsor;

use App\Models\User;
use App\Models\Order;
use App\Models\Project;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

  public function index()
  {
    return view('sponsors.index');
  }
}
