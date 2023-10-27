<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiciosVenta
 * 
 * @property int $servicio_id
 * @property int $venta_id
 * @property int $cantidad
 * @property float $total
 * 
 * @property Servicio $servicio
 * @property Venta $venta
 *
 * @package App\Models
 */
class ServiciosVenta extends Model
{
	protected $table = 'servicios_ventas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'servicio_id' => 'int',
		'venta_id' => 'int',
		'cantidad' => 'int',
		'total' => 'float'
	];

	protected $fillable = [
		'cantidad',
		'total'
	];

	public function servicio()
	{
		return $this->belongsTo(Servicio::class);
	}

	public function venta()
	{
		return $this->belongsTo(Venta::class);
	}
}
