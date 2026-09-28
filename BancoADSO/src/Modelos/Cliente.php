<?php

declare(strict_types=1);

namespace App\Modelos;

final class Cliente
{
    public function __construct(
        private readonly int $id,
        private string $nombre
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
}