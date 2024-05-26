let cont = false;

let box = document.getElementById ("box");

function toggle_content () {
    cont = !cont;
    console.log(cont);
    box.innerHTML = "";

    if (cont === true) {
        // Inicio de sesión
        let newHeader = document.createElement ('div');
        newHeader.setAttribute('id', 'header');

        let newH1 = document.createElement ('h1');
        newH1.innerHTML = "Iniciar sesión"

        let newP = document.createElement ('p');
        newP.innerHTML = "¿Aún no tienes una cuenta? <a onclick='toggle_content()'>Crear cuenta</a>";



        let newBody = document.createElement ('div');
        newBody.setAttribute ('id', 'body');

        let newForm = document.createElement ('form');
        newForm.setAttribute ('action', 'src/php/login.php');
        newForm.setAttribute ('method', 'post');
        newForm.setAttribute ('id', 'form');

        let newUser = document.createElement ('input');
        newUser.setAttribute ('name', 'username');
        newUser.setAttribute ('type', 'text');
        newUser.setAttribute ('placeholder', 'Usuario');

        let newPassword = document.createElement ('input');
        newPassword.setAttribute ('name', 'password');
        newPassword.setAttribute ('type', 'password');
        newPassword.setAttribute ('placeholder', 'Contraseña');

        let newButton = document.createElement ('button');
        newButton.setAttribute ('type', 'submit');
        newButton.innerHTML = "Iniciar sesión";

        // Anidar
        newForm.appendChild (newUser);
        newForm.appendChild (newPassword);
        newForm.appendChild (newButton);

        newBody.appendChild (newForm);

        newHeader.appendChild (newH1);
        newHeader.appendChild (newP);

        box.appendChild (newHeader);
        box.appendChild (newBody);

    } else {
        // Crear cuenta
        let newHeader = document.createElement ('div');
        newHeader.setAttribute('id', 'header');

        let newH1 = document.createElement ('h1');
        newH1.innerHTML = "Crear cuenta nueva"

        let newP = document.createElement ('p');
        newP.innerHTML = "¿Ya tienes una cuenta? <a onclick='toggle_content()'>Iniciar sesión</a>";



        let newBody = document.createElement ('div');
        newBody.setAttribute ('id', 'body');

        let newForm = document.createElement ('form');
        newForm.setAttribute ('action', 'src/php/register.php');
        newForm.setAttribute ('method', 'post');
        newForm.setAttribute ('id', 'form');

        let newUser = document.createElement ('input');
        newUser.setAttribute ('name', 'username');
        newUser.setAttribute ('type', 'text');
        newUser.setAttribute ('placeholder', 'Usuario');

        let newEmail = document.createElement ('input');
        newEmail.setAttribute ('name', 'email');
        newEmail.setAttribute ('type', 'email');
        newEmail.setAttribute ('placeholder', 'Correo electrónico');

        let newPassword = document.createElement ('input');
        newPassword.setAttribute ('name', 'password');
        newPassword.setAttribute ('type', 'password');
        newPassword.setAttribute ('placeholder', 'Contraseña');

        let newConfirmPassword = document.createElement ('input');
        newConfirmPassword.setAttribute ('name', 'confirm_password');
        newConfirmPassword.setAttribute ('type', 'password');
        newConfirmPassword.setAttribute ('placeholder', 'Confirmar contraseña');

        let newButton = document.createElement ('button');
        newButton.setAttribute ('type', 'submit');
        newButton.innerHTML = "Crear cuenta";

        // Anidar
        newForm.appendChild (newUser);
        newForm.appendChild (newEmail);
        newForm.appendChild (newPassword);
        newForm.appendChild (newConfirmPassword);
        newForm.appendChild (newButton);

        newBody.appendChild (newForm);

        newHeader.appendChild (newH1);
        newHeader.appendChild (newP);

        box.appendChild (newHeader);
        box.appendChild (newBody);
    }
}