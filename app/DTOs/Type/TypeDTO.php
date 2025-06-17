<?php

namespace App\DTOs\Type;

class TypeDTO
{
    public ?int $id;
    public ?string $name;
    public ?int $type_parent_id;

    public function __construct(?int $id = null, ?string $name = null, ?int $type_parent_id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type_parent_id = $type_parent_id;
    }
}
