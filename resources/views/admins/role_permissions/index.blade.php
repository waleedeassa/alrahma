@extends('layouts.master')
@section('title', "صلاحيات المسؤولين")
@section('breadcrumpTitle', "صلاحيات المسؤولين")

@section('breadcrump')
@parent
<li class="breadcrumb-item active"> صلاحيات المسؤولين</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        {{-- @can('اضافة صلاحيات مسؤول') --}}
        <a href="{{ route('admin.role-permissions.create') }}" class="button black x-small">اضافة صلاحيات مسؤول </a>
        {{-- @endcan --}}
        <br><br>
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th>#</th>
                <th>نوع المسؤول</th>
                <th> الصلاحيات</th>
                <th>العمليات</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $roles as $role)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td>
                  @foreach ($role->permissions as $permission )
                  <span class="badge rounded-pill bg-primary   ">{{ $permission->name }}</span>
                  @endforeach
                </td>
                <td>
                  {{-- @can('تعديل صلاحيات مسؤول') --}}
                  <a href="{{ route('admin.role-permissions.edit',$role->id) }}" class="btn btn-dark btn-sm rounded-pill waves-effect waves-light"><i class="fa fa-edit"></i></a>
                  {{-- @endcan
                  @can('حذف مسؤول مع صلاحياته') --}}
                  <button type="button" class="btn btn-danger btn-sm rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#delete_category{{ $role->id }}"><i class="fa fa-trash"></i></button>
                  {{-- @endcan --}}
                </td>
              </tr>
              <div class="modal fade" id="delete_category{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="{{route('admin.role-permissions.destroy',$role)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> حذف المستخدم مع الصلاحيات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                          <i class="fa fa-times text-white" aria-hidden="true"></i>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p> هل أنت متأكد من حذف المستخدم مع الصلاحيات ؟</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-success">موافق</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection