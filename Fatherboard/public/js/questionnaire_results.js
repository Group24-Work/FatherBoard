
class ProductElement extends HTMLElement
{
    constructor()
    {
        super();
        this.attachShadow({mode : "open"});
        let template_product  = document.getElementById("template_product");

        this.shadowRoot.append(template_product.content.cloneNode(true));

    }
}

customElements.define(
    "product-element",
    ProductElement
)


document.addEventListener("DOMContentLoaded", function(x)
{
    console.log("LoadedLove")
    let canvas = document.getElementById("confetti");

    setTimeout(function()
{
    const confettilib = new JSConfetti();
    let audio = new Audio("../audio/children_celebration.mp3")
    audio.play()
    confettilib.addConfetti();
},250)
})