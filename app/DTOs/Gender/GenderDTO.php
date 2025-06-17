<?php

namespace App\DTOs\Gender;

class GenderDTO
{
    public ?int $id;
    public ?string $name;

    public function __construct(?int $id = null, ?string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
