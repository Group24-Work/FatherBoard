

let csrf_val = null;

let new_password_element = null;
let reset_pass_form = null;

document.addEventListener("DOMContentLoaded", function(y)
{
    console.log("Loaded")
    let path = window.location.pathname
    csrf_val = document.getElementsByName("csrf-token")[0].getAttribute("content");
    new_password_element = document.getElementById("new_password");
    reset_pass_form = document.getElementById("reset_password_form")
    let pass_tok = path.replace("/reset/","");
    console.log(pass_tok);

    reset_pass_form.addEventListener("submit", function(y)
{
    y.preventDefault()
    console.log("yes");
    resetPass(pass_tok)
})


})


function resetPass(pass_tok)
{
    let fd = new FormData()
    let new_pass = new_password_element.value

    let reset_url = "/reset"
    fd.append("new_password", new_pass)
    fd.append("code",pass_tok)
fetch(reset_url, {
    method: "POST",
    headers : {
        "X-CSRF-TOKEN" : csrf_val
    },
    body: fd
}).then(function (x)
{
    document.location.href = "/login"

})

}