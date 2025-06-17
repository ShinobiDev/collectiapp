<?php

namespace App\DTOs\User;

class UserDTO
{
    public ?int $id;
    public ?string $name;
    public ?int $type_document_id;
    public ?string $document;
    public ?string $email;
    public ?string $password;
    public ?string $birthday;
    public ?int $role_id;
    public ?int $status_id;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?int $type_document_id = null,
        ?string $document = null,
        ?string $email = null,
        ?string $password = null,
        ?string $birthday = null,
        ?int $role_id = null,
        ?int $status_id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type_document_id = $type_document_id;
        $this->document = $document;
        $this->email = $email;
        $this->password = $password;
        $this->birthday = $birthday;
        $this->role_id = $role_id;
        $this->status_id = $status_id;
    }
}
