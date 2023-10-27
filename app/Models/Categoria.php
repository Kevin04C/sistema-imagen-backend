<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 * 
 * @property int $id
 * @property string $nombre
 * @property bool $activo
 * 
 * @property Collection|Producto[] $productos
 * @property Collection|Servicio[] $servicios
 *
 * @package App\Models
 */
class Categoria extends Model
{
	protected $table = 'categorias';
	public $timestamps = false;

	protected $casts = [
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'activo'
	];

	public function productos()
	{
		return $this->hasMany(Producto::class);
	}

	public function servicios()
	{
		return $this->hasMany(Servicio::class);
	}
}
