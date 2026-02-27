<?php

namespace App\Http\Controllers\Sponsor;

use App\Traits\saveImageTrait;
use App\Traits\deleteImageTrait;
use App\Traits\uploadMangerTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\ProfileUpdateRequest;


class ProfileController extends Controller
{
  use uploadMangerTrait;

  public function index()
  {
    $user = Auth::user();
    return view('dashboard.profile.index', compact('user'));
  }

  public function updateAdminProfile(ProfileUpdateRequest $request)
  {
    try {
      DB::beginTransaction();

      $data = $request->except('photo', '_token');
      $user = Auth::user();

      if ($request->hasFile('photo')) {
        if ($user->photo) {
          $this->deleteAttachment('profiles', $user->photo);
        }
        $data['photo'] = $this->saveAttachment($request->file('photo'), 'uploads/profiles');
      }
      $user->update($data);

      DB::commit();
      return redirect()->back()
        ->with(['message' => 'تم تحديث البيانات بنجاح', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }
}
