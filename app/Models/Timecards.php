<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timecards extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'timecards_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'c_date',
        'c_in',
        'c_out',
        'status',
    ];
}
