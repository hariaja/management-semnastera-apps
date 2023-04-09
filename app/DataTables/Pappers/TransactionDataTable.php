<?php

namespace App\DataTables\Pappers;

use App\Models\Transaction;
use App\Services\Transaction\TransactionService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use function App\Helpers\Global\customDate;

class TransactionDataTable extends DataTable
{
  /**
   * Create a new datatable instance.
   *
   * @return void
   */
  public function __construct(protected TransactionService $transactionService)
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
      ->editColumn('upload_date', fn ($row) => customDate($row->upload_date))
      ->editColumn('proof', 'pappers.transactions.proof')
      ->editColumn('status', 'pappers.transactions.status')
      ->addColumn('action', 'pappers.transactions.action')
      ->rawColumns([
        'action',
        'proof',
        'status',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Transaction $model): QueryBuilder
  {
    return $this->transactionService->orderByUserId();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('transaction-table')
      ->columns($this->getColumns())
      ->ajax([
        'url' => route('transactions.index'),
        'type' => 'GET',
        'data' => "
          function(data) {
            _token = '{{ csrf_token() }}',
            data.status = $('select[name=status]').val();
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
      Column::make('user_name')
        ->title(trans('Pemakalah'))
        ->addClass('text-center'),
      Column::make('upload_date')
        ->title(trans('Tanggal Bayar'))
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
    return 'Transaction_' . date('YmdHis');
  }
}
