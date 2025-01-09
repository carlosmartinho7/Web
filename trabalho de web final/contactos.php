<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos - Broken Time Machine</title>

    <!-- Links para os estilos do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Inclusão da Navbar -->
    <?php include 'navbar.php' ?>

    <!-- Seção principal de contacto -->
    <div class="container mt-5">
        <h2 class="text-center">Entre em Contacto</h2>

        <?php
        // Conexão com a base de dados
        include 'connection/connection.php';


        // Verifica se o formulário foi submetido
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura os dados do formulário
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);

            // Validações básicas
            if (empty($name) || empty($email) || empty($message)) {
                echo '<div class="alert alert-danger text-center">Todos os campos são obrigatórios!</div>';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="alert alert-danger text-center">Por favor, insira um email válido!</div>';
            } else {
                try {
                    // Insere os dados na tabela mensagens_contacto
                    $sql = "INSERT INTO mensagens_contacto (nome, email, assunto, mensagem) VALUES (:name, :email, 'Contacto', :message)";
                    $stmt = $pdo->prepare($sql); 
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':message', $message);
                    $stmt->execute();

                    echo '<div class="alert alert-success text-center">Mensagem enviada com sucesso!</div>';
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger text-center">Erro ao enviar a mensagem: ' . $e->getMessage() . '</div>';
                }
            }
        }
        ?>

        <!-- Formulário de contacto -->
        <form class="mt-4" action="contactos.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensagem <span class="text-danger">*</span></label>
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Escreva a sua mensagem" required></textarea>
            </div>
            <button type="submit" class="btn btn-light">Enviar</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
    <!-- Bootstrap Bundle JS (inclui Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
</body>

</html>
