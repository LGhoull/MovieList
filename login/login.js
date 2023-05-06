function signIn(username, password) {
    if(username == 'test' && password == 'test')
    {
        alert('signin successful');
    }
}

var signinButton = document.getElementById('signin-button');
var usernameInput = document.getElementById('username-input');
var passwordInput = document.getElementById('password-input');

signinButton.addEventListener('click', signIn(usernameInput.value, passwordInput.value));