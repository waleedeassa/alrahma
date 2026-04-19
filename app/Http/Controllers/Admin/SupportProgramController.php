<?php


namespace App\Http\Controllers\Admin;

use App\Traits\ResponseTrait;
use App\Models\SupportProgram;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\SupportProgramRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class SupportProgramController extends Controller implements HasMiddleware
{
  use ResponseTrait;

  public static function middleware()
  {
    return [
      new Middleware('can:استعراض برامج الدعم', only: ['index', 'data']),
      new Middleware('can:اضافة برنامج دعم', only: ['store']),
      new Middleware('can:تعديل برنامج دعم', only: ['update']),
      new Middleware('can:حذف برنامج دعم', only: ['destroy']),
    ];
  }
  public function index()
  {
    return view('admins.support_programs.index');
  }
  public function data()
  {
    $programs = SupportProgram::query();

    return DataTables::of($programs)
      ->addIndexColumn()
      ->addColumn('action', function ($program) {
        return view('admins.support_programs.datatables.actions', compact('program'))->render();
      })
      ->editColumn('created_at', function ($program) {
        return $program->created_at->format('Y-m-d');
      })
      ->rawColumns(['action'])
      ->make(true);
  }
  public function store(SupportProgramRequest $request)
  {
    $program = SupportProgram::create($request->validated());

    if ($program) {
      return $this->successResponse('تم إضافة برنامج الدعم بنجاح', 201);
    }
    return $this->errorResponse('حدث خطأ ما أثناء الإضافة', 500);
  }
  public function update(SupportProgramRequest $request, SupportProgram $support_program)
  {
    $support_program->update($request->validated());
    if ($support_program) {
      return $this->successResponse('تم تعديل برنامج الدعم بنجاح', 200);
    }
    return $this->errorResponse('حدث خطأ ما أثناء التعديل', 500);
  }

  public function destroy(SupportProgram $support_program)
  {
    // check if support program is used in other tables
    if ($support_program->difficultCaseFamilies()->exists() || $support_program->specialNeedsPeople()->exists()) {
      return $this->errorResponse('لا يمكن حذف برنامج الدعم لانه مستخدم فى النظام', 422);
    }
    if (!$support_program->delete()) {
      return $this->errorResponse('حدث خطأ ما', 500);
    }
    return $this->successResponse('تم حذف برنامج الدعم بنجاح', 200);
  }
}
