$(document).ready(function(){
    $('#password-addon').on('click', function(){
        var passwordInput = $('#password-input');
        var icon = $(this).find('i');

        // Cambia el tipo del campo de contraseña entre 'text' y 'password'
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            icon.removeClass('ri-eye-line').addClass('ri-eye-off-line'); // Cambia el icono a "eye-off"
        } else {
            passwordInput.attr('type', 'password');
            icon.removeClass('ri-eye-off-line').addClass('ri-eye-line'); // Cambia el icono a "eye"
        }
    });
});
