<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Servicio
 * 
 * @property int $id
 * @property string $nombre
 * @property float $precio
 * @property int $categoria_id
 * @property bool $activo
 * 
 * @property Categoria $categoria
 * @property Collection|Carrito[] $carritos
 * @property Collection|Venta[] $ventas
 *
 * @package App\Models
 */
class Servicio extends Model
{
	protected $table = 'servicios';
	public $timestamps = false;

	protected $casts = [
		'precio' => 'float',
		'categoria_id' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'precio',
		'categoria_id',
		'activo'
	];

	public function categoria()
	{
		return $this->belongsTo(Categoria::class);
	}

	public function carritos()
	{
		return $this->belongsToMany(Carrito::class, 'carrito_servicios_detalles')
					->withPivot('cantidad');
	}

	public function ventas()
	{
		return $this->belongsToMany(Venta::class, 'servicios_ventas')
					->withPivot('cantidad', 'total');
	}
}
