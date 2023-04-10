@can('journals.show')
  <a href="{{ route('journals.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@can('journals.destroy')
  <a href="#" onclick="deleteJournal(`{{ route('journals.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endcan