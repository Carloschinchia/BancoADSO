<?php

declare(strict_types=1);

namespace App\Nucleo;

use PDO;

final class Conexion
{
    private static ?PDO $instancia = null;

    private function __construct()
    {
    }

    public static function obtener(): PDO
    {
        if (self::$instancia === null) {

            $config = require dirname(__DIR__, 2) . '/config/basedatos.php';

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['puerto'],
                $config['nombre_bd'],
                $config['charset']
            );

            self::$instancia = new PDO(
                $dsn,
                $config['usuario'],
                $config['clave'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }

        return self::$instancia;
    }
}