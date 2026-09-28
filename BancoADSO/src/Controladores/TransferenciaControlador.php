<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\Conexion;
use App\Nucleo\ControladorBase;
use App\Repositorios\RepositorioCuenta;
use App\Repositorios\RepositorioRetiro;
use App\Repositorios\RepositorioTransferencia;
use App\Repositorios\RepositorioUsuario;
use App\Servicios\ServicioAutenticacion;
use App\Servicios\ServicioCuenta;

final class TransferenciaControlador extends ControladorBase
{
    public function formularioAccion(): void
    {
        $this->requerirSesion();

        $this->renderizar('transferencia', [
            'tituloPagina' => 'Realizar transferencia',
            'error' => $this->leerFlash('flash_error'),
        ]);
    }

    public function procesarAccion(): void
    {
        $this->requerirSesion();

        $numeroCuentaDestino = trim(
            (string) ($_POST['numero_cuenta_destino'] ?? '')
        );

        $valor = trim((string) ($_POST['valor'] ?? ''));
        $contrasena = (string) ($_POST['contrasena'] ?? '');

        $resultado = $this->servicioCuenta()->transferir(
            $this->idCuentaSesion(),
            $numeroCuentaDestino,
            $valor,
            $contrasena
        );

        if (!$resultado['ok']) {
            $this->guardarFlash(
                'flash_error',
                (string) $resultado['error']
            );

            $this->redirigir('transferencia/formulario');
        }

        $this->guardarFlash(
            'flash_exito',
            'Transferencia realizada correctamente. Tu saldo ya está actualizado.'
        );

        $this->redirigir('panel/index');
    }

    public function historialAccion(): void
    {
        $this->requerirSesion();

        $resumen = $this->servicioCuenta()
            ->historialTransferenciasEnviadas(
                $this->idCuentaSesion()
            );

        $this->renderizar('historialTransferencias', [
            'tituloPagina' => 'Historial de transferencias enviadas',
            'resumen' => $resumen,
        ]);
    }

    private function servicioCuenta(): ServicioCuenta
    {
        $conexion = Conexion::obtener();

        return new ServicioCuenta(
            $conexion,
            new RepositorioCuenta($conexion),
            new RepositorioRetiro($conexion),
            new RepositorioTransferencia($conexion),
            new ServicioAutenticacion(
                new RepositorioCuenta($conexion),
                new RepositorioUsuario($conexion)
            ),
        );
    }
}