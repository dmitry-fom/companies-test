<?php

namespace App\Dto;

use Illuminate\Http\Request;

class CompanyDto
{
    public function __construct(
        public int $userId,
        public string $title,
        public string $description,
        public string $phone
    ) {}

    public static function createFromRequest(Request $request): self
    {
        return new self(
            $request->get('user_id'),
            $request->get('title'),
            $request->get('description'),
            $request->get('phone')
        );
    }
}
