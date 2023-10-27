<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carrito
 * 
 * @property int $id
 * @property int $usuario_id
 * 
 * @property Usuario $usuario
 * @property Collection|Producto[] $productos
 * @property Collection|Servicio[] $servicios
 *
 * @package App\Models
 */
class Carrito extends Model
{
	protected $table = 'carritos';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function productos()
	{
		return $this->belongsToMany(Producto::class, 'carrito_productos_detalles', 'carritos_id')
					->withPivot('cantidad');
	}

	public function servicios()
	{
		return $this->belongsToMany(Servicio::class, 'carrito_servicios_detalles')
					->withPivot('cantidad');
	}
}
