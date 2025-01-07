<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Broken Time Machine</title>

    <!-- Link para os estilos do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Inclusão da barra de navegação e footer -->
    <?php include 'navbar.php'; ?>
    

    <main>
        <div class="container mt-5">
            <h1 class="text-center mb-4">Carrinho</h1>
            <div id="cart-items" class="mb-4"></div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-danger" id="clear-cart">Limpar Carrinho</button>
                <button class="btn btn-success" id="checkout">Efetuar Pagamento</button>
            </div>
        </div>
    </main>

    <script>
        // Carregar produtos do carrinho
        function loadCartItems() {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            const cartContainer = document.getElementById('cart-items');

            if (!cartContainer) {
                console.error("Elemento do carrinho não encontrado. Verifique o ID 'cart-items'.");
                return;
            }

            cartContainer.innerHTML = '';

            if (cartItems.length === 0) {
                cartContainer.innerHTML = '<p class="text-center text-muted">O seu carrinho está vazio.</p>';
                return;
            }

            let totalPrice = 0;
            cartItems.forEach((item, index) => {
                const itemRow = document.createElement('div');
                itemRow.className = 'd-flex justify-content-between align-items-center mb-3';
                itemRow.innerHTML = `
                    <span>${item.name}</span>
                    <div class="d-flex align-items-center">
                        <div class="quantity-controls me-3">
                            <button class="btn btn-outline-secondary decrease" data-index="${index}">-</button>
                            <span class="mx-2">${item.quantity}</span>
                            <button class="btn btn-outline-secondary increase" data-index="${index}">+</button>
                        </div>
                        <span>€ ${(item.price * item.quantity).toFixed(2)}</span>
                    </div>
                `;
                cartContainer.appendChild(itemRow);
                totalPrice += item.price * item.quantity;
            });

            const totalRow = document.createElement('div');
            totalRow.className = 'd-flex justify-content-between align-items-center mt-4 border-top pt-3';
            totalRow.innerHTML = `
                <strong>Total:</strong>
                <strong>€ ${totalPrice.toFixed(2)}</strong>
            `;
            cartContainer.appendChild(totalRow);

            attachQuantityControlListeners();
        }

        // Adicionar event listeners para controlo de quantidade
        function attachQuantityControlListeners() {
            document.querySelectorAll('.increase').forEach(button => {
                button.addEventListener('click', () => updateQuantity(button.dataset.index, 1));
            });
            document.querySelectorAll('.decrease').forEach(button => {
                button.addEventListener('click', () => updateQuantity(button.dataset.index, -1));
            });
        }

        // Atualizar quantidade de um produto no carrinho
        function updateQuantity(index, change) {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            const item = cartItems[index];

            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    cartItems.splice(index, 1); // Remove o item se a quantidade for 0
                }
                localStorage.setItem('cart', JSON.stringify(cartItems));
                loadCartItems();
                updateCartCount();
            } else {
                console.error("Item não encontrado no índice:", index);
            }
        }

        // Limpar carrinho
        document.getElementById('clear-cart')?.addEventListener('click', () => {
            if (confirm('Pretende eliminar as suas compras?')) {
                localStorage.removeItem('cart');
                loadCartItems();
                updateCartCount();
            }
        });

        // Redirecionar para a página de pagamento
        document.getElementById('checkout')?.addEventListener('click', () => {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            if (cartItems.length === 0) {
                alert('O seu carrinho está vazio. Adicione produtos antes de continuar.');
                return;
            }
            window.location.href = 'pagamento.php';
        });

        // Atualizar contador do carrinho na navbar
        function updateCartCount() {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            const totalQuantity = cartItems.reduce((total, item) => total + item.quantity, 0);

            const cartIcon = document.querySelector('.bi-cart3')?.parentNode;
            if (!cartIcon) {
                console.error("Ícone do carrinho não encontrado. Verifique a classe '.bi-cart3'.");
                return;
            }

            let cartCountElement = cartIcon.querySelector('.cart-count');
            if (!cartCountElement) {
                cartCountElement = document.createElement('span');
                cartCountElement.className = 'cart-count badge bg-danger ms-1';
                cartIcon.appendChild(cartCountElement);
            }

            cartCountElement.textContent = totalQuantity > 0 ? totalQuantity : '';
        }

        // Inicializar funções ao carregar a página
        document.addEventListener('DOMContentLoaded', () => {
            loadCartItems();
            updateCartCount();
        });
    </script>
</body>

</html>





