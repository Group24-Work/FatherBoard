
let findUser_url = "/admin/findUser"

var csrf_token = null;

document.addEventListener("DOMContentLoaded", function(x)
{
    console.log("Admin Account Page");
    let search_button = document.getElementById("user_search_button");


    csrf_token = document.getElementsByName("csrf-token")[0]
    csrf_token_val = csrf_token.getAttribute("content")

    search_button.addEventListener("click",emailClick)

    
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

    for (let y of x)
      {
         let elem = document.createElement("email-suggestion-item");
         
  
         let id = document.createElement("p");
         id.setAttribute("slot", "ID");
         id.textContent = y["id"];
         
         let name = document.createElement("p");
         name.setAttribute("slot", "Name");
         name.textContent = y["First Name"] + " " + y["Last Name"];
  
  
         let email = document.createElement("p");
         email.setAttribute("slot", "Email");
         email.textContent = y["Email"];
  
  
         elem.appendChild(name);
         elem.appendChild(email);
         elem.appendChild(id)

  
         email_suggestion_container.append(elem);
      }
  });

 
}