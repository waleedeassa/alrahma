@extends('layouts.master')
@section('title', "الصلاحيات")
@section('breadcrumpTitle')
{{-- @can('اضافة صلاحية') --}}
<a href="{{ route('admin.permissions.create') }}" class="button black x-small">اضافة صلاحية </a>
{{-- @endcan --}}
@endsection

@section('breadcrump')
@parent
<li class="breadcrumb-item active">الصلاحيات</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <br><br>
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="alert-success">
              <tr>
                <th>#</th>
                <th>اسم الصلاحية</th>
                <th>اسم المجموعه</th>
                <th>تاريخ الاضافة</th>
                <th>العمليات</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $permissions as $permission)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->group_name }}</td>
                <td>{{ $permission->created_at->format('Y-m-d') }}</td>
                
                <td>
                  {{-- @can('تعديل صلاحية') --}}
                  <a href="{{ route('admin.permissions.edit',$permission) }}" class="btn btn-dark btn-sm rounded-pill waves-effect waves-light"><i class="fa fa-edit"></i></a>
                  {{-- @endcan --}}
                  {{-- @can('حذف صلاحية') --}}
                  <button type="button" class="btn btn-danger btn-sm rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#delete_category{{ $permission->id }}"><i class="fa fa-trash"></i></button>
                  {{-- @endcan --}}
                </td>
              </tr>
              <div class="modal fade" id="delete_category{{$permission->id}}" tabindex="-1" permission="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" permission="document">
                  <form action="{{route('admin.permissions.destroy',$permission)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> حذف صلاحية</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true"></span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p> هل أنت متأكد من حذف الصلاحية ؟</p>
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