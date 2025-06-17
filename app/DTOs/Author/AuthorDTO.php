<?php

namespace App\DTOs\Author;

class AuthorDTO
{
    public ?int $id;
    public ?string $name;
    public ?string $birthday;

    public function __construct(?int $id = null, ?string $name = null, ?string $birthday = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthday = $birthday;
    }
}
