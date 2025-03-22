

let address_button = null;
let personal_button = null;
let billing_button = null;
let history_button = null
let show_add_address_button  = null;
let add_address_submit =null;

let admin_index_button = null;

let update_personal_form = null;

let logout_button = null;

let update_personal_buttons = null

let update_personal_submit = null;

let message_button = null;

let currentBar = null;

let option_information = null;

let personal_element_first = null;
let address_container = null;


let csrf =null;
let csrf_val =null;


window.addEventListener('hashchange', function() {


    const hash = window.location.hash;

    let part = hash.replace("#!","")


    if (part=="" || part=="personal")
        {
            personalClicked()
        }
        else if (part == "address")
            {
                addressClicked()
            }
            else if (part == "history")
            {
                historyClicked()
            }
            else if (part=="billing")
            {
                billingClicked()
            }
            else
            {
                personalClicked()
            }
            
});

window.addEventListener("DOMContentLoaded",()=>
{
    address_button = document.getElementById("button_address");
    billing_button = document.getElementById("button_billing");
    personal_button = document.getElementById("button_personal");
    history_button = document.getElementById("button_history");
    show_add_address_button = document.getElementById("button_show_address_gui");
    update_personal_buttons = document.getElementsByClassName("update_personal_button");
    update_personal_submit = document.getElementById("update_personal_submit");
    option_information = document.getElementById("option-information");
    address_container = document.getElementById("address_container");
    personal_element_first = document.getElementById("personal_element_first");

    admin_index_button = document.getElementById("admin_index_button");

    currentBar = document.getElementById("currentBar");

    message_button= document.getElementById("message_button");


    logout_button = document.getElementById("logout_button");


    csrf = document.getElementsByName("csrf-token")[0];
    csrf_val =  csrf.getAttribute("content");

    let hash = window.location.hash; // Get the full hash (e.g., "#!/divA")

    let part = hash.replace("#!","")

    if (part=="" || part=="personal")
    {
        personalClicked()
    }
    else if (part == "address")
        {
            addressClicked()
        }
        else if (part == "history")
        {
            historyClicked()
        }
        else if (part=="billing")
        {
            billingClicked()
        }
        else
        {
            personalClicked()
        }
        




    if (message_button)
    {
        message_button.addEventListener("click", showMessages);
    }
    if (admin_index_button)
    {
        admin_index_button.addEventListener("click",()=>window.location.href = "/admin");
    }
    logout_button.addEventListener("click",logOut);
    update_personal_submit.addEventListener("click", updateSubmit);
    address_button.addEventListener("click", addressClicked);
    billing_button.addEventListener("click",billingClicked);
    history_button.addEventListener("click", historyClicked);
    personal_button.addEventListener("click",personalClicked)


    // Adding functionality at startup

    for (let el of update_personal_buttons)
    {
        el.addEventListener("click",showPersonalForm);
    }

    show_add_address_button.addEventListener("click", toggleAddAddress);

    document.getElementById("button_show_address_gui");;

    let addrElements = document.querySelectorAll("address-element")
    for (let elem of addrElements)
    {
        console.log(elem.shadowRoot);
        let button = elem.shadowRoot.querySelector("[name=remove-item]")
        button.addEventListener("click",removeAddress);
    }

    add_address_form.addEventListener("click",(e)=>
    {
    e.preventDefault();
    })

    // let personal_within = document.getElementById("personal_element_within")
    // personal_addCapability(personal_within);
});

function showMessages()
{
    console.log("showing Messages");
    let message_box = document.getElementById('message-info').cloneNode(true);
    let option_information = document.getElementById("option-information");

    message_box.removeAttribute("hidden")
    option_information.innerHTML = "";


    
    option_information.appendChild(message_box)

}


function moveCurrentBar(part)
{

    topUnit = part * "3"
    currentBar.style.top = topUnit+"rem";


}
function logOut()
{
    window.location.replace("/logout");
}
function showPersonalForm()
{
    console.log("showing personal form");
}


class AddressElement extends HTMLElement
{
    constructor()
    {
        super();
        this.attachShadow({mode:"open"});

        let addressTemplate = document.getElementById("address-template");

        let content = addressTemplate.content;
        console.log(content);
        this.shadowRoot.append(content.cloneNode(true));
    }
}


class PersonalElement extends HTMLElement
{
    constructor()
    {
        super();
        this.attachShadow({mode:"open"});

        let personalTemplate = document.getElementById("personal-template");

        this.shadowRoot.append(personalTemplate.content.cloneNode(true));
    }
}

customElements.define(
    "personal-element",
    PersonalElement
)



