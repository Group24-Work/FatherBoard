
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

         let background = elem.shadowRoot.querySelector(".email_item");



         let lock_svg = elem.shadowRoot.querySelector(".lock_svg");
  
         let unlock_svg = elem.shadowRoot.querySelector(".unlock_svg")

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
        if (y["Restricted"] ==0)
        {
            unlock_svg.style.display = "None"
            lock_svg.style.display = "inline"
        }
        else
        {
            background.style.background = "#fff6e0"
            unlock_svg.style.display = "inline"
            lock_svg.style.display = "None"


        }

        unlock_svg.addEventListener("click", function(x)
    {
        unlock_user(y["id"])
    })
         lock_svg.addEventListener("click", function(x)
        {
            lock_user(y["id"])
        })

         delete_svg.addEventListener("click", function(x)
        {
            delete_user(y["id"])
        })
        

         elem.addEventListener("click",function(x)
         {
            specific_user(y["Email"],y,name_text, y["Restricted"])
      });

  
         email_suggestion_container.append(elem);

         
      }
  });

 
}
function unlock_user(id)
{
    console.log("UnLock user")
    
    let fd = new FormData();

    fd.append("new_value", 0);

    let url = `/restrict/update/${id}`

    fetch(url,
        {
            method: "POST",
            headers : {
                "X-CSRF-TOKEN" : csrf_token_val
            },
            body: fd
        }
    ).then(function(x)
{
    window.location.reload(true);
})
}
function lock_user(id)
{
    console.log("Lock user")
    
    let fd = new FormData();

    fd.append("new_value", 1);

    let url = `/restrict/update/${id}`

    fetch(url,
        {
            method: "POST",
            headers : {
                "X-CSRF-TOKEN" : csrf_token_val
            },
            body: fd
        }
    ).then(function(x)
{
    window.location.reload(true);
})
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
function specific_user(email,y, name,restrict_status)
{
    let specific_email = document.getElementById("specific_email")

    let specific_name = document.getElementById("specific_name")


    let specific_id = document.getElementById("specific_id")

    let order_container = document.getElementById("order_container")

    let specific_restricted = document.getElementById("specific_restricted");

    if (restrict_status ==0)
    {
        specific_restricted.textContent = "Account not restricted";

    }
    else
    {
        specific_restricted.textContent = "Account is restricted";

    }

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