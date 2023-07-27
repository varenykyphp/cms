<?php

namespace Varenyky\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'page_id',
        'key',
        'value',
    ];
}