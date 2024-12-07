<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Broken Time Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
            
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #111;
            color: #f5f5f5;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        .cart-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #222;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .cart-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        #cart-items {
            list-style-type: none;
            padding: 0;
        }

        #cart-items li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #333;
            font-size: 1.2rem;
        }

        #cart-items li:last-child {
            border-bottom: none;
        }

        #total-price {
            text-align: right;
            margin-top: 20px;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .clear-cart-btn {
            background-color: #ff5722;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            display: block;
            margin: 20px auto 0;
            width: 100%;
            max-width: 200px;
        }

        .clear-cart-btn:hover {
            background-color: #e64a19;
        }

        .quantity-btn {
            background-color: #444;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .quantity-btn:hover {
            background-color: #555;
        }

        footer {
            background-color: #222;
            padding: 20px;
            text-align: center;
            color: #bbb;
        }

        .quantity-controls button {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            line-height: 1;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main>
        <div class="container mt-5">
            <h1 class="text-center mb-4"> Carrinho</h1>
            <div id="cart-items" class="mb-4"></div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-danger" id="clear-cart">Limpar Carrinho</button>
                <button class="btn btn-success" id="checkout">Efetuar Pagamento</button>
            </div>
        </div>
    </main>

    <footer class="text-center mt-5">
        <p>&copy; 2024 Broken Time Machine. Todos os direitos reservados.</p>
    </footer>
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

    // Adicionar event listeners para controlo de quantidades
    function attachQuantityControlListeners() {
        document.querySelectorAll('.increase').forEach(button => {
            button.addEventListener('click', () => updateQuantity(button.dataset.index, 1));
        });
        document.querySelectorAll('.decrease').forEach(button => {
            button.addEventListener('click', () => updateQuantity(button.dataset.index, -1));
        });
    }

    // Atualizar quantidade de um item no carrinho
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



