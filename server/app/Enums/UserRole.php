<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Admin
 * @method static static User
 */
final class UserRole extends Enum
{
    const Admin = 0;
    const User = 1;
}