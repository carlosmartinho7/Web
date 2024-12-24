<?php
// Conectar ao banco de dados
include 'connection.php'; // Arquivo de conexão ao banco de dados

// Verificar se o formulário de comentário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && isset($_POST['media_id'])) {
    $comment = trim($_POST['comment']);
    $media_id = $_POST['media_id'];

    if (!empty($comment)) {
        // Escapar caracteres especiais para evitar XSS
        $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');

        // Inserir comentário no banco de dados
        $stmt = $pdo->prepare('INSERT INTO comentarios (comentario, media_id) VALUES (:comentario, :media_id)');
        $stmt->bindParam(':comentario', $comment);
        $stmt->bindParam(':media_id', $media_id);
        $stmt->execute();
    }
}

// Caminhos das mídias no diretório
$media = [
    ['id' => 1, 'tipo' => 'image', 'src' => 'img/foto1.jpeg'],
    ['id' => 2, 'tipo' => 'video', 'src' => 'img/video.mp4'],
    ['id' => 3, 'tipo' => 'image', 'src' => 'img/foto concerto.jpeg']
];
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotos e Vídeos - Broken Time Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <!-- Inclusão da Navbar e footer -->
    <?php include 'navbar.php'; ?>

    <!-- Galeria de Fotos e Vídeos -->
    <section class="container mt-5">
        <h2 class="section-title text-center mb-4">Fotos e Vídeos</h2>
        <div class="row" id="gallery-container">
            <?php foreach ($media as $item): ?>
                <div class="col-md-4 gallery-item">
                    <?php if ($item['tipo'] === 'image'): ?>
                        <img src="<?= $item['src']; ?>" alt="Foto <?= $item['id']; ?>" class="img-fluid">
                    <?php else: ?>
                        <video controls>
                            <source src="<?= $item['src']; ?>" type="video/mp4">
                            Seu navegador não suporta o elemento de vídeo.
                        </video>
                    <?php endif; ?>

                    <!-- Comentários -->
                    <div class="comments-section" id="comments-<?= $item['id']; ?>">
                        <?php
                        // Recuperar os comentários associados à mídia
                        $stmt = $pdo->prepare('SELECT comentario FROM comentarios WHERE media_id = :media_id ORDER BY data_comentario DESC');
                        $stmt->bindParam(':media_id', $item['id']);
                        $stmt->execute();
                        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($comments as $comment) {
                            echo '<div class="comment"><p>' . htmlspecialchars($comment['comentario']) . '</p></div>';
                        }
                        ?>
                    </div>

                    <!-- Formulário de Comentários -->
                    <div class="comment-form">
                        <form action="" method="post">
                            <textarea name="comment" rows="2" placeholder="Deixe um comentário..."></textarea>
                            <input type="hidden" name="media_id" value="<?= $item['id']; ?>">
                            <button type="submit">Comentar</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
