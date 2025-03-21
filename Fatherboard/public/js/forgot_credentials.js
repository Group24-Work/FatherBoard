
let password_form = null;

let csrf_val= null;

let forgot_pass_url = "/forgot"

let email_textarea = null;
document.addEventListener("DOMContentLoaded", function(y)
{
    password_form = document.getElementById("password_form");

    csrf_val = document.getElementsByName("csrf-token")[0].getAttribute("content")

    email_textarea = document.getElementById("email_input")


    password_form.addEventListener("submit", function(x)
{
    console.log("Submitted")
    x.preventDefault();
    forgotPass()
})
    console.log(y);
})


function forgotPass()
{
    let fd = new FormData()
    fd.append("Email", email_textarea.value);
    fetch(forgot_pass_url,
        {
            method : "POST",
            headers : {
                "X-CSRF-TOKEN" : csrf_val
            },
            body : fd
        }
    )

    let info_box = document.getElementById("info_box")
    info_box.removeAttribute("hidden")
}