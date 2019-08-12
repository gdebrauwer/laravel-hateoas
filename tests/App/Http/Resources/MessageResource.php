<?php

namespace GDebrauwer\Hateoas\Tests\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use GDebrauwer\Hateoas\Traits\HasLinks;

class MessageResource extends JsonResource
{
    use HasLinks;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            '_links' => $this->links(),
        ];
    }
}
