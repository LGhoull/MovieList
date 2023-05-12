function signIn() {
    var usernameInput = (document.getElementById('username-input')).value;
    var passwordInput = (document.getElementById('password-input')).value;
    if(usernameInput == 'test' && passwordInput == 'test')
    {
        alert('signin successful');
    }
}