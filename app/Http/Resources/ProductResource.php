<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        if ($this->resource['error']) {
            return [
                'msg' => $this->resource['msg']
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
            'photo' => $this->photo ?? 'Image available in details',
            'client_id' => $this->client_id,
            'client' => [
                'id' => $this->client->id,
                'name' => $this->client->name,
                'cpf' => $this->client->cpf,
                'address' => $this->client->address,
                'sex' => $this->client->sex == 'm' ? 'Male' : 'Female',
                'created_at' => Carbon::parse($this->client->created_at)->format('d/m/Y H:i:s'),
                'updated_at' => Carbon::parse($this->client->updated_at)->format('d/m/Y H:i:s'),
                'photo' => $this->client->photo ?? 'Image available in details',
            ]
        ];
    }
}
