<?php

$transferencias = $resumen['transferencias'] ?? [];

$datosResumen = $resumen['resumen'] ?? [
    'cantidad' => 0,
    'total' => '0.00',
];

?>

<div class="contenedor">

    <h1>Historial de transferencias</h1>

    <section class="resumen">

        <h2>Resumen</h2>

        <p>
            <strong>Cantidad de transferencias:</strong>
            <?= $datosResumen['cantidad'] ?>
        </p>

        <p>
            <strong>Total transferido:</strong>
            $<?= htmlspecialchars(
                $datosResumen['total'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>

    </section>

    <section>

        <h2>Transferencias realizadas</h2>

        <?php if (count($transferencias) === 0): ?>

            <p>No tienes transferencias registradas.</p>

        <?php else: ?>

            <table class="tabla-historial">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cuenta destino</th>
                        <th>Valor</th>
                        <th>Fecha</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($transferencias as $transferencia): ?>

                        <tr>

                            <td>
                                <?= $transferencia->getId() ?>
                            </td>

                            <td>
                                <?= $transferencia->getCuentaDestinoId() ?>
                            </td>

                            <td>
                                $<?= htmlspecialchars(
                                    $transferencia->getValor(),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $transferencia->getFecha(),
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