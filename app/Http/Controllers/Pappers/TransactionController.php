<?php

namespace App\Http\Controllers\Pappers;

use App\DataTables\Pappers\TransactionDataTable;
use App\DataTables\Scopes\StatusFilter;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Transaction\TransactionService;

class TransactionController extends Controller
{
  /**
   * Create a new datatable instance.
   *
   * @return void
   */
  public function __construct(
    protected TransactionService $transactionService
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(TransactionDataTable $dataTable, Request $request)
  {
    return $dataTable->addScope(new StatusFilter($request))->render('pappers.transactions.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Transaction $transaction)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Transaction $transaction)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Transaction $transaction)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Transaction $transaction)
  {
    //
  }
}
