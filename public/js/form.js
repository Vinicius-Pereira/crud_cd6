$(document)
    .ready(function()
    {
        var form = document.getElementById("form");
        form.addEventListener("submit", validate);
        document.getElementById('phone')
            .addEventListener('input', phoneMask);
    });

function validate(event)
{
    let name = document.getElementById("name");
    let phone = document.getElementById("phone");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let password2 = document.getElementById("password_2");

    var errors = [];
    var regexCharacters = /^[a-zA-Z\s]+$/;
    var regexNumbers = /^[0-9()-]+$/;

    if(name.value === "")
    {
        errors.push("O nome não pode ficar em branco!");
    }
    if(!regexCharacters.test(name.value))
    {
        errors.push("O nome só pode conter caracteres válidos!");
    }
    if(phone.value === "")
    {
        errors.push("O telefone não pode ficar em branco!");
    }
    if(email.value === "")
    {
        errors.push("O email não pode ficar em branco!");
    }
    if(password.value === "")
    {
        errors.push("A senha não pode ficar em branco!");
    }
    if(password2.value === "")
    {
        errors.push("A confirmação da senha não pode ficar em branco!");
    }
    if(password2.value != password.value)
    {
        errors.push("As senhas não são idênticas!");
    }

    if(errors.length > 0)
    {
        event.preventDefault();
        displayError(errors);
    }

}

function displayError(errors)
{
    let container = document.getElementById("error_message");
    container.innerHTML = "<ul>";
    errors.forEach(message =>
    {
        container.innerHTML += "<li>" + message + "</li>";
    });
    container.innerHTML += "</ul>";
}

function phoneMask(event)
{
    var x = event.target.value.replace(/\D/g, '')
        .match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
    event.target.value = !x[2] ? x[1] : `(${x[1]}) ${x[2]}` + (x[3] ? `-${x[3]}` : '');
}