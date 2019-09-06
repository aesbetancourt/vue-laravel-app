<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileEntry extends Model
{
    protected $fillable = [/*'user_id',*/'filename', 'mime', 'path', 'size'];
}
