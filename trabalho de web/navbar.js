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
