<td>
  <button data-id="{{ $city->id }}"
          data-name="{{ $city->name }}"
          data-governorate-id="{{ $city->governorate_id }}"
          class="btn btn-lg rounded-pill waves-effect waves-light edit_city">
      <i class="fa fa-pencil-square-o"></i>
  </button>
  <button type="button" class="btn btn-lg rounded-pill waves-effect waves-light"
          data-bs-toggle="modal"
          data-bs-target="#delete_city_{{ $city->id }}">
      <i class="fa fa-trash"></i>
  </button>
</td>

<!-- Delete Modal -->
<div class="modal fade" id="delete_city_{{ $city->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <form id="deleteCityForm_{{ $city->id }}" action="{{ route('admin.cities.destroy', $city->id) }}" method="post">
          @csrf
          @method('DELETE')
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title"> حذف مدينة - جماعة</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>هل انت متاكد من حذف مدينة - جماعة :  <strong>{{ $city->name }}</strong> ؟</p>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; موافق</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp; اغلاق</button>
              </div>
          </div>
      </form>
  </div>
</div>