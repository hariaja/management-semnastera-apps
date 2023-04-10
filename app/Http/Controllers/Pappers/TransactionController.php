<?php

namespace App\Http\Controllers\Pappers;

use App\DataTables\Pappers\TransactionDataTable;
use App\DataTables\Scopes\StatusFilter;
use App\Helpers\Global\Constant;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pappers\TransactionRequest;
use App\Services\Registration\RegistrationService;
use App\Services\Transaction\TransactionService;

class TransactionController extends Controller
{
  /**
   * Create a new datatable instance.
   *
   * @return void
   */
  public function __construct(
    protected TransactionService $transactionService,
    protected RegistrationService $registrationService
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(TransactionDataTable $dataTable, Request $request)
  {
    $check = $this->registrationService->getOpenByDate();

    if (isRoleName() !== Constant::ADMIN) :
      if ($check->isEmpty()) :
        return view('errors.close');
      endif;
    endif;

    return $dataTable->addScope(new StatusFilter($request))->render('pappers.transactions.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    if (isRoleName() === Constant::ADMIN) :
      abort(403, trans('error.403'));
    endif;

    return view('pappers.transactions.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(TransactionRequest $request)
  {
    $this->transactionService->handleCreateWithAvatar($request);
    return redirect()->route('transactions.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Transaction $transaction)
  {
    return view('pappers.transactions.show', compact('transaction'));
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
    $this->transactionService->updateOrFail(
      $transaction->id,
      $request,
    );

    return redirect()->route('transactions.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Transaction $transaction)
  {
    //
  }
}
