function logout() {
    //clear fields

    window.location.replace('http://localhost/BotoPH/views/login.php');
}

document.querySelector('#logoutBtn').addEventListener('click', logout);