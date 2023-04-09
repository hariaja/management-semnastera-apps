<?php

namespace App\Helpers\Global;

class Constant
{
  public const ALL = 'Semua Status';

  // Role name
  public const ADMIN = 'Administrator';
  public const PRESENTER = 'Pemakalah';
  public const PARTICIPANT = 'Peserta';
  public const REVIEWER = 'Reviewer';

  // Status account
  public const ACTIVE = 1;
  public const INACTIVE = 0;

  // State Verified
  public const VERIFIED = 'Sudah Verifikasi Email';
  public const UNVERIFIED = 'Belum Verifikasi Email';

  // Gender name
  public const MALE = 'Laki - Laki';
  public const FEMALE = 'Perempuan';

  // Status registration
  public const PENDING = 'Pending';
  public const APPROVED = 'Approved';
  public const REJECTED = 'Rejected';

  public const OPEN = 'Open';
  public const CLOSE = 'Closed';

  // Dummy
  const NO_REK = "5410401330";
  const BANK_NAME = "BANK CENTRAL ASIA";
  const BANK_USER_NAME = "ADMIN SEMNASTERA";
}
