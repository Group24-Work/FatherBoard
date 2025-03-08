


var revenueChart = null;
var csrf_token = null;

let totalRevenueProducts = "/admin/viewRevenue"

let specificRevenueProduct_url = "/admin/viewRevenue/"

document.addEventListener("DOMContentLoaded", function()
{
    var revenueChart = document.getElementById("myChart");

    csrf_token = document.getElementsByName("csrf-token")[0]
    csrf_token_val = csrf_token.getAttribute("content")
    console.log(csrf_token_val)

    let fd = new FormData();

    fd.append("sand", "doesi");
    fetch(totalRevenueProducts, {method: "POST", headers : {"X-CSRF-TOKEN" : csrf_token_val}}).then(function(x) 
    {
      return x.json();
    }).then(function (l)
  {
    console.log(l);

    key = []
    val = []
    l.forEach(element => {
        console.log(element)
        key.push(element["date"]);
        val.push(element["total_sales"]);
    });
    console.log(key);
    console.log(val);
    new Chart(revenueChart, {
      type: 'bar',
      data: {
        labels: key,
        datasets: [{
          label: '# of Votes',
          data: val,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });

  fetch(specificRevenueProduct_url + "2", {method: "POST", headers : {"X-CSRF-TOKEN" : csrf_token_val}}).then()


})