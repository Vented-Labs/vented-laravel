<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SupportPlanData
{
    public function __construct(
        public string $description,
        public string $id,
        public string $name,
        public ?string $price,
        public string $response_time,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: (string) $data['description'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            price: $data['price'] === null ? null : (string) $data['price'],
            response_time: (string) $data['response_time'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['price'] = $this->price === null ? null : $this->price;
        $data['response_time'] = $this->response_time;

        return $data;
    }
}
