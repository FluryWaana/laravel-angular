<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Nom de la table
     * @var string
     */
    protected $table = 'user';

    /**
     * Clé primaire
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Type de clé primaire(commenter si integer)
     * @var string
     */
    # protected $keyType = 'string';

    /**
     * Si la clé primaire est auto increment
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'user_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Récupère le rôle de l'utilisateur
     * Relation 1,1
     */
    public function role()
    {
        return $this->belongsTo('App\Models\User', 'role_nom');
    }
}
