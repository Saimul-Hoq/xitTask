const eyeOpen = document.querySelector('.eye-open');
const eyeClose = document.querySelector('.eye-close');
const passwordInput = document.getElementById('login-password');

eyeOpen.addEventListener('click', () => {
    passwordInput.type = 'text';
    eyeOpen.classList.add('hidden');
    eyeClose.classList.remove('hidden');
});

eyeClose.addEventListener('click', () => {
    passwordInput.type = 'password';
    eyeClose.classList.add('hidden');
    eyeOpen.classList.remove('hidden');
});