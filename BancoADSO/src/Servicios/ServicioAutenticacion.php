<?php

declare(strict_types=1);

namespace App\Servicios;

use App\Modelos\Cuenta;
use App\Repositorios\RepositorioCuenta;
use App\Repositorios\RepositorioUsuario;

final class ServicioAutenticacion
{
    public function __construct(
        private readonly RepositorioCuenta $repositorioCuenta,
        private readonly RepositorioUsuario $repositorioUsuario
    ) {
    }

    public function autenticar(
        string $numeroCuenta,
        string $contrasena
    ): ?Cuenta {
        $cuenta = $this->repositorioCuenta->buscarPorNumero(
            $numeroCuenta
        );

        if ($cuenta === null) {
            return null;
        }

        $usuario = $this->repositorioUsuario->buscarPorCuentaId(
            $cuenta->getId()
        );

        if ($usuario === null) {
            return null;
        }

        if (
            !password_verify(
                $contrasena,
                $usuario->getClaveHash()
            )
        ) {
            return null;
        }

        return $cuenta;
    }
}