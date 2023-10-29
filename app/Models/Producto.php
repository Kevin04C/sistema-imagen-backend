<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 * 
 * @property int $id
 * @property string $nombre
 * @property string $imagen
 * @property string $stock
 * @property int $categoria_id
 * @property bool $activo
 * 
 * @property Categoria $categoria
 * @property Collection|Carrito[] $carritos
 * @property Collection|Venta[] $ventas
 *
 * @package App\Models
 */
class Producto extends Model
{
	protected $table = 'productos';
	public $timestamps = false;

	protected $casts = [
		'categoria_id' => 'int',
		'activo' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'imagen',
		'stock',
		'categoria_id',
		'activo'
	];

	public function categoria()
	{
		return $this->belongsTo(Categoria::class, 'categoria_id');
	}

	public function carritos()
	{
		return $this->belongsToMany(Carrito::class, 'carrito_productos_detalles', 'producto_id', 'carritos_id')
					->withPivot('cantidad');
	}

	public function ventas()
	{
		return $this->belongsToMany(Venta::class, 'productos_ventas', 'productos_id')
					->withPivot('cantidad', 'total');
	}
}
