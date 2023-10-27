<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Usuario
 * 
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $correo
 * @property string $contrasena
 * @property string $dni
 * @property bool $activo
 * 
 * @property Collection|Carrito[] $carritos
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Usuario extends Authenticatable implements JWTSubject
{
	use Notifiable;

	protected $table = 'usuarios';
	public $timestamps = false;

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'apellidos',
		'correo',
		'contrasena',
		'dni',
		'activo'
	];

	protected $hidden = [
		'contrasena'
	];


	public function carritos()
	{
		return $this->hasMany(Carrito::class);
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'usuarios_roles', 'usuario_id', 'rol_id');
	}

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}
}
