<?php

namespace App\Http\Controllers\Pappers;

use App\DataTables\Pappers\RegistrationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pappers\RegistrationRequest;
use App\Models\Registration;
use App\Services\Registration\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
  public function __construct(
    protected RegistrationService $registrationService
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(RegistrationDataTable $dataTable)
  {
    return $dataTable->render('pappers.registrations.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pappers.registrations.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RegistrationRequest $request)
  {
    $this->registrationService->create($request->all());
    return redirect()->route('registrations.index')->withSuccess(trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Registration $registration)
  {
    return view('pappers.registrations.edit', compact('registration'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Registration $registration)
  {
    $this->registrationService->update($registration->id, $request->all());
    return redirect()->route('registrations.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Registration $registration)
  {
    $this->registrationService->delete($registration->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
