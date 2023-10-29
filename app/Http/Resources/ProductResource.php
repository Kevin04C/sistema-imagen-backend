<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'precio' => (int) $this->precio,
            'imagen' => $this->imagen,
            'stock' => $this->stock,
            'categoria' => $this->categoria->first()->nombre,
            'activo' => $this->activo
        ];
    }
}
