

let tagElement = null;
let inp_tag_text = null;
let inp_modify_text = null;

let tags_create_url = "/tags/create"

let csrf_val = null;

document.addEventListener("DOMContentLoaded", function(x){
    tagElements = document.getElementsByClassName("tagElement")
    inp_tag_text = document.getElementById("inp_tag_text");
    create_tag = document.getElementById("create_tag");
    csrf_val = document.getElementById("csrf_token").getAttribute("content");
    inp_modify_text = document.getElementById("inp_tag_modify_text")
    create_tag.addEventListener("click", function(n)
{
    text = inp_tag_text.value
    console.log("heyyyo" + text);
    let fd = new FormData()
    fd.append("_method", "PUT")
    fd.append("Name", text);
    fetch(tags_create_url,
        {
            method: "POST",
            headers:
            {
                "X-CSRF-TOKEN" : csrf_val,
            },
            body: fd
        }
    ).then((x)=>x.json()).then(function (y)
{
    console.log("completed");
    location.reload(true);
})
})

    for(let y of tagElements)
    {
        let delete_svg = y.getElementsByClassName("delete_svg")[0];
        let modify_svg = y.getElementsByClassName("modify_svg")[0];

        let id = y.getElementsByClassName("id")[0].textContent;
        
        modify_svg.addEventListener("click", function(y)
    {
        console.log("Modification" + id);
        let fd = new FormData()
        let text = inp_modify_text.value;
        console.log(text);

        fd.append("_method", "PUT")
        fd.append("Name", text);

        let tags_modify_url = `/tags/update/${id}`
        fetch(tags_modify_url,
            {
                method: "POST",
                headers:
                {
                    "X-CSRF-TOKEN" : csrf_val,
                },
                body: fd
            }
        ).then(function(y)
    {
        location.reload(true);
    })

    })
        delete_svg.addEventListener("click", function(y)
    {
        console.log("niger delta" + id);
        let tags_delete_url = `/tags/${id}`
        fetch(tags_delete_url,
            {
                method: "DELETE",
                headers:
                {
                    "X-CSRF-TOKEN" : csrf_val,
                },
            }
        ).then(function(x)
    {
        if (x.ok)
        {
        console.log("completed");
        location.reload(true);
        }
    })

    })
    }
})


function deleteTag()
{

}


function createTag()
{

}