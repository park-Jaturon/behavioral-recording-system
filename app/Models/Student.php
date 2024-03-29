<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rooms_id',
        'parents_id',
        'prefix_name',
        'first_name',
        'last_name',
        'birthdays',
        'symbol',
        'id_tags',
        'number',
        'father',
        'mother',
        'telephone_number_father',
        'telephone_number_mother',
        'telephone_number_bus',
        'habitations',
        'level',
        'status',
        'elevate',
        'school_year',
    ];

    public function parent(){
        return $this->belongsTo(Parents::class,'parents_id');
    }
    public function room(){
        return $this->belongsTo(Room::class, 'rooms_id');
    }
}
