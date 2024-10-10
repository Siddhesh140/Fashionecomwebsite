// Select elements from the DOM
const paymentMethodSelect = document.getElementById('paymentMethod');
const paymentDetailsDiv = document.getElementById('paymentDetails');
const upiInputDiv = document.getElementById('upiInput');
const qrPopupDiv = document.getElementById('qrPopup');
const codConfirmationDiv = document.getElementById('codConfirmation');
const confirmPaymentButton = document.getElementById('confirmPaymentButton');

// Function to handle payment method selection
paymentMethodSelect.addEventListener('change', function() {
    // Hide all payment details initially
    paymentDetailsDiv.style.display = 'block'; // Show the payment details section
    upiInputDiv.style.display = 'none';
    qrPopupDiv.style.display = 'none';
    codConfirmationDiv.style.display = 'none';
    confirmPaymentButton.style.display = 'none';

    switch (paymentMethodSelect.value) {
        case 'upi':
            upiInputDiv.style.display = 'block'; // Show UPI input
            confirmPaymentButton.style.display = 'block'; // Show confirm button
            break;
        case 'qr':
            qrPopupDiv.style.display = 'block'; // Show QR code
            confirmPaymentButton.style.display = 'block'; // Show confirm button
            break;
        case 'cod':
            codConfirmationDiv.style.display = 'block'; // Show COD confirmation
            confirmPaymentButton.style.display = 'block'; // Show confirm button
            break;
        default:
            paymentDetailsDiv.style.display = 'none'; // Hide payment details section
            break;
    }
});

// Confirm payment method and show confirmation message
confirmPaymentButton.addEventListener('click', function() {
    let message = '';

    switch (paymentMethodSelect.value) {
        case 'upi':
            const upiId = document.getElementById('upiId').value;
            if (upiId) {
                message = `UPI ID ${upiId} confirmed! Thank you for your purchase.`;
            } else {
                alert('Please enter a valid UPI ID.');
                return;
            }
            break;
        case 'qr':
            message = 'QR Code payment method confirmed! Thank you for your purchase.';
            break;
        case 'cod':
            message = 'Cash on Delivery payment method confirmed! Thank you for your purchase.';
            break;
        default:
            alert('Please select a valid payment method.');
            return;
    }

    alert(message);
    // Redirect to a thank you or confirmation page
    // window.location.href = "thankyou.html"; // Uncomment this for redirection
});
