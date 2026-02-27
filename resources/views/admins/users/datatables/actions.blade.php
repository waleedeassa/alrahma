<td>
  <button data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-family_name="{{ $user->family_name }}"  data-email="{{ $user->email }}" data-phone="{{ $user->phone }}" data-status="{{ $user->status }}" data-role_id="{{  $user->roles->first() ? $user->roles->first()->id : '' }}" class="btn btn-lg rounded-pill waves-effect waves-light edit_user "><i class="fa fa-pencil-square-o"></i>
  </button>
  <button type="button" class="btn  btn-lg rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#delete_user{{ $user->id }}"><i class="fa fa-trash"></i></button>

</td>
</tr>
<div class="modal fade" id="delete_user{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="deleteUser" method="post">
      @csrf
      @method('DELETE')
      <input type="hidden" name="id" value="{{ $user->id }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> حذف المستخدم</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <p>هل انت متاكد من حذف المستخدم ؟</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success  button-prevent-multiple-submits"> <i class="fa fa-check"></i>&nbsp; موافق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times"></i>&nbsp; اغلاق</button>
        </div>
      </div>
    </form>
  </div>
</div>