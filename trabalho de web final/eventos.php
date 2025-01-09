<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos - Broken Time Machine</title>

    <!-- Links para os estilos do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Inclusão da Navbar e footer -->
    <?php include 'navbar.php'; ?>

    <!-- Seção de Eventos -->
    <section class="container mt-5">
        <h2 class="section-title text-center mb-4">Eventos</h2>

        <!-- Evento 1 -->
        <div class="event-item">
            <img src="img/cartaz102821_grande.png" alt="Cartaz do Salão Brasil">
            <div class="event-info">
                <h5>Salão Brasil</h5>
                <p>Data: 20 de janeiro - Local: Coimbra</p>
                <a href="https://www.bol.pt/" class="btn btn-outline-light btn-sm">Comprar Ingressos</a>
            </div>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps?q=37.019356,-7.930440&hl=pt&z=15&output=embed" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>

        <!-- Evento 2 -->
        <div class="event-item">
            <img src="img/cartaz faro.png" alt="Cartaz do Festival de Verão">
            <div class="event-info">
                <h5>Festival de Verão</h5>
                <p>Data: 2 de setembro - Local: Faro</p>
                <a href="https://www.bol.pt/" class="btn btn-outline-light btn-sm">Comprar Ingressos</a>
            </div>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps?q=37.019356,-7.930440&hl=pt&z=15&output=embed" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <!-- Bootstrap Bundle JS (inclui Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
