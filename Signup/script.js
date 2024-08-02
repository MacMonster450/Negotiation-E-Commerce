const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const loginUsername = document.getElementById('login-username');
const loginPassword = document.getElementById('login-password');
const registerUsername = document.getElementById('register-username');
const registerPassword = document.getElementById('register-password');

loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    // Perform login logic here
    console.log('Login submitted');
    // Clear form fields if needed
    loginUsername.value = '';
    loginPassword.value = '';
});

registerForm.addEventListener('submit', (e) => {
    e.preventDefault();
    // Perform registration logic here
    console.log('Registration submitted');
    // Clear form fields if needed
    registerUsername.value = '';
    registerPassword.value = '';
});
