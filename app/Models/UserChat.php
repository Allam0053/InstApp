<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserChat extends Pivot
{
    public $incrementing = true;
    public $timestamps = true;
}
