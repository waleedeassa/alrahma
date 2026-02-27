<td>
  <button data-id="{{ $permission->id }}" data-name="{{ $permission->name }}" data-group_name="{{ $permission->group_name }}" class="btn btn-lg rounded-pill waves-effect waves-light edit_permission">
    <i class="fa fa-edit"></i>
  </button>
  <button type="button" class="btn  btn-lg rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#delete_permission_{{ $permission->id }}">
    <i class="fa fa-trash"></i>
  </button>
</td>

<div class="modal fade" id="delete_permission_{{ $permission->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="deletePermissionForm" method="post" action="{{ route('admin.permissions.destroy', $permission->id) }}">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">حذف صلاحية</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>هل أنت متأكد من حذف الصلاحية؟</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>&nbsp; موافق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times"></i>&nbsp; اغلاق</button>
        </div>
      </div>
    </form>
  </div>
</div>