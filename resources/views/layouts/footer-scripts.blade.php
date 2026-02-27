<!-- jquery -->
<script src="{{ URL::asset('dashboard/assets/js/jquery-3.6.0.min.js')}}"></script>

<!-- plugins-jquery -->
<script src="{{ URL::asset('dashboard/assets/js/plugins-jquery.js')}}"></script>

<!-- Inputs Validation -->
<script src="{{ URL::asset('dashboard/assets/js/validate.min.js')}}"></script>


<!--Datatable-->

<script src="{{ URL::asset('dashboard/assets/js/bootstrap-datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('dashboard/assets/js/bootstrap-datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/select2.full.min.js')}}"></script>


<script>
  var plugin_path = '{{asset('dashboard/assets/js')}}/';
</script>

<script type="text/javascript" src="{{asset('dashboard/assets/js/custom.js') }}"></script>
{{-- toastr --}}
@if(Session::has('message'))
<script>
  toastr.options = {
    // 'positionClass'  : 'toast-top-left',
    // 'closeButton': true,
    'progressBar' : true,
    // 'closeDuration'  : 300,
  }
  var type = "{{ Session::get('type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
}
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>