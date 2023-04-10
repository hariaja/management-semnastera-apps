<?php

namespace App\DataTables\Pappers;

use App\Models\Journal;
use App\Services\Journal\JournalService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use function App\Helpers\Global\customDate;

class JournalDataTable extends DataTable
{
  /**
   * Create a new datatable instance.
   *
   * @return void
   */
  public function __construct(protected JournalService $journalService)
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
      ->addColumn('user_name', fn ($row) => $row->user->name)
      ->addColumn('action', 'pappers.journals.action');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Journal $model): QueryBuilder
  {
    return $this->journalService->orderByUserId();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('journal-table')
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
        ->title(trans('Judul'))
        ->addClass('text-center'),
      Column::make('category')
        ->title(trans('Kategori'))
        ->addClass('text-center'),
      Column::make('user_name')
        ->title(trans('Pemakalah'))
        ->addClass('text-center'),
      Column::make('upload_year')
        ->title(trans('Tahun'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('10%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Journal_' . date('YmdHis');
  }
}
