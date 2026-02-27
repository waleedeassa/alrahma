<td>
  <button data-id="{{ $governorate->id }}" data-name="{{ $governorate->name }}"   class="btn btn-lg rounded-pill waves-effect waves-light edit_governorate "><i class="fa fa-pencil-square-o"></i>
  </button>
  <button type="button" class="btn  btn-lg rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#delete_governorate{{ $governorate->id }}"><i class="fa fa-trash"></i></button>

</td>
</tr>
<div class="modal fade" id="delete_governorate{{$governorate->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="deleteGovernorate" method="post">
      @csrf
      @method('DELETE')
      <input type="hidden" name="id" value="{{ $governorate->id }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> حذف الاقليم </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <p>هل انت متاكد من حذف الاقليم ؟</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success  button-prevent-multiple-submits"> <i class="fa fa-check"></i>&nbsp; موافق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times"></i>&nbsp; اغلاق</button>
        </div>
      </div>
    </form>
  </div>
</div>