customElements.define(
    "address-element",
    AddressElement
)

function addressClicked()
{
    console.log("Address clicked");

    const nextURL = '/settings#!address';
    const nextTitle = 'Address';
    const nextState = { additionalInformation: 'Moved to address' };

    window.history.pushState(nextState, nextTitle, nextURL);



    moveCurrentBar(1);
    let csrf_val = csrf.getAttribute("content");
    showAddress_cache();
//     fetch("./get/address", {method: "POST", headers : {"X-CSRF-TOKEN": csrf_val}}).then((x)=>x.json()).then((y)=>
//         {
//             console.log(y);
//             showAddress(y)
// });

}

function billingClicked()
{
    moveCurrentBar(2);

    const nextURL = '/settings#!billing';
    const nextTitle = 'Address';
    const nextState = { additionalInformation: 'Moved to billing' };

    window.history.pushState(nextState, nextTitle, nextURL);

    console.log("Billing clicked");

}
function historyClicked()
{

    moveCurrentBar(3);

    const nextURL = '/settings#!history';
    const nextTitle = 'History';
    const nextState = { additionalInformation: 'History' };

    window.history.pushState(nextState, nextTitle, nextURL);

    console.log("History clicked");
    let order_hist = document.getElementById("order-info").cloneNode(true);
    order_hist.removeAttribute("hidden");
    let option_information = document.getElementById("option-information");

    option_information.innerHTML = "";
    option_information.append(order_hist)


}
function personalClicked()
{
    moveCurrentBar(0);

    const nextURL = '/settings#!personal';
    const nextTitle = 'Address';
    const nextState = { additionalInformation: 'Moved to personal' };

    window.history.pushState(nextState, nextTitle, nextURL);
    console.log("Personal clicked");


    let info = null;
    showPersonal_cache();
    // fetch("./get/personal", {method: "POST", headers : {"X-CSRF-TOKEN": csrf_val}}).then((x)=>x.json()).then(
    //     (y)=>{
    //         console.log(y);
    //         showPersonal(y);
    //     }
    // );
}


function showAddress_cache()
{
    let clone = address_container.cloneNode(true);
    clone.removeAttribute("hidden");
    option_information.innerHTML = `<h3>Address Information</h3>`;

    const addButton = document.createElement("button");
    addButton.id = "button_show_address_gui";
    addButton.textContent = "Add Address";
    option_information.appendChild(addButton);

    option_information.append(clone);


    show_add_address_button = option_information.querySelector("#button_show_address_gui");

    show_add_address_button.addEventListener("click",toggleAddAddress);


    console.log("gj");

    addFunctionality_address(clone.querySelectorAll("address-element"));

    // for (let elem of clone)
    // {

    // }
}

function addFunctionality_address(address_elems)
{
    // let remove_button = elems.shadowRoot.querySelectorAll("[name=remove-item]");
    console.log(address_elems);
    for (let el of address_elems)
    {
        let remove_button = el.shadowRoot.querySelector("[name=remove-item]");

        remove_button.addEventListener("click",removeAddress);
    }
}

function showAddress(info)
{
    let option_information = document.getElementById("option-information");

    option_information.innerHTML = `<h3>Address Information</h3>
     <button id='button_show_address_gui'>Add Address</button>`;



    if (info.length != 0)
    {

    for (let elem of info)
    {
    let address_element = document.createElement("address-element");

    let country_text = document.createElement("span")
    country_text.setAttribute("slot","Country");
    country_text.textContent = elem["Country"];

    let city_text = document.createElement("span")
    city_text.setAttribute("slot","City");
    city_text.textContent = elem["City"];

    let address_text = document.createElement("span")
    address_text.setAttribute("slot","AddressLine");
    address_text.textContent = elem["Address Line"];

    let id_text = document.createElement("p");
    id_text.setAttribute("hidden", "");
    id_text.setAttribute("value", elem["id"]);
    id_text.setAttribute("name","address_id");


    let postCode_text = document.createElement("span")
    postCode_text.setAttribute("slot","PostCode");
    postCode_text.textContent = elem["PostCode"];

    console.log(elem["Post Code"]);


    address_element.appendChild(country_text);
    address_element.appendChild(city_text);
    address_element.appendChild(address_text);
    address_element.appendChild(id_text);
    address_element.appendChild(postCode_text);
    
    option_information.append(address_element);
    show_add_address_button = document.getElementById("button_show_address_gui");
    show_add_address_button.addEventListener("click",toggleAddAddress);

    console.log(address_element.shadowRoot);
    
    let remove_button = address_element.shadowRoot.querySelector("[name=remove-item]");
    
    remove_button.addEventListener("click",removeAddress);
    }
}
    else
    {




        let info_elem = document.createElement("p");
        info_elem.textContent = "You do not have an address currently.";

        option_information.append(info_elem);
        option_information.querySelector("#button_show_address_gui").addEventListener("click",toggleAddAddress);

    }
}

