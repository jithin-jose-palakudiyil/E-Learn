const togglePassword = document.querySelector('#passwordToggleIcon');
const password = document.querySelector('#passwordField');

togglePassword.addEventListener('click', function (e) {
// toggle the type attribute
const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
password.setAttribute('type', type);
// toggle the eye slash icon
this.classList.toggle('la-eye-slash');
});



const toggleConfirmPassword = document.querySelector('#passwordConfirmToggleIcon');
const confirmPassword = document.querySelector('#passwordConfirmField');

toggleConfirmPassword.addEventListener('click', function (e) {
// toggle the type attribute
const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
confirmPassword.setAttribute('type', type);
// toggle the eye slash icon
this.classList.toggle('la-eye-slash');
});

