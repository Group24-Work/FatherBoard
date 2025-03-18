let messages = null;

let csrf_val =null;
document.addEventListener("DOMContentLoaded", function(y)
{
    console.log("Welcome to the world");
    messages = document.getElementsByClassName("message");

    csrf_val = document.getElementById("csrf_token").getAttribute("content");

    for (let message of messages)
    {
        message.addEventListener("click", function(y)
    {
        let id = message.getElementsByClassName("id")[0]
        deleteMessage(id.textContent);
    })
    }
})



function deleteMessage(id)
{
    console.log(id)
    let delete_url = `/messages/${id}`

    fetch(delete_url,
        {
            method: "DELETE",
            headers:
            {"X-CSRF-TOKEN" : csrf_val}
        }
    ).then(function(x)
    {
        if (x.ok)
        {
        console.log("completed");
        location.reload(true);
        }
    })
}