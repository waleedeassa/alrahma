<?php

namespace App\Http\Controllers\Admin;

use App\Traits\UploadManagerTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProfileUpdateRequest;

class ProfileController extends Controller
{
  use UploadManagerTrait;

  public function index()
  {
    $user = Auth::user();
    return view('admins.profile.index', compact('user'));
  }

  public function updateAdminProfile(ProfileUpdateRequest $request)
  {
    try {
      DB::beginTransaction();
      $data =  $request->validated();
      $user = Auth::user();
      if ($request->hasFile('photo')) {
        $newPhotoPath = $this->uploadSimpleImage( $request->file('photo'), 'avatars/admins', $user->photo);
        $data['photo'] = $newPhotoPath;
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
