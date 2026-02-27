<td>
  {{-- @can('change_user_status') --}}
  {{-- @if($user->role->type !== 'general_manager' && $user->role->type !== 'accountant') --}}
  <div class=" custom-checkbox-container">
    <div class="checkbox checbox-switch switch-success">
      <label>
        <input type="checkbox" class="statusCheckbox" data-id="{{ $user->id }}" name="status_switch" {{ $user->status  == 1 ? 'checked' : '' }} />
        <span></span>
      </label>
    </div>
  </div>
  {{-- @endif --}}
  {{-- @endcan --}}
</td>