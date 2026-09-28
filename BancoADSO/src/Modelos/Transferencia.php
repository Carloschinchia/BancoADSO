<?php

declare(strict_types=1);

namespace App\Modelos;

final class Transferencia
{
    public function __construct(
        private readonly int $id,
        private readonly int $cuentaOrigenId,
        private readonly int $cuentaDestinoId,
        private readonly string $valor,
        private readonly string $fecha
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCuentaOrigenId(): int
    {
        return $this->cuentaOrigenId;
    }

    public function getCuentaDestinoId(): int
    {
        return $this->cuentaDestinoId;
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