<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\Conexion;
use App\Nucleo\ControladorBase;
use App\Repositorios\RepositorioCuenta;
use App\Repositorios\RepositorioUsuario;
use App\Servicios\ServicioAutenticacion;

final class LoginControlador extends ControladorBase
{
    public function mostrarAccion(): void
    {
        if (isset($_SESSION['cuenta_id'])) {
            $this->redirigir('panel/index');
        }

        $this->renderizar('login', [
            'tituloPagina' => 'Iniciar sesión',
            'error' => null,
        ]);
    }

    public function procesarAccion(): void
    {
        $numeroCuenta = trim((string) ($_POST['numero_cuenta'] ?? ''));
        $contrasena = (string) ($_POST['contrasena'] ?? '');

        $conexion = Conexion::obtener();

        $servicio = new ServicioAutenticacion(
            new RepositorioCuenta($conexion),
            new RepositorioUsuario($conexion),
        );

        $cuenta = $servicio->autenticar(
            $numeroCuenta,
            $contrasena
        );

        if ($cuenta === null) {
            $this->renderizar('login', [
                'tituloPagina' => 'Iniciar sesión',
                'error' => 'Número de cuenta o contraseña incorrectos.',
            ]);

            return;
        }

        session_regenerate_id(true);

        $_SESSION['cuenta_id'] = $cuenta->getId();

        $this->redirigir('panel/index');
    }

    public function salirAccion(): void
    {
        $_SESSION = [];

        session_destroy();

        $this->redirigir('login/mostrar');
    }
}   