<?php

namespace GDebrauwer\Hateoas\Tests\App\Http\Resources;

use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoas;
use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResourceWithExplicitHateoasClass extends JsonResource
{
    use HasLinks;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            '_links' => $this->links(MessageHateoas::class),
        ];
    }
}
