<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orphan;
use Illuminate\Http\Request;

class ChangeSponsoredOrphanStatusController extends Controller
{

  // public function __construct()
  // {
  //   $this->middleware('permission:تغيير حالة اليتيم إلى غير مكفول', ['only' => ['changeSponsoredOrphanToUnsponsored']]);
  // }

  public function changeSponsoredOrphanToUnsponsored(Orphan $orphan)
  {
    $orphan->update([
      'sponsor_id' => null,
      'orphan_sponsorship_code' => null,
    ]);
    return redirect()->back()
      ->with(['message' => 'تم تحديث حالة اليتيم إلى غير مكفول بنجاح', 'type' => 'success']);
  }
}
