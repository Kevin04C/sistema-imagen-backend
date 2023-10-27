<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarritoProductosDetalle
 * 
 * @property int $carritos_id
 * @property int $producto_id
 * @property int $cantidad
 * 
 * @property Carrito $carrito
 * @property Producto $producto
 *
 * @package App\Models
 */
class CarritoProductosDetalle extends Model
{
	protected $table = 'carrito_productos_detalles';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'carritos_id' => 'int',
		'producto_id' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'cantidad'
	];

	public function carrito()
	{
		return $this->belongsTo(Carrito::class, 'carritos_id');
	}

	public function producto()
	{
		return $this->belongsTo(Producto::class);
	}
}
