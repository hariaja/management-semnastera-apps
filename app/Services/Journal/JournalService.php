<?php

namespace App\Services\Journal;

use App\Models\Journal;
use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface JournalService extends BaseService
{
  public function orderByUserId();
  public function uploadWithFile(Request $request);
  public function deleteWithFile(Journal $journal);
}
