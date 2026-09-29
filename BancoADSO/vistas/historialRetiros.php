<?php

$retiros = $resumen['retiros'] ?? [];
$datosResumen = $resumen['resumen'] ?? [
    'cantidad' => 0,
    'total' => '0.00',
];

?>

<div class="contenedor">

    <h1>Historial de retiros</h1>

    <section class="resumen">

        <h2>Resumen</h2>

        <p>
            <strong>Cantidad de retiros:</strong>
            <?= $datosResumen['cantidad'] ?>
        </p>

        <p>
            <strong>Total retirado:</strong>
            $<?= htmlspecialchars(
                $datosResumen['total'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>

    </section>

    <section>

        <h2>Retiros realizados</h2>

        <?php if (count($retiros) === 0): ?>

            <p>No tienes retiros registrados.</p>

        <?php else: ?>

            <table class="tabla-historial">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Valor</th>
                        <th>Fecha</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($retiros as $retiro): ?>

                        <tr>

                            <td>
                                <?= $retiro->getId() ?>
                            </td>

                            <td>
                                $<?= htmlspecialchars(
                                    $retiro->getValor(),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $retiro->getFecha(),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        <?php endif; ?>

    </section>

    <div class="acciones-secundarias">

        <a href="index.php?ruta=panel/index">
            Volver al panel
        </a>

    </div>

</div>