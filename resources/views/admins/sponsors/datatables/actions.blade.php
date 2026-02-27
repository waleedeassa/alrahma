<td>
  <button data-id="{{ $sponsor->id }}" 
          data-name="{{ $sponsor->name }}" 
          data-type="{{ $sponsor->type }}" 
          data-email="{{ $sponsor->email }}" 
          data-phone="{{ $sponsor->phone }}" 
          data-status="{{ $sponsor->status }}" 
          data-address="{{ $sponsor->address }}"
          class="btn btn-lg rounded-pill waves-effect waves-light edit_sponsor"><i class="fa fa-pencil-square-o"></i>
  </button>
  <button type="button" class="btn btn-lg rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#delete_sponsor_{{ $sponsor->id }}"><i class="fa fa-trash"></i></button>
</td>

<div class="modal fade" id="delete_sponsor_{{ $sponsor->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <form class="deleteSponsorForm" method="post">
          @csrf
          @method('DELETE')
          <input type="hidden" name="id" value="{{ $sponsor->id }}">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title">حذف كفيل</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                  <p>هل أنت متأكد من حذف هذا الكفيل؟</p>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; موافق</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp; اغلاق</button>
              </div>
          </div>
      </form>
  </div>
</div>