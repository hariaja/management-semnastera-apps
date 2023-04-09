<?php

namespace App\DataTables\Pappers;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use function App\Helpers\Global\customDate;

class RegistrationDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->editColumn('title', function ($row) {
        if ($row->title) :
          return $row->title;
        else :
          return '-';
        endif;
      })
      ->editColumn('date_start', function ($row) {
        return customDate($row->date_start, true);
      })
      ->editColumn('date_end', function ($row) {
        return customDate($row->date_end, true);
      })
      ->editColumn('status', function ($row) {
        return $row->isStatus();
      })
      ->addColumn('action', 'pappers.registrations.action')
      ->rawColumns([
        'status',
        'action',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Registration $model): QueryBuilder
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('registration-table')
      ->columns($this->getColumns())
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
      Column::make('title')
        ->title(trans('Agenda'))
        ->addClass('text-center'),
      Column::make('date_start')
        ->title(trans('Open'))
        ->addClass('text-center'),
      Column::make('date_end')
        ->title(trans('Closed'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
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
    return 'Registration_' . date('YmdHis');
  }
}
