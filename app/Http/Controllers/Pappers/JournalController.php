<?php

namespace App\Http\Controllers\Pappers;

use App\Models\Journal;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Services\Journal\JournalService;
use App\DataTables\Pappers\JournalDataTable;
use App\Http\Requests\Pappers\JournalRequest;
use App\Services\Registration\RegistrationService;

class JournalController extends Controller
{
  /**
   * Create a new datatable instance.
   *
   * @return void
   */
  public function __construct(
    protected JournalService $journalService,
    protected RegistrationService $registrationService
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(JournalDataTable $dataTable)
  {
    $check = $this->registrationService->getOpenByDate();

    if (isRoleName() !== Constant::ADMIN) :
      if ($check->isEmpty()) :
        return view('errors.close');
      endif;
    endif;

    return $dataTable->render('pappers.journals.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    if (isRoleName() === Constant::ADMIN) :
      abort(403, trans('error.403'));
    endif;


    return view('pappers.journals.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(JournalRequest $request)
  {
    $this->journalService->uploadWithFile($request);
    return redirect()->route('journals.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Journal $journal)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Journal $journal)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Journal $journal)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Journal $journal)
  {
    $this->journalService->deleteWithFile($journal);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
