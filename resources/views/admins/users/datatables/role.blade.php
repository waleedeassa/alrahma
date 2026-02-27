@foreach ( $user->roles as $role)
<span class="badge-custom">{{ $role->name }}</span>
@endforeach