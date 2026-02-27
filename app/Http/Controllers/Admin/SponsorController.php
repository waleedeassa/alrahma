<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\SponsorRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class SponsorController extends Controller implements HasMiddleware
{
  use ResponseTrait;
  public static function middleware()
  {
    return [
      // new Middleware('can:ادارة الكفلاء', only: ['index']),
      // new Middleware('can:add_user', only: ['create', 'store']),
      // new Middleware('can:edit_user', only: ['edit', 'update']),
      // new Middleware('can:delete_user', only: ['destroy']),
      // new Middleware('can:change_user_status', only: ['changeUserStatus']),
      // new Middleware('can:show_user', only: ['show']),
    ];
  }
  public function index()
  {
    return view('admins.sponsors.index');
  }
  public function getSponsors()
  {
    $sponsors = Sponsor::select('id', 'name', 'type', 'email', 'phone', 'status', 'created_at', 'address')
      ->withCount('orphans');
    return DataTables::of($sponsors)
      ->addIndexColumn()
      ->editColumn('type', function ($sponsor) {
        return $sponsor->type_label;
      })
      ->editColumn('status', function ($sponsor) {
        return view('admins.sponsors.datatables.status', compact('sponsor'))->render();
      })
      ->addColumn('orphans_count', function ($sponsor) {
        return $sponsor->orphans_count == 0
          ? '-'
          : '<div class="count-badge">' . $sponsor->orphans_count . '</div>';
      })
      ->addColumn('action', function ($sponsor) {
        return view('admins.sponsors.datatables.actions', compact('sponsor'))->render();
      })
      ->rawColumns(['action', 'status', 'orphans_count'])
      ->make(true);
  }
  public function store(SponsorRequest $request)
  {
    $data = $request->validated();
    $data['password'] = Hash::make('12345678');
    Sponsor::create($data);
    return $this->successResponse('تم اضافة الكفيل بنجاح', 201);
  }
  public function update(SponsorRequest $request, Sponsor $sponsor)
  {
    $sponsor->update($request->validated());
    return $this->successResponse('تم تعديل الكفيل بنجاح', 201);
  }
  public function destroy(Sponsor $sponsor)
  {
    $check = $sponsor->canBeDeleted();
    if ($check !== true) {
      return $this->errorResponse($check, 403);
    }
    try {
      $sponsor->delete();
      return response()->json(['status' => 'success', 'message' => 'تم حذف الكفيل بنجاح']);
    } catch (\Exception $e) {
      return $this->errorResponse('حدث خطأ ما', 500);
    }
  }
  public function changeSponsorStatus(Request $request, string $id)
  {
    $sponsor = Sponsor::find($id);
    if (!$sponsor) {
      return $this->errorResponse('حدث خطأ ما', 500);
    }
    $sponsor->update(['status' => $request->status]);
    return response()->json(['status' => 'success', 'message' => 'تم تغيير حالة الكفيل بنجاح']);
    return $this->successResponse('تم تغيير حالة الكفيل بنجاح', 200);
  }
}
