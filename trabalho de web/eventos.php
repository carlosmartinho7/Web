<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos - Broken Time Machine</title>
    <!-- Bootstrap CSS -->  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #111;
            color: #f5f5f5;
        }
        .event-item {
            background-color: #222;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            
            align-items: flex-start;
            justify-content: space-between;
        }
        .event-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
            max-width: 100%; /* Impede que a imagem ultrapasse o tamanho disponível */
        }
        .event-info {
            flex: 1; /* Garantir que a área de texto ocupe o restante do espaço */
            min-width: 250px; /* Garante que o conteúdo do evento tenha espaço suficiente */
            margin-bottom: 10px; /* Para dar mais espaço quando a imagem e o mapa se ajustam */
        }
        .event-item h5 {
            color: #f5f5f5;
        }
        .event-item p {
            color: #bbb;
        }
        .map-container iframe {
            width: 100%; /* Ajusta a largura do mapa para ocupar todo o espaço disponível */
            max-width: 300px; /* Define o tamanho máximo do mapa */
            height: 150px;
            border: none;
            border-radius: 8px;
            margin-top: 10px; /* Dará espaço entre o mapa e o conteúdo */
        }
        @media (max-width: 768px) {
            .event-item {
                flex-direction: column; /* Coloca os itens um embaixo do outro */
                align-items: flex-start;
            }
            .event-item img {
                margin-right: 0;
                margin-bottom: 15px;
                max-width: 250px; /* Limita o tamanho da imagem */
                height: auto; /* Mantém a proporção da imagem */
            }
            .map-container iframe {
                max-width: 100%; /* Ocupa a largura disponível em telas menores */
                height: 200px; /* Aumenta um pouco a altura para melhor visualização em dispositivos móveis */
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

<!-- Eventos -->
<section class="container mt-5">
    <h2 class="section-title text-center mb-4">Eventos</h2>

    <!-- Evento 1 -->
    <div class="event-item">
        <img src="img/cartaz102821_grande.png" alt="Cartaz do Salão Brasil">
        <div class="event-info">
            <h5>Salão Brasil</h5>
            <p>Data: 20 de dezembro - Local: Coimbra</p>
            <a href="#" class="btn btn-outline-light btn-sm">Comprar Ingressos</a>
        </div>
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3111.4702479225173!2d-8.4286231!3d40.2056414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22737995b2d945%3A0xc9de5a7f6f31d6e4!2sSal%C3%A3o%20Brasil%2C%20Coimbra!5e0!3m2!1spt!2spt!4v1690225901023!5m2!1spt!2spt" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>

    <!-- Evento 2 -->
    <div class="event-item">
        <img src="img/festival-verao.jpg" alt="Cartaz do Festival de Verão">
        <div class="event-info">
            <h5>Festival de Verão</h5>
            <p>Data: 15 de Julho - Local: Algarve</p>
            <a href="#" class="btn btn-outline-light btn-sm">Comprar Ingressos</a>
        </div>
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3129.111882400622!2d-8.2292036!3d37.0881134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1ab3b9f826f761%3A0x67c9edede2341f22!2sAlgarve!5e0!3m2!1spt!2spt!4v1690226037155!5m2!1spt!2spt" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-center p-3">
    <p>&copy; 2024 Banda de Rock. Todos os direitos reservados.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
