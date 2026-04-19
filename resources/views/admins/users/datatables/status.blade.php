<td>
  @php $isSuperAdmin = $user->isSuperAdmin(); @endphp
  @if(!$isSuperAdmin)
  <div class=" custom-checkbox-container">
    <div class="checkbox checbox-switch switch-success">
      <label>
        <input type="checkbox" class="statusCheckbox" data-id="{{ $user->id }}" name="status_switch" {{ $user->status == 1 ? 'checked' : '' }} />
        <span></span>
      </label>
    </div>
  </div>
  @else
 
  @endif
</td>