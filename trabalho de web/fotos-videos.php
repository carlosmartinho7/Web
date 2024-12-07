<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotos e Vídeos - Broken Time Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="../bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #111;
            color: #f5f5f5;
        }

        .gallery-item {
            margin-bottom: 15px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        .gallery-item img, .gallery-item video {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }

        .comments-section {
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 5px;
            border-radius: 8px;
            font-size: 0.75rem;
            margin-top: 5px;
            height: 60px;
            overflow-y: auto;
        }

        .comment p {
            margin: 0;
            padding: 2px 0;
        }

        .comment-form {
            margin-top: 5px;
            display: flex;
            gap: 10px;
            justify-content: flex-start;
            align-items: center;
        }

        .comment-form textarea {
            width: 80%;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
            border-radius: 5px;
            resize: none;
            padding: 3px;
            font-size: 0.75rem;
            height: 30px;
        }

        .comment-form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 3px 12px;
            font-size: 0.75rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .comment-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<!-- Galeria de Fotos e Vídeos -->
<section class="container mt-5">
    <h2 class="section-title text-center mb-4">Fotos e Vídeos</h2>
    <div class="row" id="gallery-container"></div>
</section>

<!-- Footer -->
<footer class="bg-dark text-center p-3">
    <p>&copy; 2024 Banda de Rock. Todos os direitos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Função para carregar comentários de uma mídia
    async function loadComments(mediaId) {
        const response = await fetch(`get_comments.php?media_id=${mediaId}`);
        const comments = await response.json();
        const commentsSection = document.querySelector(`#comments-${mediaId}`);
        commentsSection.innerHTML = comments.map(comment => `<div class="comment"><p>${comment.comment_text}</p></div>`).join('');
    }

    // Função para enviar um novo comentário
    async function submitComment(mediaId) {
        const commentText = document.querySelector(`#comment-textarea-${mediaId}`).value;
        await fetch('submit_comment.php', {
            method: 'POST',
            body: new URLSearchParams({ media_id: mediaId, comment: commentText }),
        });
        loadComments(mediaId); // Atualiza os comentários após enviar
    }

    // Carregar imagens e vídeos dinamicamente (exemplo)
    const mediaData = [
        { id: 1, type: 'image', src: 'img/foto1.jpeg' },
        { id: 2, type: 'video', src: 'video.mp4' },
        { id: 1, type: 'image', src: 'img/foto1.jpeg' },
        { id: 1, type: 'image', src: 'img/foto1.jpeg' },
        { id: 1, type: 'image', src: 'img/foto1.jpeg' },
        { id: 1, type: 'image', src: 'img/foto1.jpeg' }
    ];

    const galleryContainer = document.getElementById('gallery-container');
    mediaData.forEach(media => {
        const mediaItem = document.createElement('div');
        mediaItem.classList.add('col-md-4', 'gallery-item');
        mediaItem.innerHTML = `
            ${media.type === 'image' ? `<img src="${media.src}" alt="Foto ${media.id}">` : 
            `<video controls><source src="${media.src}" type="video/mp4">Seu navegador não suporta o elemento de vídeo.</video>`}
            <div class="comments-section" id="comments-${media.id}"></div>
            <div class="comment-form">
                <textarea id="comment-textarea-${media.id}" rows="2" placeholder="Deixe um comentário..."></textarea>
                <button onclick="submitComment(${media.id})">Comentar</button>
            </div>
        `;
        galleryContainer.appendChild(mediaItem);
        loadComments(media.id); // Carregar os comentários para cada mídia
    });
</script>
</body>
</html>