function updateCache_address(data)
{
    let container = address_container;
    container.innerHTML = "";

    for (let elem of data)
    {
        let address_element = document.createElement("address-element");
    let country_text = document.createElement("span")
    country_text.setAttribute("slot","Country");
    country_text.textContent = elem["Country"];

    let city_text = document.createElement("span")
    city_text.setAttribute("slot","City");
    city_text.textContent = elem["City"];

    let address_text = document.createElement("span")
    address_text.setAttribute("slot","AddressLine");
    address_text.textContent = elem["Address Line"];

    let id_text = document.createElement("p");
    id_text.setAttribute("hidden", "");
    id_text.setAttribute("value", elem["id"]);
    id_text.setAttribute("name","address_id");


    let postCode_text = document.createElement("span")
    postCode_text.setAttribute("slot","PostCode");
    postCode_text.textContent = elem["PostCode"];

    console.log(elem["Post Code"]);


    address_element.appendChild(country_text);
    address_element.appendChild(city_text);
    address_element.appendChild(address_text);
    address_element.appendChild(id_text);
    address_element.appendChild(postCode_text);

    

    container.append(address_element);

    }
    show_add_address_button = document.getElementById("button_show_address_gui");
    show_add_address_button.addEventListener("click",toggleAddAddress);
}


// Performs a fetch operation then updates cache based on this result
function f_updateCacheAddress()
{
    fetch("./get/address", {method: "POST", headers : {"X-CSRF-TOKEN": csrf_val}}).then((x)=>x.json()).then((y)=>
        {
            console.log(y);
            showAddress(y)
            updateCache_address(y);
});
}


// AJAX acquire personal information
function showPersonal_cache()
{
    let elem = document.getElementById("personal_element_first");

    console.log("here")
    console.log(elem)
    let elemCopy = elem.cloneNode(true);
    elemCopy.removeAttribute("hidden");
    option_information.innerHTML = "";
    option_information.append(elemCopy);


    // Makes the button be interactable 
    addFunctionality_personal(elemCopy);
}


function showPersonal(info)
{

    let personal_element = document.createElement("personal-element");

    let email_text = document.createElement("span");
    email_text.setAttribute("slot","Email");
    email_text.textContent = info["Email"];


    let password_text = document.createElement("span");
    password_text.setAttribute("slot","Password");
    password_text.textContent = info["Password"];

    let firstname_text = document.createElement("span");
    firstname_text.setAttribute("slot","FirstName");
    firstname_text.textContent = info["First Name"];


    let lastname_text = document.createElement("span");
    lastname_text.setAttribute("slot","LastName");
    lastname_text.textContent = info["Last Name"];

    personal_element.append(email_text)
    personal_element.append(password_text);
    personal_element.append(firstname_text);
    personal_element.append(lastname_text);

    let option_information = document.getElementById("option-information");


    console.log(personal_element.shadowRoot); // Ensure it is not null

   
        
    option_information.innerHTML = "";
    option_information.appendChild(personal_element);

    personal_addCapability(personal_element);

};
function personal_addCapability(personal_element)
{
    requestAnimationFrame(() => {  
        update_personal_buttons = personal_element.shadowRoot.querySelectorAll(".update_personal_button");
        console.log(update_personal_buttons);
        for (let el of update_personal_buttons)
        {
            console.log("s")
            el.addEventListener("click",toggleShowPersonal);
        }
    });
}
function updateCache_personal(info)
{

  
    let personal_element = document.getElementById("personal_element_first")

    personal_element.innerHTML = "";

    let email_text = document.createElement("span");
    email_text.setAttribute("slot","Email");
    email_text.textContent = info["Email"];


    let password_text = document.createElement("span");
    password_text.setAttribute("slot","Password");
    password_text.textContent = info["Password"];

    let firstname_text = document.createElement("span");
    firstname_text.setAttribute("slot","FirstName");
    firstname_text.textContent = info["First Name"];


    let lastname_text = document.createElement("span");
    lastname_text.setAttribute("slot","LastName");
    lastname_text.textContent = info["Last Name"];

    personal_element.append(email_text)
    personal_element.append(password_text);
    personal_element.append(firstname_text);
    personal_element.append(lastname_text);

    let option_information = document.getElementById("option-information");


    console.log(personal_element.shadowRoot); // Ensure it is not null

   
        
    option_information.innerHTML = "";
    clone = personal_element.cloneNode(true)
    clone.removeAttribute("hidden");
    option_information.appendChild(clone);

    requestAnimationFrame(() => {  
        update_personal_buttons = personal_element.shadowRoot.querySelectorAll(".update_personal_button");
        console.log(update_personal_buttons);
        for (let el of update_personal_buttons)
        {
            console.log("s")
            el.addEventListener("click",toggleShowPersonal);
        }
    });

}


