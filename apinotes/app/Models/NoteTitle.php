<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteTitle extends Model
{
    use HasFactory;

    protected $table = 'note_titles';
    protected $tkey = 'id';
}
