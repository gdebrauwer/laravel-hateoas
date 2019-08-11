<?php

namespace GDebrauwer\Hateoas\Tests\App\Http\Resources;

use GDebrauwer\Hateoas\HasLinks;
use Illuminate\Http\Resources\Json\JsonResource;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoas;

class MessageResourceWithExplicitHateoasClass extends JsonResource
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
            '_links' => $this->links(MessageHateoas::class),
        ];
    }
}
