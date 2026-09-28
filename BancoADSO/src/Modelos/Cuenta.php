<?php

declare(strict_types=1);

namespace App\Modelos;

final class Cuenta
{
    public function __construct(
        private readonly int $id,
        private readonly string $numeroCuenta,
        private string $saldo,
        private readonly int $clienteId
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumeroCuenta(): string
    {
        return $this->numeroCuenta;
    }

    public function getSaldo(): string
    {
        return $this->saldo;
    }

    public function getClienteId(): int
    {
        return $this->clienteId;
    }

    public function setSaldo(string $saldo): void
    {
        $this->saldo = $saldo;
    }
}