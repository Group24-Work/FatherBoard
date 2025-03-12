


var revenueChart = null;
var csrf_token = null;

let totalRevenueProducts = "/admin/viewRevenue"

let specificRevenueProduct_url = "/admin/viewRevenue/"

let categoryRevenue_url = "/admin/viewCategoryRevenue"

let registeredUsers_url = "/admin/registeredUsers"

let registeredUsers_cumulative_url = "/admin/registeredUsers_time"

let findUser_url = "/admin/findUser"


document.addEventListener("DOMContentLoaded", function()
{
    let revenueChart = document.getElementById("revenue").getContext("2d");

    let registrationChart = document.getElementById("registration_chart").getContext("2d");

    let curDay = new Date();

    csrf_token = document.getElementsByName("csrf-token")[0]
    csrf_token_val = csrf_token.getAttribute("content")
    console.log(csrf_token_val)

    let fd = new FormData();

    console.log("HEYO");
    
    let curDate = curDay.getUTCFullYear().toString() + "-" + String((parseInt(curDay.getMonth())+1)).padStart(2,"0") + "-" + curDay.getUTCDate().toString();
    console.log(curDate);
    giveRegisteredUsers_cumulative("2025-03-06", curDate).then(function(x)
  {
    console.log(x);
    key = []
    val = []
    x.forEach(element => {
        console.log(element)
        key.push(element["created"]);
        val.push(element["cumulative_registrations"]);
    });

    createLineChart(key,val,registrationChart);
  });


    getTags(5).then(function(x)
  {
    console.log(x);
  });
    findUser("loco").then(function(x)
    {
      console.log(x);
    });
    giveCategoryRevenue("2025-03-06", "2025-03-10").then(function (x)
  {
    console.log(x);
  });

    giveRegisteredUsers("2025-03-06", null).then(function (x)
  {
    console.log("sasa")
    console.log(x);
},function(z)
{
  console.log(z);
});

    fd.append("startDate", "2025-03-06");
    fd.append("endDate", "2025-03-09");
    fd.append("productID", "-1");
    let sendData = {
      "startDate" : "2025-03-04",
      "endDate" : "2025-03-11",
      "productID" : "-1"
    }
    fetch(totalRevenueProducts, {
      method: "POST", 
      headers : {"X-CSRF-TOKEN" : csrf_token_val}, 
      body : JSON.stringify(sendData)
    }
  ).then(function(x) 
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
    
    createBar(key,val, revenueChart);


})
});

function keyVal_gen()
{

}


async function giveCategoryRevenue(startDate, endDate)
{
  let res = null;
  let fd = new FormData()
  fd.append("startDate", startDate);
  fd.append("endDate", endDate);

  await fetch(categoryRevenue_url, {
    method: "POST",
    headers: {"X-CSRF-TOKEN" : csrf_token_val},
    body: fd
}).then((x)=>x.json()).then(function (x)
{
res=x;
});

return res;

}

// Returns a list of users with a given email
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


// Returns tags from a given product id

async function getTags(id)
{
  let tags_url = `/product/tags/${id}`

  let res = null;
  await fetch(tags_url, {
    method: "POST",
    headers: {"X-CSRF-TOKEN" : csrf_token_val},
}).then((x)=>x.json()).then(function (x)
{
res=x;
});
return res;
}



// Returns total registered users

async function giveRegisteredUsers_cumulative(startDate, endDate)
{
  let res = null;
  let fd = new FormData()
  fd.append("startDate", startDate);
  fd.append("endDate", endDate);

  try
  {
  let response = await fetch(registeredUsers_cumulative_url, {
    method: "POST",
    headers: {"X-CSRF-TOKEN" : csrf_token_val},
    body: fd
}).then((x)=>x.json()).then(function (y)
{
  res = y;
});


return res;

  }
  catch (error)
  {
    console.error("Error fetching registered users:", error);
    return null;
  }

}
function giveRegisteredUsers_total()
{
  return giveRegisteredUsers(-1,-1);
}
async function giveRegisteredUsers(startDate, endDate)
{
  let res = null;
  let fd = new FormData()
  fd.append("startDate", startDate);
  fd.append("endDate", endDate);

  console.log("what?");
  try
  {
  let response = await fetch(registeredUsers_url, {
    method: "POST",
    headers: {"X-CSRF-TOKEN" : csrf_token_val},
    body: fd
}).then((x)=>x.json());

if (!response.ok)
{
  console.log("whast?");

}
return res;

  }
  catch (error)
  {
    console.error("Error fetching registered users:", error);
    return null;
  }


}


function createLineChart(labels, y_val, chart)
{
  new Chart(chart, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Revenue (£)',
        data: y_val,
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
}
function createBar(labels, y_val, chart)
{
  new Chart(chart, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Revenue (£)',
        data: y_val,
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

}


