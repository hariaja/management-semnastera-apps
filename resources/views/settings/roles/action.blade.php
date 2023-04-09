@if($name === Constant::ADMIN)
  <span class="badge text-primary">{{ trans('Tidak Bisa Diubah') }}</span>
@else
  <a href="{{ route('roles.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  <a href="#" onclick="deleteRole(`{{ route('roles.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endif