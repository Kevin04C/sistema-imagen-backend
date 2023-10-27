<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarritoServiciosDetalle
 * 
 * @property int $carrito_id
 * @property int $servicio_id
 * @property int $cantidad
 * 
 * @property Carrito $carrito
 * @property Servicio $servicio
 *
 * @package App\Models
 */
class CarritoServiciosDetalle extends Model
{
	protected $table = 'carrito_servicios_detalles';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'carrito_id' => 'int',
		'servicio_id' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'cantidad'
	];

	public function carrito()
	{
		return $this->belongsTo(Carrito::class);
	}

	public function servicio()
	{
		return $this->belongsTo(Servicio::class);
	}
}
