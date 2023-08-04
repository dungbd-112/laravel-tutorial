<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Success
 * @method static static Fail
 */
final class ResponseStatus extends Enum
{
    const Success = 'success';
    const Fail = 'fail';
}