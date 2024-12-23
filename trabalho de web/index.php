<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broken Time Machine</title>
    <!-- Bootstrap CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Estilos personalizados */
        body {
            font-family: Arial, sans-serif;
            background-color: #111;
            color: #f5f5f5;
        }
        
        .navbar-dark .nav-link:hover {
            color: #f5f5f5;
        }
        
        /* Banner de Destaque */
        .banner {
            position: relative;
            background-image: url("img/foto1.jpeg");
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: #fff;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Overlay escuro */
        }
        .banner-content {
            position: relative;
            z-index: 1;
            padding: 0 20px; /* Ajuste para garantir espaçamento em telas pequenas */
        }
        .banner h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        
        .music-item {
            background-color: #333;  /* Cor de fundo escura para cada item */
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3); /* Sombra suave para destacar */
            transition: transform 0.3s ease-in-out;
        }
        .music-item:hover {
            transform: translateY(-10px); /* Efeito de elevação ao passar o mouse */
        }

        /* Cartaz do Evento - Ajuste da imagem */
        #evento-destaque .col-md-6 img {
            object-fit: contain; /* Ajusta a imagem sem cortar, garantindo que toda a imagem apareça */
            width: 100%; /* A largura da imagem será 100% do contêiner */
            height: 100%; /* A altura da imagem será 100% do contêiner */
            max-height: 400px; /* Altura máxima para evitar que a imagem fique muito grande */
            border-radius: 10px; /* Arredonda as bordas da imagem */
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>


<!-- Banner -->
<section id="home" class="banner">
    <div class="banner-overlay"></div>
    <div class="banner-content">
        <h1> FOG OF WAR </h1>
        <p>THE NEW ALBUM – OUT NOW</p>
    </div>
</section>

<!-- Seção de Evento em Destaque -->
<section id="evento-destaque" class="container my-5">
    <h2 class="section-title text-center">Próximo Evento</h2>

    <div class="row d-flex align-items-center">
        <!-- Cartaz do Evento -->
        <div class="col-md-6 mb-4 mb-md-0">
            <a href="eventos.html">
                <img 
                    src="img/cartaz102821_grande.png" 
                    alt="Cartaz do Evento"
                    class="img-fluid rounded"
                >
            </a>
        </div>

        <!-- Informações do Evento -->
        <div class="col-md-6 text-light text-center text-md-start">
            <h3>Concerto Exclusivo ao Vivo</h3>
            <p><strong>Data:</strong> 15 de Dezembro de 2024</p>
            <p><strong>Local:</strong> Salão Brasil</p>
            <p>
                Prepare-se para uma noite inesquecível com os Broken Time Machine.
                Garante já o teu bilhete
            </p>
            <a href="eventos.html" class="btn btn-outline-light btn-sm">
                Saiba Mais e Comprar Ingressos
            </a>
        </div>
    </div>
</section>

<!-- Música -->
<section id="music" class="container mt-5">
    <h2 class="section-title text-center">Música</h2>
    <div class="row d-flex align-items-stretch">
        <!-- Primeiro Álbum -->
        <div class="col-md-4 d-flex mb-4">
            <div class="music-item text-center flex-fill">
                <div class="album-cover-container" style="position: relative; overflow: hidden; border-radius: 10px;">
                    <img src="img/capa ep.png" alt="Álbum 1" class="album-cover img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
                <h5>Call Me by My Name</h5>
                <p>O primeiro EP</p>
                <!-- Ícones das Plataformas (Agora abaixo da imagem) -->
                <div class="platform-icons d-flex justify-content-center" style="margin-top: 10px;">
                    <a href="https://open.spotify.com/intl-pt/album/6nVDzsHxC3SMYWz48AHukm?si=hN34vkdfT72swKMz7Pq1cw" target="_blank" class="btn btn-outline-light btn-sm m-1">
                        <i class="bi bi-spotify"></i>
                    </a>
                    <a href="https://www.youtube.com/@brokentimemachine6992" target="_blank" class="btn btn-outline-light btn-sm m-1">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="https://music.apple.com/pt/album/call-me-by-my-name-ep/1662059154" target="_blank" class="btn btn-outline-light btn-sm m-1">
                        <i class="bi bi-apple"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Segundo Álbum -->
        <div class="col-md-4 d-flex mb-4">
            <div class="music-item text-center flex-fill">
                <div class="album-cover-container" style="position: relative; overflow: hidden; border-radius: 10px;">
                    <img src="img/capa single.png" alt="Álbum 2" class="album-cover img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
                <h5>She Said</h5>
                <p>Single</p>
                <!-- Ícones das Plataformas (Agora abaixo da imagem) -->
                <div class="platform-icons d-flex justify-content-center" style="margin-top: 10px;">
                    <a href="https://open.spotify.com/intl-pt/album/6iWf3Bf9aYw3Rb728BQYNa?si=XkjLYju-T2akEjk2L--1Ug" target="_blank" class="btn btn-outline-light btn-sm m-1">
                        <i class="bi bi-spotify"></i>
                    </a>
                    <a href="https://www.youtube.com/@brokentimemachine6992" target="_blank" class="btn btn-outline-light btn-sm m-1">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="https://music.apple.com/pt/album/she-said-single/1686001092" target="_blank" class="btn btn-outline-light btn-sm m-1">
                        <i class="bi bi-apple"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Terceiro Álbum -->
        <div class="col-md-4 d-flex mb-4">
            <div class="music-item text-center flex-fill">
                <div class="album-cover-container" style="position: relative; overflow: hidden; border-radius: 10px;">
                    <img src="img/capa album.png" alt="Álbum 3" class="album-cover img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
                <h5>Fog of War</h5>
                <p>Álbum completo</p>
                <!-- Ícones das Plataformas (Agora abaixo da imagem) -->
                <div class="platform-icons d-flex justify-content-center" style="margin-top: 10px;">
                    <a href="https://open.spotify.com/intl-pt/album/3TuvbL0NVx8crwuRVqjPFw?si=2pSIn1zgQrGu23eflVxNgw" target="_blank" class="btn btn-outline-light btn-sm m-1">
                        <i class="bi bi-spotify"></i>
                    </a>
                    <a href="https://www.youtube.com/@brokentimemachine6992" target="_blank" class="btn btn-outline-light btn-sm m-1">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="https://music.apple.com/pt/album/fog-of-war/1769281980" target="_blank" class="btn btn-outline-light btn-sm m-1">
                        <i class="bi bi-apple"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rodapé -->
<footer class="bg-dark text-light text-center py-4">
    <p>&copy; 2024 Broken Time Machine. Todos os direitos reservados.</p>
</footer>

<!-- Scripts do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
