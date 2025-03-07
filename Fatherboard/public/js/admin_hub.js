


var revenueChart = null;


let totalRevenueProducts = "/admin/viewRevenue"

document.addEventListener("DOMContentLoaded", function()
{
    var revenueChart = document.getElementById("myChart");


    fetch(totalRevenueProducts).then(function() 
    {

    });
    new Chart(revenueChart, {
        type: 'bar',
        data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
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

})