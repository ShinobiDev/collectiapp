<?php

namespace App\DTOs\Category;

class EditorialDTO
{
    public ?int $id;
    public ?string $name;

    public function __construct(?int $id = null, ?string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
