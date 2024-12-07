<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - Broken Time Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Pagamento</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h4>Total a pagar: <span id="total-price">€0.00</span></h4>

                <!-- Formulário de pagamento -->
                <form id="payment-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Morada</label>
                        <input type="text" class="form-control" id="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="postal-code" class="form-label">Código Postal</label>
                        <input type="text" class="form-control" id="postal-code" required>
                    </div>

                    <div class="mb-3">
                        <label for="payment-method" class="form-label">Método de Pagamento</label>
                        <select class="form-select" id="payment-method" required>
                            <option value="" disabled selected>Escolha um método de pagamento</option>
                            <option value="credit-card">Cartão de Crédito</option>
                            <option value="paypal">PayPal</option>
                            <option value="mbway">MB WAY</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-success" onclick="confirmPayment()">Confirmar Pagamento</button>
                        <button type="button" class="btn btn-danger" onclick="cancelPayment()">Cancelar Pagamento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Carregar preço total ao abrir a página
        function loadTotalPrice() {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            const totalPrice = cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
            document.getElementById('total-price').textContent = `€${totalPrice.toFixed(2)}`;
        }

        // Função de confirmação de pagamento
        function confirmPayment() {
            const name = document.getElementById('name').value;
            const address = document.getElementById('address').value;
            const postalCode = document.getElementById('postal-code').value;
            const paymentMethod = document.getElementById('payment-method').value;

            if (!name || !address || !postalCode || !paymentMethod) {
                alert('Por favor, preencha todos os campos.');
                return;
            }

            // Realizar pagamento (simulação)
            alert(`Pagamento confirmado! \nNome: ${name} \nMorada: ${address} \nCódigo Postal: ${postalCode} \nMétodo de Pagamento: ${paymentMethod}\nObrigado pela sua compra.`);

            // Limpar carrinho após pagamento
            localStorage.removeItem('cart');
            window.location.href = 'index.php'; // Redirecionar para a página inicial
        }

        // Função de cancelamento de pagamento
        function cancelPayment() {
            const userConfirmed = confirm('Você tem certeza que deseja cancelar o pagamento?');
            if (userConfirmed) {
                alert('Pagamento cancelado. Você será redirecionado ao carrinho.');
                window.location.href = 'carrinho.php'; // Voltar para o carrinho
            }
        }

        // Carregar preço total ao carregar a página
        loadTotalPrice();
    </script>
</body>
</html>
