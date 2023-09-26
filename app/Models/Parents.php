<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $primaryKey = 'parents_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'prefix_name',
       'first_name',
       'last_name',
       'relationship',
       'job',
    ];
    public function students(){
        return $this->hasMany(Student::class,'parents_id');
    }
}
