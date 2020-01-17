<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Nom de la table
     * @var string
     */
    protected $table = 'role';

    /**
     * Clé primaire
     * @var string
     */
    protected $primaryKey = 'role_nom';

    /**
     * Type de clé primaire(commenter si integer)
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Si la clé primaire est auto increment
     * @var bool
     */
    public $incrementing = false;

    /**
     * Tous les attributs assignables de la classe
     * @var array
     */
    protected $fillable = [
        'role_nom'
    ];

    /**
     * Les champs cachés
     * @var array
     */
    protected $hidden = [];

    /**
     * Si la classe possède created_at &&
     * update_at
     * @var bool
     */
    public $timestamps = false;

    /**
     * Récupères tous les utilisateurs d'un role
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Relation 0,n
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'role_nom');
    }
}
