<?php
$host = 'localhost';
$dbname = 'grupo107';
$user = 'web';
$password = 'web';

$paymentSuccess = false; // Variável para controlar o estado do pagamento

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validação e captura dos dados do formulário
    $nome = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $morada = isset($_POST['address']) ? $_POST['address'] : '';
    $codigo_postal = isset($_POST['postal_code']) ? $_POST['postal_code'] : '';
    $telefone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $metodo_pagamento = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $carrinho = isset($_POST['cart']) ? json_decode($_POST['cart'], true) : [];

    // Validação dos campos básicos
    if (empty($nome) || empty($email) || empty($morada) || empty($codigo_postal) || empty($telefone) || empty($metodo_pagamento)) {
        die("Por favor, preencha todos os campos.");
    }

    // Validação do carrinho
    if (!is_array($carrinho) || empty($carrinho)) {
        die("O carrinho está vazio ou mal formatado.");
    }

    try {
        // Calcular o preço total do pedido
        $preco_total = 0;
        foreach ($carrinho as $item) {
            $preco_total += $item['quantity'] * $item['price'];
        }

        // Inserir pedido na base de dados
        $stmt = $pdo->prepare("INSERT INTO pedidos (nome_cliente, email_cliente, telemovel_cliente, endereco_entrega, metodo_pagamento, preco_total) 
                               VALUES (:nome, :email, :telefone, :endereco, :metodo, :preco_total)");
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':endereco' => $morada . " - " . $codigo_postal,
            ':metodo' => $metodo_pagamento,
            ':preco_total' => $preco_total
        ]);

        // Obter o ID do pedido inserido
        $pedido_id = $pdo->lastInsertId();

        // Inserir itens do pedido
        foreach ($carrinho as $item) {
            // Verifique se os campos necessários existem
            if (!isset($item['name'], $item['quantity'], $item['price'])) {
                continue; // Ignorar itens inválidos
            }

            // Buscar o ID do produto pelo nome
            $stmt_produto = $pdo->prepare("SELECT id FROM produtos WHERE nome = :nome");
            $stmt_produto->execute([':nome' => $item['name']]);
            $produto = $stmt_produto->fetch(PDO::FETCH_ASSOC);

            if ($produto) {
                $produto_id = $produto['id'];
                $preco_total_produto = $item['quantity'] * $item['price'];

                // Inserir o produto no pedido
                $stmt = $pdo->prepare("INSERT INTO produtos_pedidos (pedido_id, produto_id, quantidade, preco_unitario, preco_total_produto)
                                       VALUES (:pedido_id, :produto_id, :quantidade, :preco, :preco_total)");
                $stmt->execute([
                    ':pedido_id' => $pedido_id,
                    ':produto_id' => $produto_id,
                    ':quantidade' => $item['quantity'],
                    ':preco' => $item['price'],
                    ':preco_total' => $preco_total_produto,
                ]);
            } else {
                // Produto não encontrado na tabela 'produtos'
                echo "Produto '{$item['name']}' não encontrado. Não foi possível processar o pedido para este produto.";
            }
        }

        // Limpar o carrinho de localStorage após o pagamento ser confirmado
        echo "<script>localStorage.removeItem('cart');</script>";

        $paymentSuccess = true; // Marcar pagamento como bem-sucedido
    } catch (PDOException $e) {
        die("Erro ao processar o pedido: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - Broken Time Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <main>
        <div class="container">
            <?php if ($paymentSuccess): ?>
                <div class="alert alert-success mt-5" role="alert">
                    <h4 class="alert-heading">Pagamento confirmado!</h4>
                    <p>Obrigado pela sua compra. O pagamento foi realizado com sucesso.</p>
                    <button class="btn btn-primary" onclick="window.location.href='index.php'">OK</button>
                </div>
            <?php else: ?>
                <h1>Pagamento</h1>
                <h4>Total a pagar: <span id="total-price">€0.00</span></h4>

                <!-- Formulário de pagamento -->
                <form id="payment-form" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Morada</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="postal-code" class="form-label">Código Postal</label>
                        <input type="text" class="form-control" id="postal-code" name="postal_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment-method" class="form-label">Método de Pagamento</label>
                        <select class="form-select" id="payment-method" name="payment_method" required>
                            <option value="" disabled selected>Escolha um método de pagamento</option>
                            <option value="credit-card">Cartão de Crédito</option>
                            <option value="paypal">PayPal</option>
                            <option value="mbway">MB WAY</option>
                        </select>
                    </div>

                    <!-- Campo oculto para enviar o carrinho -->
                    <input type="hidden" name="cart" id="cart">

                    <!-- Botões de pagamento -->
                    <div class="button-group">
                        <button type="submit" class="btn btn-success">Confirmar Pagamento</button>
                        <button type="button" class="btn btn-danger" onclick="cancelPayment()">Cancelar Pagamento</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </main>
    
    <script>
        // Carregar preço total ao abrir a página
        function loadTotalPrice() {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            const totalPrice = cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
            document.getElementById('total-price').textContent = `€${totalPrice.toFixed(2)}`;
        }

        // Função para preencher o campo 'cart' no envio do formulário
        document.getElementById('payment-form').onsubmit = function() {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

            if (cartItems.length === 0) {
                alert('O carrinho está vazio.');
                return false; // Impede o envio do formulário se o carrinho estiver vazio
            }

            // Preencher o campo oculto com o carrinho em JSON
            document.getElementById('cart').value = JSON.stringify(cartItems);
        };

        // Função de cancelamento de pagamento
        function cancelPayment() {
            const userConfirmed = confirm('Deseja cancelar o pagamento?');
            if (userConfirmed) {
                // Limpar o carrinho de localStorage após o pagamento ser cancelado
                localStorage.removeItem('cart');
                alert('Pagamento cancelado.');
                window.location.href = 'index.php'; // Redireciona para a página index
            }
        }

        // Carregar o total quando a página for aberta
        window.onload = loadTotalPrice;
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>