<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductosVenta
 * 
 * @property int $venta_id
 * @property int $productos_id
 * @property int $cantidad
 * @property float $total
 * 
 * @property Producto $producto
 * @property Venta $venta
 *
 * @package App\Models
 */
class ProductosVenta extends Model
{
	protected $table = 'productos_ventas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'venta_id' => 'int',
		'productos_id' => 'int',
		'cantidad' => 'int',
		'total' => 'float'
	];

	protected $fillable = [
		'cantidad',
		'total'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'productos_id');
	}

	public function venta()
	{
		return $this->belongsTo(Venta::class);
	}
}
