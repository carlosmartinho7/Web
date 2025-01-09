<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merch - Broken Time Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
    <?php include 'navbar.php'; ?>

    <main>
        <div class="container">
            <h2 class="text-center mt-5">Merch Oficial</h2>
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
        // ---------------- Adicionar ao Carrinho -------------------
        let productToAdd = null; // Variável para armazenar o produto que será adicionado

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
                let cartItems;

                try {
                    cartItems = JSON.parse(localStorage.getItem('cart')) || [];
                    if (!Array.isArray(cartItems)) {
                        cartItems = [];
                    }
                } catch (e) {
                    console.error("Erro ao processar itens do carrinho: ", e);
                    cartItems = [];
                }

                const existingItem = cartItems.find(item => item.name === productToAdd.name);

                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    cartItems.push({ ...productToAdd, quantity: 1 });
                }

                localStorage.setItem('cart', JSON.stringify(cartItems));
                updateCartCount();

                const modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
                modal.hide();
            }
        });
    </script>
    
    <?php include 'footer.php'; ?>
    <!-- Bootstrap Bundle JS (inclui Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>