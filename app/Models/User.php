<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'id_centro',
        'name',
        'email',
        'password',
        'centro_nombre',
        'rol_nombre',
        'created_at',
        'updated_at',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function adminlte_image(){
      
        return "$this->profile_photo_url";
    }
    public function adminlte_desc(){
        return $this->getRoleNames()->first();
    }

    
    public function adminlte_profile(){

    }


    public function adminlte_profile_url()
    {
        return 'user/profile';
    }

    public function fichajes()
    {
        return $this->hasMany(Fichaje::class, 'id_usuario', 'id');
    }

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_usuario', 'id');
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class,'id_centro');
    }

   
}
