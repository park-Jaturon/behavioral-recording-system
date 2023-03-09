<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    use HasFactory;
    protected $primaryKey = 'behavior_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'student_id',
       'type',
       'description',
       'url_images',
    ];

    public function images(){
        return $this->belongsTo(Student::class,'student_id','student_id');
    }
}
