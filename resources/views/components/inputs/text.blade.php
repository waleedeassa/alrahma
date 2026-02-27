@props(['name', 'value' => '', 'type' => 'text', 'label'=>'', 'id'=>'','class','required' => false])

<label class="form-label" for="formGroup">
  {{ $label }}

  @if($required)
  <span style="color: red">*</span>
  @endif

</label>
<br>
<input name="{{ $name }}" value="{{ old($name, $value) }}" type="{{ $type }}" id="{{ $id }}" @if(isset($class)) class="{{ $class }}" @else class="form-control" @endif {{ $attributes }}>

@error($name)
<span class="text-danger">{{ $message }}</span>
@enderror