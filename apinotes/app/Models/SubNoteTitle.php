<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubNoteTitle extends Model
{
    use HasFactory;

    protected $table = 'sub_note_titles';
    protected $tkey = 'id';
}
