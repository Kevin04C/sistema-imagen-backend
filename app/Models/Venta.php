<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Venta
 * 
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property int $dni
 * @property Carbon $fecha
 * 
 * @property Collection|Producto[] $productos
 * @property Collection|Servicio[] $servicios
 *
 * @package App\Models
 */
class Venta extends Model
{
	protected $table = 'ventas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'dni' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'nombres',
		'apellidos',
		'dni',
		'fecha'
	];

	public function productos()
	{
		return $this->belongsToMany(Producto::class, 'productos_ventas', 'venta_id', 'productos_id')
					->withPivot('cantidad', 'total');
	}

	public function servicios()
	{
		return $this->belongsToMany(Servicio::class, 'servicios_ventas')
					->withPivot('cantidad', 'total');
	}
}
