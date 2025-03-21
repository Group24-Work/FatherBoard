let messages = null;

let csrf_val =null;
let response_box = null;

let add_icon = null;
let delete_icon = null;

let response_element = null;

let submit_element = null;

let message_form = null;
document.addEventListener("DOMContentLoaded", function(y)
{
    console.log("Welcome to the world");
    messages = document.getElementsByClassName("message");

    csrf_val = document.getElementById("csrf_token").getAttribute("content");

    add_icon = document.getElementsByClassName("add_svg")[0]

    response_box = document.getElementById("response_box");
    response_element = document.getElementById("response_text");

    delete_icon = document.getElementsByClassName("delete_svg")[0];

    submit_element = document.getElementById("submit_response");

    message_form = document.getElementById("message_form");


    message_form.addEventListener("submit", function (y)
{
    let message_id = document.getElementById("message_id").textContent;

    y.preventDefault()
    let response_text = response_element.value;

    console.log("id" + message_id)
    console.log(response_text)
    respond(message_id.trim(), response_text).then(function(x)
{
    deleteMessage(message_id);

})


})

    for (let message of messages)
    {
        let id = message.getElementsByClassName("id")[0]

        message.getElementsByClassName("delete_svg")[0].addEventListener("click", function(y)
    {
        let id = message.getElementsByClassName("id")[0]
        deleteMessage(id.textContent);
    })

        message.getElementsByClassName("add_svg")[0].addEventListener("click",function(y)
    {
        console.log("pressd");        let id = message.getElementsByClassName("id")[0]

        toggleResponseBox(id.textContent);

    })

    }
});

function toggleResponseBox(id)
{
    document.getElementById("message_id").textContent = id;
    console.log(document.getElementById("message_id"))
    // message_id = "asdsad"
    // message_id = id;

    console.log(response_box);

    if (response_box.hasAttribute("hidden")) {

        response_box.removeAttribute("hidden"); 
        response_box.style.display = ""; // 
    } else {
        console.log("hidden");
        message_id = null;
        response_box.setAttribute("hidden", ""); 
        response_box.style.display = "none"; 
    }
    
}

async function respond(id, text)
{
    let response_url = `/message/${id}`

    let fd = new FormData();
    fd.append("response_message", text)
    await fetch(response_url,
        {
            method : "POST",
            headers: {
                "X-CSRF-TOKEN" : csrf_val
            },
            body:fd
        }
    )
}



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