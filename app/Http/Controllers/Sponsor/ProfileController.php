<?php

namespace App\Http\Controllers\Sponsor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sponsor\ProfileUpdateRequest;
use App\Traits\deleteImageTrait;
use App\Traits\saveImageTrait;
use App\Traits\UploadManagerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
  use UploadManagerTrait;

  public function index()
  {
    $user = Auth::user();
    return view('sponsors.profile.index', compact('user'));
  }

  public function updateSponsorProfile(ProfileUpdateRequest $request)
  {
    try {
      DB::beginTransaction();
      $data =  $request->validated();
      $user = Auth::user();
      if ($request->hasFile('photo')) {
        $newPhotoPath = $this->uploadSimpleImage( $request->file('photo'), 'avatars/sponsors', $user->photo);
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