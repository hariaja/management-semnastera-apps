<?php

namespace App\DataTables\Settings;

use App\Models\User;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Services\User\UserService;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UserDataTable extends DataTable
{
  public function __construct(protected UserService $userService)
  {
    // 
  }

  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->editColumn('status', function ($row) {
        return $row->isStatus();
      })
      ->addColumn('roles', function ($row) {
        if ($row->isRoleName() === Constant::ADMIN) :
          return '<span class="badge text-smooth">' . Constant::ADMIN . '</span>';
        endif;

        if ($row->isRoleName() === Constant::PRESENTER) :
          return '<span class="badge text-secondary">' . Constant::PRESENTER . '</span>';
        endif;

        if ($row->isRoleName() === Constant::PARTICIPANT) :
          return '<span class="badge text-modern">' . Constant::PARTICIPANT . '</span>';
        endif;

        if ($row->isRoleName() === Constant::REVIEWER) :
          return '<span class="badge text-warning">' . Constant::REVIEWER . '</span>';
        endif;
      })
      ->addColumn('action', 'settings.users.action')
      ->rawColumns([
        'status',
        'action',
        'roles',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(User $model): QueryBuilder
  {
    return $this->userService->orderByName();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('user-table')
      ->columns($this->getColumns())
      ->columns($this->getColumns())
      ->ajax([
        'url' => route('users.index'),
        'type' => 'GET',
        'data' => "
          function(data) {
            _token = '{{ csrf_token() }}',
            data.status = $('select[name=status]').val();
            data.roles = $('select[name=roles]').val();
          }"
      ])
      ->addTableClass([
        'table',
        'table-striped',
        'table-bordered',
        'table-hover',
        'table-vcenter',
      ])
      ->processing(true)
      ->retrieve(true)
      ->serverSide(true)
      ->autoWidth(false)
      ->pageLength(5)
      ->responsive(true)
      ->lengthMenu([5, 10, 20])
      ->orderBy(1);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('10%')
        ->addClass('text-center'),
      Column::make('name')
        ->title(trans('Nama'))
        ->addClass('text-center'),
      Column::make('email')
        ->title(trans('Email'))
        ->addClass('text-center'),
      Column::make('roles')
        ->title(trans('Peran'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status Akun'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('15%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'User_' . date('YmdHis');
  }
}