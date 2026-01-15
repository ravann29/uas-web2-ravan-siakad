<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\ProgramStudi;


class User extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
    'nim',
    'name',
    'email',
    'password',
    'role',
    'photo',
    'tanggal_lahir',
    'program_studi_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

       public function programStudi()
{
    return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
}

}