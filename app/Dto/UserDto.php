<?php

namespace App\Dto;

use Illuminate\Http\Request;

class UserDto
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public string $password
    ) {}

    public static function createFromRequest(Request $request): self
    {
        return new self(
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('email'),
            $request->get('phone'),
            $request->get('password')
        );
    }
}
