<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasFactory, HasApiTokens;

    // const TYPE_EMPLOYEE = '1';
    // const TYPE_MANAGER = '2';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'salary',
        'image',
        'manager_id',
        'phone',
        'email',
        'password',
        'department_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

     // Accessor for image_url attribute
     public function getImageUrlAttribute()
     {
        // return Storage::disk('public')->url($this->image);

         if ($this->image) {
             return asset('storage/' . $this->image); // Adjust as per your storage configuration
         }

         // Default image URL or handle if no image_path is set
         return asset('images/default.jpg'); // Replace with your default image path or URL
     }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function manager()
    {
        return $this->belongsTo(self::class, 'manager_id', 'id');
    }

    public function members()
    {
        return $this->hasMany(self::class, 'manager_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(self::class, 'department_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'employee_id', 'id');
    }
}
