@if($model->isRoleName() === Constant::ADMIN)
  <span class="badge text-danger">{{ trans('Tidak Bisa Mengubah Data') }}</span>
@else
  @if($uuid !== me()->uuid)
    @can('users.edit')
      <a href="{{ route('users.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
    @endcan
  @endif
  @can('users.show')
    <a href="{{ route('users.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
    @endcan
  @can('users.destroy')
    @if ($status === Constant::INACTIVE)
      <a href="#" onclick="deleteUser(`{{ route('users.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
    @endif
  @endcan
@endif