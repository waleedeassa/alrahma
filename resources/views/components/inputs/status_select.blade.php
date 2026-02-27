@props(['name', 'value' => '', 'label'])

<label for="" class="mr-sm-2 mb-2" style="font-weight:bold; color:black">
    {{ $label }}
</label>

<select name="{{ $name }}" class="form-select mr-sm-2">
    <option value="">{{__('dashboard.Select from the list')}}</option>
    <option @if (old($name, $value) == '1') selected="selected" @endif value="1">مفعل</option>
    <option @if (old($name, $value) == '0') selected="selected" @endif value="0">غير مفعل</option>
</select>

@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror
