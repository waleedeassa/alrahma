@props(['name', 'selected'=>'', 'label','options'=>[]
])

<label  class="form-label" for="{{ $name }}">
    {{ $label }}
</label>

<select name="{{ $name }}">
    <option value="" selected disabled>اختر من القائمة...</option>
    @foreach ($options as $key => $text )
        <option  value={{ $key }} @if (old($name, $selected) ==  $key) selected @endif>{{$text}}</option>
    @endforeach
    {{-- { --}}
</select>

@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror
