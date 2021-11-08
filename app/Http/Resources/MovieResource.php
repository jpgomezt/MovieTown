<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->getTitle(),
            'plot' => $this->getPlot(),
            'critics_score' => $this->getCriticsScore(),
            'price' => $this->getPrice(),
            'rent_quantity' => $this->getRentQuantity(),
            'sell_quantity' => $this->getSellQuantity(),
            'image' => storage_path() . '/' . $this->getId() . '.png',
        ];
    }
}
