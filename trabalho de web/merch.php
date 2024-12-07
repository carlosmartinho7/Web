<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merch - Broken Time Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .merch-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .merch-item {
            background-color: #222;
            padding: 25px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            width: 100%;
            max-width: 320px;
            margin: 10px;
            height: 480px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .merch-item img {
            width: 100%;
            max-height: 220px;
            object-fit: contain;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #333;
        }

        .merch-item h5 {
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .merch-item p {
            font-size: 1.2rem; 
            font-weight: bold;
            color: #ccc;
            margin-bottom: 15px;
        }

        .merch-item button {
            background-color: #ff5722;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .merch-item button:hover {
            background-color: #e64a19;
        }

        .container h2 {
            margin-bottom: 30px;
            font-size: 2.2rem;
            text-align: center;
            margin-top: 50px;
        }

        footer {
            background-color: #222;
            padding: 20px;
            text-align: center;
            color: #bbb;
        }

        .modal-content {
        color: black; /* Texto branco para contraste */
        font-size: 1rem; /* Tamanho adequado */
        font-weight: normal; /* Peso padrão para clareza */
        }

    .modal-title {
        font-weight: bold; /* Destacar o título */
    }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <main>
        <div class="container">
            <h2>Merch Oficial</h2>
            <div class="merch-container">
                <div class="merch-item">
                    <img src="img/gorro.png" alt="Gorro" class="img-fluid">
                    <h5>Gorro</h5>
                    <p>€ 100,00</p>
                    <button class="btn add-to-cart" data-name="Gorro" data-price="100">Adicionar ao Carrinho</button>
                </div>
                <div class="merch-item">
                    <img src="img/chapeu.png" alt="Boné" class="img-fluid">
                    <h5>Boné</h5>
                    <p>€ 60,00</p>
                    <button class="btn add-to-cart" data-name="Boné" data-price="60">Adicionar ao Carrinho</button>
                </div>
                <div class="merch-item">
                    <img src="img/img ep.png" alt="EP" class="img-fluid">
                    <h5>EP - Call Me by My Name</h5>
                    <p>€ 30,00</p>
                    <button class="btn add-to-cart" data-name="EP - Call Me by My Name" data-price="30">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Broken Time Machine. Todos os direitos reservados.</p>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Você deseja adicionar o item <strong id="modal-product-name"></strong> ao carrinho?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmAddToCart">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const productName = button.getAttribute('data-name');
                const productPrice = parseFloat(button.getAttribute('data-price'));
                
                productToAdd = { name: productName, price: productPrice };

                document.getElementById('modal-product-name').textContent = productName;

                const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
                modal.show();
            });
        });

        document.getElementById('confirmAddToCart').addEventListener('click', () => {
            if (productToAdd) {
                let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
                const existingItem = cartItems.find(item => item.name === productToAdd.name);

                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    cartItems.push({ ...productToAdd, quantity: 1 });
                }

                localStorage.setItem('cart', JSON.stringify(cartItems));
                if (typeof updateCartCount === 'function') {
                    updateCartCount();
                } else {
                    console.error("Função updateCartCount não está definida.");
                }

                const modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
                modal.hide();
            }
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="navbar.js" type="module"></script>
</body>
</html>

