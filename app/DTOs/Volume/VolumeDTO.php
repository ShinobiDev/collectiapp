<?php

namespace App\DTOs\Volume;

class VolumeDTO
{
    public ?int $id;
    public ?string $name;
    public ?int $collection_id;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?int $collection_id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->collection_id = $collection_id;
    }
}
