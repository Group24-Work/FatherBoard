
let product_rows = null;

let product_region = null;


let tag_url = "/tags";

let add_tag_url = `/product/add_tags/{id}`;

let csrf_val = null;

let tag_options = null;

let tag_assoc = null;

let product_stock_area = null;

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


function removeTag(prod_id, tag_id)
{
    let remove_tag_url = `/product/remove_tag/${prod_id}`;

    console.log(tag_id)
    let fd = new FormData()
    fd.append("tag_id", tag_id)
    fetch(remove_tag_url,
        {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN" : csrf_val
            },
            body: fd
            
        }
    ).then(function (x)
    {
        // window.location.reload();
    })

}

function createTagAssociation(val)
{
    let res ={};
    val.forEach(function(y) {
        res[y["Name"]] = y["id"];
    });
return res;
}

function updateStockOnServer(newStock) {
    let productId = document.getElementById("product_id").textContent;  // Example, you should have product ID attribute
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (productId!=null)
    {
    let fd= new FormData()
    fd.append("new_stock", newStock)
    fetch(`/product/update-stock/${productId}`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrf_val,
        },
        body: fd
    }).then(response => {
        if (response.ok) {
            console.log("Stock updated successfully!");
        } else {
            console.log("Failed to update stock.");
        }
    }).catch(error => {
        console.error("Error:", error);
    });
}
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

    product_stock_area = document.getElementById("product_stock_area")



    product_stock_area.addEventListener("click", function(x)
    {
        console.log("Click")
        let currentStock = product_stock_area.textContent;

        // Create an input field with the current value
        let input = document.createElement("input");
        input.type = "number";
        input.value = currentStock;
        input.style.width = "60px";

        // Replace the content of the div with the input field
        product_stock_area.innerHTML = "";
        product_stock_area.appendChild(input);

        // Focus on the input field
        input.focus();

        input.addEventListener("blur", function() {
            // Get the updated value
            let newStock = input.value;

            // Update the stock display with the new value
            product_stock_area.textContent = newStock;

            // Optionally, you can save the updated stock value to the server
            updateStockOnServer(newStock);
        });

        input.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                input.blur();  // Trigger blur to save value
            }
        });
    })


   

    getTags().then(function(y)
{
    tag_assoc = createTagAssociation(y);
    console.log(tag_assoc)

})

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
            let indiv_tag_container = document.createElement("div")
            indiv_tag_container.classList.add("individual_tag")
            let tagElem = document.createElement("span")
            tagElem.textContent = tag.textContent

            let removeElem = document.createElement("span")
            removeElem.textContent = "+"
            removeElem.addEventListener("click",function(x)
            {
                console.log(tag_assoc)
                console.log(Object.keys(tag_assoc))
                console.log(tag_assoc["Yellow"])
                console.log(tag.textContent.tri)
                console.log(tag_assoc[tag.textContent.trim()])

                removeTag(id.textContent,tag_assoc[tag.textContent.trim()])
        })
            indiv_tag_container.append(tagElem)
            indiv_tag_container.append(removeElem)

            s_tag.append(indiv_tag_container)
        }
        console.log(title)

        title.textContent = prod_title.textContent
        console.log("Sunny Death");

    })

    }
})