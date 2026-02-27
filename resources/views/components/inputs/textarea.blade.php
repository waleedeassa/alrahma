
{{-- class="form-control" --}}

@props(['name', 'value' => '', 'label'=> '' ,'rows' =>'' ,'class','style' =>'','id','required' => false])

<label class="form-label" for="formGroup">{{ $label }}
  @if($required)
  <span style="color: red">*</span>
  @endif
</label>

<textarea 
@if(isset($class))
class= "{{ $class }}"
@else
class="form-control"
@endif
 {{-- name="{{ $name }}" id="exampleFormControlTextarea1" rows="{{ $rows }}" style="min-height:150px;" >{{ old($name, $value) }}</textarea> --}}
 name="{{ $name }}" 
 @if(isset($id))
id= "{{ $id }}"
@else
id="exampleFormControlTextarea1"
@endif
 
 rows="{{ $rows }}" style="min-height:150px;" >{{ old($name, $value) }}</textarea>

@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror
