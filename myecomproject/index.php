<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Street</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Welcome to Fashion Streets</h1>
        <form id="signupForm" action="signup.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required><br>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Sign Up" name="SignUp">
        </form>
        <p>Already have an account?
            <a href=" login.html">
                <button type="button" class="login-button">Log in</button>
            </a>
        </p>
    </div>
    <!-- Forgot Password Popup -->
    <div class="modal" id="overlay" style="display:none;">
        <div class="modal-content" id="forgotPasswordPopup">
            <span class="close-button" id="closePopupButton">&times;</span>
            <h2>Forgot Password</h2>
            <p>Enter your registered email address to receive an OTP:</p>
            <input type="email" id="forgotEmail" placeholder="Email" required>
            <input type="text" id="otp" placeholder="Enter OTP" style="display:none;" required>
            <div class="button-container">
                <button id="sendOtpButton" class="button">Send OTP</button>
                <button id="verifyOtpButton" class="button" style="display:none;">Verify OTP</button>
                <button id="closePopupButton" class="button cancel">Cancel</button>
            </div>
            <p id="otpMessage" class="success-message" style="display: none;"></p>
        </div>
    </div>

    <script>
        // Login functionality
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const username = document.getElementById('username').value;
            const password = hashPassword(document.getElementById('password').value);

            let users = JSON.parse(localStorage.getItem('users')) || [];
            const user = users.find(u => u.username === username && u.password === password);

            if (user) {
                localStorage.setItem('loggedInUser', JSON.stringify(user));
                window.location.href = 'dashboard.html';
            } else {
                alert('Invalid username or password.');
            }
        });

        // Hashing function
        function hashPassword(password) {
            return btoa(password);
        }

        // Show Forgot Password Popup
        document.getElementById('forgotPasswordLink').addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'flex';
        });

        // Close Popup
        document.getElementById('closePopupButton').addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'none';
        });

        // Send OTP functionality
        document.getElementById('sendOtpButton').addEventListener('click', function() {
            const email = document.getElementById('forgotEmail').value;

            if (email) {
                // Simulate sending OTP
                const otp = Math.floor(100000 + Math.random() * 900000); // Generate a random 6-digit OTP
                alert(`OTP sent to ${email}: ${otp}`); // For testing, remove in production

                // Show OTP input and verify button
                document.getElementById('otp').style.display = 'block';
                document.getElementById('verifyOtpButton').style.display = 'inline-block';
                document.getElementById('sendOtpButton').style.display = 'none';
                document.getElementById('otpMessage').innerText = 'An OTP has been sent to your email.';
                document.getElementById('otpMessage').style.display = 'block';
            } else {
                alert('Please enter a valid email address.');
            }
        });

        // Verify OTP functionality
        document.getElementById('verifyOtpButton').addEventListener('click', function() {
            const enteredOtp = document.getElementById('otp').value;
            // Compare with the generated OTP from earlier (this should be stored in a variable in real usage)
            const isValidOtp = true; // Replace with actual OTP checking logic

            if (isValidOtp) {
                alert('OTP verified successfully! You can now reset your password.');
                document.getElementById('overlay').style.display = 'none'; // Close the popup
            } else {
                alert('Invalid OTP. Please try again.');
            }
        });
    </script>
</body>

</html>

<footer>
    <p>Contact us at: info@fashion-streets.com</p>
</footer>
<script>
    function hashPassword(password) {
        return btoa(password); // base64 encoding
    }

    document.getElementById('signupForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const dob = new Date(document.getElementById('dob').value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const month = today.getMonth() - dob.getMonth();
        if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        if (age >= 14) {
            const user = {
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                dob: document.getElementById('dob').value,
                password: hashPassword(document.getElementById('password').value)
            };
            let users = JSON.parse(localStorage.getItem('users')) || [];
            users.push(user);
            localStorage.setItem('users', JSON.stringify(users));
            window.location.href = 'login.html';
        } else {
            alert('You must be at least 14 years old to sign up.');
        }
    });
</script>
</body>

</html>