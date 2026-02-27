@props(['name', 'value' => '', 'type' => 'file', 'label'=>'', 'id'=>"customFile",'available_formats'=> null])

<label class="form-label" for="formGroup">
  {{ $label }}
    @if($available_formats)
         <span style="color: red" class="text-danger small ms-1">
            ( الصيغ المقبولة: {{ $available_formats }} )
        </span>
    @endif
</label>
{{-- <br> --}}
<input name="{{ $name }}" {{-- value="{{ old($name, $value) }}" --}} type="{{ $type }}" id="{{ $id }}" @if(isset($class)) class="{{ $class }}" @else class="form-control" @endif {{ $attributes }}>

@error($name.'*')
<span class="text-danger">{{ $message }}</span>
@enderror