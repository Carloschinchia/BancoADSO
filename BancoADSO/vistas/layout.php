<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= htmlspecialchars(
            $tituloPagina ?? 'Banco ADSO',
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </title>

    <link
        rel="stylesheet"
        href="estilos.css"
    >
</head>

<body>

    <main>
        <?= $contenido ?>
    </main>

</body>
</html>