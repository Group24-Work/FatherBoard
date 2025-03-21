
let findUser_url = "/admin/findUser"

var csrf_token = null;

let csrf_token_val = null;

let single_order_element = null;

let specific_region = null;


document.addEventListener("DOMContentLoaded", function(x)
{
    console.log("Admin Account Page");
    let search_button = document.getElementById("user_search_button");


    csrf_token = document.getElementsByName("csrf-token")[0]
    csrf_token_val = csrf_token.getAttribute("content")

    single_order_element = document.getElementsByClassName("single_order")[0]

    specific_region = document.getElementById("specific_user");

    search_button.addEventListener("click",emailClick)

    // let delete_account_button = document.getElementById("delete_account")


//     delete_account_button.addEventListener("click", function (x)
//     {
//         let specific_id = document.getElementById("specific_id")

//         delete_user(specific_id.textContent)
// })

    
})



class EmailItem extends HTMLElement
{
  constructor()
  {
    super();

    this.attachShadow({mode : "open"});

    let element = document.getElementById("email_suggestion_item_template");

    this.shadowRoot.append(element.content.cloneNode(true));
  }

}
customElements.define("email-suggestion-item",
EmailItem
)

async function findUser(email)
{
  let res = null;
  let fd = new FormData()
  fd.append("email", email);

    await fetch(findUser_url, {
    method: "POST",
    headers: {"X-CSRF-TOKEN" : csrf_token_val},
    body: fd
}).then((x)=>x.json()).then(function (x)
{
res=x;
});

return res;

}


function emailClick()
{
  let email_suggestion_container = document.getElementById("emailSuggestion_container");

  console.log("searching for emails");

  let email_val = document.getElementById("email").value;

  email_suggestion_container.innerHTML = "";
  findUser(email_val).then(function(x)
  {
    if (x.length == 0)
    {
        email_suggestion_container.innerHTML = "<h3>No matching users</h3>"
        return;
    }
    for (let y of x)
      {
         let elem = document.createElement("email-suggestion-item");
         let delete_svg = elem.shadowRoot.querySelector(".delete_svg")
  
         let name_text = y["First Name"] + " " + y["Last Name"];

         let id = document.createElement("p");
         id.setAttribute("slot", "ID");
         id.textContent = y["id"];
         
         let name = document.createElement("p");
         name.setAttribute("slot", "Name");
         name.textContent = name_text;
  
  
         let email = document.createElement("p");
         email.setAttribute("slot", "Email");
         email.textContent = y["Email"];
  
  
         elem.appendChild(name);
         elem.appendChild(email);
         elem.appendChild(id)

         delete_svg.addEventListener("click", function(x)
        {
            delete_user(y["id"])
        })
        

         elem.addEventListener("click",function(x)
         {
            specific_user(y["Email"],y,name_text)
      });

  
         email_suggestion_container.append(elem);

         
      }
  });

 
}
function delete_user(id)
{
    let url = `/account/destroy/${id}`

    fetch(url, {
        method: "POST",
        headers : {
            "X-CSRF-TOKEN" : csrf_token_val
        }
}).then((x)=>x.json()).then(function (y)
    {
    window.location.reload(true);
    });


}
function specific_user(email,y, name)
{
    let specific_email = document.getElementById("specific_email")

    let specific_name = document.getElementById("specific_name")


    let specific_id = document.getElementById("specific_id")

    let order_container = document.getElementById("order_container")


    specific_id.textContent = y["id"];

    specific_email.textContent = email

    specific_name.textContent = name;


    console.log(single_order_element)
    let clone = single_order_element.cloneNode(true)

    clone.removeAttribute("hidden")
    order_container.innerHTML = "";

    order_container.append(clone)


    suggestion_item_click(y["id"], clone)


}
function suggestion_item_click(id, onto)
{
    let orders_url = `/account/getOrders/${id}`

    console.log(id);


    fetch(orders_url, {
        method: "POST",
        headers : {
            "X-CSRF-TOKEN" : csrf_token_val
        }
    }).then((x)=>x.json()).then(function (y)
{
    console.log(y)
    y.forEach(element => {
        let order_item = document.createElement("div")
        order_item.classList.add("order_item")
        let price = document.createElement("p")
        price.textContent = "Total Price : £" + element["price"];

        order_items = element["elements"];

        let item_identifier = document.createElement("p")
        item_identifier.textContent = "Items : "

        order_item.appendChild(item_identifier)

        order_items.forEach(items=>
        {
            let item = document.createElement("p")
            item.textContent = items

            order_item.appendChild(item);
        }
        )

        order_item.appendChild(price)

        onto.appendChild(order_item)
    });
})
}