<?php

namespace App\Http\Controllers\Admin;


use App\Models\Orphan;
use App\Models\Sponsor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AssignSponsorshipsRequest;

class AssignOrphansToSponsorController extends Controller
{
  public function index()
  {
    $sponsors = Sponsor::latest()->get();
    $unsponsoredOrphans = Orphan::where('sponsor_id', null)->get();
    return view('admins.assign_orphans_to_sponsor.index', compact('sponsors', 'unsponsoredOrphans'));
  }
  public function store(AssignSponsorshipsRequest $request)
  {
    // dd($request->validated());
    $data = $request->validated();
    $sponsorId = $data['sponsor_id'];
    $orphanIds = $data['orphan_ids'];
    $sponsorshipCodes = $data['sponsorship_codes'];
    // insure that the number of orphans is equal to the number of sponsorship codes
    if (count($orphanIds) !== count($sponsorshipCodes)) {
      return redirect()->back()->withErrors(['error' => 'حدث عدم تطابق في البيانات.'])->withInput();
    }

    DB::beginTransaction();
    try {
      foreach ($orphanIds as $index => $orphanId) {
        $sponsorshipCode = $sponsorshipCodes[$index];
        Orphan::where('id', $orphanId)->update([
          'sponsor_id' => $sponsorId,
          'orphan_sponsorship_code' => $sponsorshipCode,
        ]);
      }
      DB::commit();
      return redirect()->back()->with(['message' => 'تم اضافة الأيتام للكفيل بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء الحفظ: ' . $e->getMessage()])->withInput();
    }
  }
}
