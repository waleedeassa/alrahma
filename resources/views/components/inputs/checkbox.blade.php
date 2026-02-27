@props(['name', 'value' => "1", 'type' => 'checkbox', 'label'=>'', 'id'=>"",'checked'=>''])

<label  class="form-check-label" for= {{ $id }}  >
    {{ $label }}  
</label>
{{-- <br> --}}
<input
 name="{{ $name }}" 
value="{{ $value }}" 
type="{{ $type }}"
id="{{ $id }}"

@if($checked != '' ){
  checked
}
@endif

{{-- @if($checked === 1 ){
  checked
}
@endif --}}

@if(isset($class))
class= "{{ $class }}"
@else
class="form-check-input"
@endif
{{ $attributes }}
>

@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror
