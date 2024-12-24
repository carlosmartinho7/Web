// Função para atualizar o contador do carrinho na navbar
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

// Tornar a função acessível globalmente
window.updateCartCount = updateCartCount;

// Atualizar o contador ao carregar a página
document.addEventListener('DOMContentLoaded', updateCartCount);

// Função para adicionar um item ao carrinho
function addToCart(item) {
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    const existingItemIndex = cartItems.findIndex(cartItem => cartItem.id === item.id);

    if (existingItemIndex !== -1) {
        // Se o item já estiver no carrinho, apenas atualiza a quantidade
        cartItems[existingItemIndex].quantity += item.quantity;
    } else {
        // Se o item não estiver no carrinho, adiciona-o
        cartItems.push(item);
    }

    // Atualizar o localStorage com o carrinho modificado
    localStorage.setItem('cart', JSON.stringify(cartItems));

    // Atualizar o contador do carrinho
    updateCartCount();
}

document.addEventListener('click', function(event) {
    // Verifique se o clique foi no botão de adicionar ao carrinho
    if (event.target && event.target.id === 'add-to-cart-button') {
        const item = {
            id: 1,          // ID do item
            name: 'Produto Exemplo', // Nome do item
            price: 20.00,    // Preço do item
            quantity: 1      // Quantidade de item
        };
        addToCart(item);
    }
});


