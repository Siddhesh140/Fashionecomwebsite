// Initialize the cart
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Function to add item to the cart
function addToCart(productName, productPrice, productImage) {
    const existingProductIndex = cart.findIndex(item => item.name === productName);

    if (existingProductIndex > -1) {
        // If the product already exists in the cart, increase the quantity
        cart[existingProductIndex].quantity += 1;
    } else {
        // If it's a new product, add it to the cart
        cart.push({ name: productName, price: productPrice, quantity: 1, image: productImage });
    }

    // Update localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Update cart count display
    document.getElementById('cartCount').innerText = cart.length;
}