function f_updateCachePersonal()
{
    fetch("./get/personal", {method: "POST", headers : {"X-CSRF-TOKEN": csrf_val}}).then((x)=>x.json()).then(
        (y)=>{
            console.log(y);
            updateCache_personal(y)

        }
    )
}

function addFunctionality_personal(elem)
{
    update_personal_buttons = elem.shadowRoot.querySelectorAll(".update_personal_button");
        console.log(update_personal_buttons);
        for (let el of update_personal_buttons)
        {
            console.log("s")
            el.addEventListener("click",toggleShowPersonal);
        }
}

function updateSubmit(ev)
{
    ev.preventDefault()
    console.log("Submitting update")
    let personal_text = document.getElementById("personal_text");
    let version = document.getElementsByName("type")[0];

    console.log(personal_text)
    let fd = new FormData()
    fd.append("personal_text", personal_text.value);
    fd.append("version", version.content);

    fetch('/update/personal',
        {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN" : csrf_val
            },
            body: fd
        }
    ).then((res)=>res.json()).then((js)=>
    {
        console.log(js)
        f_updateCachePersonal();
        toggleAddPersonalUI()        
    }).catch((err)=>{
        console.log(err)
    })
}

function toggleAddPersonalUI()
{
    let form = document.getElementById("update_personal_form");


    if (form.style.display === "") {
        form.style.display = "none";
    }

    if (form.style.display == "none") {
        form.style.display = "flex";
    } else {
        form.style.display = "none";
    }
}
function toggleShowPersonal(ev) {
    let type_meta = document.getElementsByName("type")[0];
    let version = ev.target.getAttribute("version");

    type_meta.setAttribute("content", version);
    toggleAddPersonalUI()
}

function toggleAddAddress()
{
    let address_box = document.getElementById("add_address_box")
    console.log("y");

    


    if (address_box.hasAttribute("hidden"))
    {
        address_box.removeAttribute("hidden");

    }
    else
    {
        address_box.setAttribute("hidden", "");
    }
    address_submit = document.getElementById("add_address_submit");

    address_submit.addEventListener("click",addAddress);

}

function removeAddress(ev)
{
    console.log("susan");
    console.log(ev.target.getRootNode().host.querySelector("[name=address_id]").getAttribute("value"));

    addr_value = ev.target.getRootNode().host.querySelector("[name=address_id]").getAttribute("value")
    fetch("/delete/address",
        {
            method: "POST",
            headers : {
                "Content-Type" : "application/json",
                "X-CSRF-TOKEN" : csrf_val
            },
            body : JSON.stringify({"address_id" : addr_value})
        }
    ).then((x)=>
        {if (!x.ok)
        {
            throw new Error("issue bos")
        }
           
        f_updateCacheAddress()
    }
    ).catch(x=>{
        throw new Error("darn it")
});

} 

// function addAddress()
// {
//     let country = document.getElementById("inp_country");
//     let city = document.getElementById("inp_city");
//     let addrline = document.getElementById("inp_addrLine");

//     fetch("/add/address", {method:"POST", headers: {"X-CSRF-TOKEN" : csrf_val}, body : JSON.stringify({country : country, city: city, addressLine:addrline})}).then((x)=>x.json()).then(
//         (js)=>{
//             console.log(js)
//         }
//     );
// }

function addAddress() {
    let country = document.getElementById("inp_country").value;
    let city = document.getElementById("inp_city").value;
    let addrline = document.getElementById("inp_addrLine").value;

    let postCode = document.getElementById("inp_postCode")?.value ? document.getElementById("inp_postCode").value : "None"

    console.log(postCode);
    
    console.log("yippe")

    let form_data = new FormData();

    form_data.append("Country", country);
    form_data.append("City", city);
    form_data.append("AddressLine", addrline);
    form_data.append("PostCode", postCode);

    console.log(form_data);

    fetch("/add/address", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrf_val
        },
        // body: JSON.stringify({ country: country, city: city, addressLine: addrline })
        body: form_data
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        toggleAddAddress();
        
        return response.json();
    })
    .then(js => {
        console.log(js);
        f_updateCacheAddress();
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}