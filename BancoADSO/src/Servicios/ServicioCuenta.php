<?php

declare(strict_types=1);

namespace App\Servicios;

use PDO;
use App\Repositorios\RepositorioCuenta;
use App\Repositorios\RepositorioRetiro;
use App\Repositorios\RepositorioTransferencia;

final class ServicioCuenta
{
    public function __construct(
        private readonly PDO $conexion,
        private readonly RepositorioCuenta $repositorioCuenta,
        private readonly RepositorioRetiro $repositorioRetiro,
        private readonly RepositorioTransferencia $repositorioTransferencia,
        private readonly ServicioAutenticacion $servicioAutenticacion
    ) {
    }

    public function registrarRetiro(
        int $cuentaId,
        string $valor,
        string $contrasena
    ): array {
        if (!$this->valorValido($valor)) {
            return [
                'ok' => false,
                'error' => 'El valor del retiro no es válido.',
            ];
        }

        $cuenta = $this->repositorioCuenta->buscarPorId($cuentaId);

        if ($cuenta === null) {
            return [
                'ok' => false,
                'error' => 'La cuenta no existe.',
            ];
        }

        $cuentaAutenticada = $this->servicioAutenticacion->autenticar(
            $cuenta->getNumeroCuenta(),
            $contrasena
        );

        if ($cuentaAutenticada === null) {
            return [
                'ok' => false,
                'error' => 'La contraseña es incorrecta.',
            ];
        }

        $descontado = $this->repositorioCuenta->descontarSaldo(
            $cuentaId,
            $valor
        );

        if (!$descontado) {
            return [
                'ok' => false,
                'error' => 'No tienes saldo suficiente para realizar el retiro.',
            ];
        }

        $this->repositorioRetiro->registrar(
            $cuentaId,
            $valor
        );

        return [
            'ok' => true,
            'error' => null,
        ];
    }

    public function transferir(
        int $cuentaOrigenId,
        string $numeroCuentaDestino,
        string $valor,
        string $contrasena
    ): array {
        if (!$this->valorValido($valor)) {
            return [
                'ok' => false,
                'error' => 'El valor de la transferencia no es válido.',
            ];
        }

        $cuentaOrigen = $this->repositorioCuenta->buscarPorId(
            $cuentaOrigenId
        );

        if ($cuentaOrigen === null) {
            return [
                'ok' => false,
                'error' => 'La cuenta de origen no existe.',
            ];
        }

        $cuentaDestino = $this->repositorioCuenta->buscarPorNumero(
            $numeroCuentaDestino
        );

        if ($cuentaDestino === null) {
            return [
                'ok' => false,
                'error' => 'La cuenta destino no existe.',
            ];
        }

        if ($cuentaOrigen->getId() === $cuentaDestino->getId()) {
            return [
                'ok' => false,
                'error' => 'No puedes transferir dinero a la misma cuenta.',
            ];
        }

        $cuentaAutenticada = $this->servicioAutenticacion->autenticar(
            $cuentaOrigen->getNumeroCuenta(),
            $contrasena
        );

        if ($cuentaAutenticada === null) {
            return [
                'ok' => false,
                'error' => 'La contraseña es incorrecta.',
            ];
        }

        try {
            $this->conexion->beginTransaction();

            $descontado = $this->repositorioCuenta->descontarSaldo(
                $cuentaOrigenId,
                $valor
            );

            if (!$descontado) {
                $this->conexion->rollBack();

                return [
                    'ok' => false,
                    'error' => 'No tienes saldo suficiente para realizar la transferencia.',
                ];
            }

            $this->repositorioCuenta->abonarSaldo(
                $cuentaDestino->getId(),
                $valor
            );

            $this->repositorioTransferencia->registrar(
                $cuentaOrigenId,
                $cuentaDestino->getId(),
                $valor
            );

            $this->conexion->commit();

            return [
                'ok' => true,
                'error' => null,
            ];
        } catch (\Throwable $error) {
            if ($this->conexion->inTransaction()) {
                $this->conexion->rollBack();
            }

            return [
                'ok' => false,
                'error' => 'No fue posible realizar la transferencia.',
            ];
        }
    }

    public function historialRetiros(int $cuentaId): array
    {
        return [
            'retiros' => $this->repositorioRetiro->listarPorCuenta(
                $cuentaId
            ),
            'resumen' => $this->repositorioRetiro->resumenPorCuenta(
                $cuentaId
            ),
        ];
    }

    public function historialTransferenciasEnviadas(
        int $cuentaId
    ): array {
        return [
            'transferencias' =>
                $this->repositorioTransferencia
                    ->listarEnviadasPorCuenta($cuentaId),

            'resumen' =>
                $this->repositorioTransferencia
                    ->resumenEnviadasPorCuenta($cuentaId),
        ];
    }

    private function valorValido(string $valor): bool
    {
        if (
            preg_match(
                '/^\d+(?:\.\d{1,2})?$/',
                $valor
            ) !== 1
        ) {
            return false;
        }

        $sinPunto = str_replace('.', '', $valor);

        return ltrim($sinPunto, '0') !== '';
    }
}