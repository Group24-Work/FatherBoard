
let product_rows = null;

let product_region = null;


let tag_url = "/tags";

let add_tag_url = `/product/add_tags/{id}`;

let csrf_val = null;

let tag_options = null;

async function getTags()
{
    let tagArray = null;
    await fetch(tag_url, {
        method : "POST",
        headers : {
            "X-CSRF-TOKEN" : csrf_val
        }
    }).then((x)=>x.json()).then(function (x)
{
    console.log(x)
    tagArray = x;
})
    
return tagArray;

}

function addTag(prod_id, tag_id)
{
    let add_tag_url = `/product/add_tags/${prod_id}`;

    console.log(prod_id)
    console.log(tag_id)
    let fd = new FormData()
    fd.append("tag_id", tag_id)
    fetch(add_tag_url,
        {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN" : csrf_val
            },
            body: fd
            
        }
    ).then(function (x)
    {
        window.location.reload();
    })
}

document.addEventListener("DOMContentLoaded", function(y)
{
    product_rows = document.querySelectorAll(".product_row")

    product_region = document.getElementById("product_specific_container")

    csrf_val = document.getElementsByName("csrf-token")[0].getAttribute("content");

    tag_options = document.getElementById("tag_options");

    add_tag = document.getElementById("add_tag");

    let title = product_region.querySelector("#product_title")
    let s_tag = product_region.querySelector("#product_tags")
    let prod_id = product_region.querySelector("#product_id")

    add_tag.addEventListener("click", function(y)
{
    addTag(prod_id.textContent, tag_options.value)
})
    let tagArr = getTags().then(function (x)
{
    console.log(x);
    for (elem of x)
        {
            option_elem = document.createElement("option")
            option_elem.textContent = elem["Name"];
            option_elem.value = elem["id"];
            tag_options.append(option_elem);
        
        }});
    console.log(tagArr)



    for (let elem of product_rows)
    {
        elem.addEventListener("click", function(y)
    {   
        console.log(y)
        console.log(product_region)



        s_tag.innerHTML = "";

        let prod_title = elem.querySelector("[Name='product_title']")
        let id = elem.querySelector(".product_id");

        let tags = elem.querySelector("[Name='product_tags']")
        let all_tags = tags.querySelectorAll("span")


        prod_id.textContent = id.textContent;
        for (let tag of all_tags)
        {
            let tagElem = document.createElement("p")
            tagElem.textContent = tag.textContent
            s_tag.append(tagElem)
        }
        console.log(title)

        title.textContent = prod_title.textContent
        console.log("Sunny Death");

    })

    }
})