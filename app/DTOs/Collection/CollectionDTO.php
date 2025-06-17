<?php

namespace App\DTOs\Collection;

class CollectionDTO
{
    public ?int $id;
    public ?string $name;
    public ?int $category_id;
    public ?int $gender_id;
    public ?int $author_id;
    public ?int $editorial_id;
    public ?string $date;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?int $category_id = null,
        ?int $gender_id = null,
        ?int $author_id = null,
        ?int $editorial_id = null,
        ?string $date = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->category_id = $category_id;
        $this->gender_id = $gender_id;
        $this->author_id = $author_id;
        $this->editorial_id = $editorial_id;
        $this->date = $date;
    }
}
