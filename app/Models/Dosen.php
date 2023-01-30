<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'nid';
    protected $fillable = ['nid', 'nama'];

    public  $timestamps = false;
}
