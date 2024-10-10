// Fetch cart items from localStorage or initialize an empty array if not found
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Function to render the cart items
function displayCart() {
    const cartList = document.getElementById('cartList');
    cartList.innerHTML = ''; // Clear the current list

    // Loop through cart items and generate HTML for each
    cart.forEach((item, index) => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('cart-item');

        productDiv.innerHTML = `
            <input type="checkbox" class="item-checkbox" data-index="${index}">
            <img src="${item.image}" alt="${item.name}" class="cart-item-image">
            <div class="cart-item-details">
                <h3>${item.name}</h3>
                <p>Price: Rs${item.price.toFixed(2)}</p>
                <p>Quantity: ${item.quantity}</p>
            </div>
        `;

        cartList.appendChild(productDiv);
    });

    // Update the total price
    updateTotalPrice();
}

// Function to calculate and display the total price
function updateTotalPrice() {
    const totalPriceElement = document.getElementById('totalPrice');
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    totalPriceElement.innerText = `Total Price: Rs${total.toFixed(2)}`;
}

// Function to delete selected cart items
function deleteSelectedItems() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    const indicesToDelete = Array.from(checkboxes).map(cb => cb.getAttribute('data-index')).map(Number);

    // Delete the selected items from the cart array
    cart = cart.filter((_, index) => !indicesToDelete.includes(index));
    
    // Update localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Re-render the cart
    displayCart();
}

// Function to redirect to the payment page
function redirectToPayment() {
    // Check if there are items in the cart
    if (cart.length > 0) {
        window.location.href = 'payments.html'; // Redirect to payments page
    } else {
        alert('Your cart is empty! Please add items before checking out.');
    }
}

// Attach event listeners to buttons
document.getElementById('deleteSelectedButton').addEventListener('click', deleteSelectedItems);
document.getElementById('checkoutButton').addEventListener('click', redirectToPayment); // Add event listener for checkout

// Initially display the cart when the page loads
displayCart();
