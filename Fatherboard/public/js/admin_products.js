
let product_rows = null;

let product_region = null;

document.addEventListener("DOMContentLoaded", function(y)
{
    product_rows = document.querySelectorAll(".product_row")

    product_region = document.getElementById("product_specific_container")

    for (let elem of product_rows)
    {
        elem.addEventListener("click", function(y)
    {   
        console.log(y)
        console.log(product_region)

        let title = product_region.querySelector("#product_title")
        let s_tag = product_region.querySelector("#product_tags")
        s_tag.innerHTML = "";

        let prod_title = elem.querySelector("[Name='product_title']")

        let tags = elem.querySelector("[Name='product_tags']")
        let all_tags = tags.querySelectorAll("span")

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