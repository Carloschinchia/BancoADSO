<?php

declare(strict_types=1);

namespace App\Modelos;

final class Retiro
{
    public function __construct(
        private readonly int $id,
        private readonly int $cuentaId,
        private readonly string $valor,
        private readonly string $fecha,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCuentaId(): int
    {
        return $this->cuentaId;
    }

    public function getValor(): string
    {
        return $this->valor;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }
}