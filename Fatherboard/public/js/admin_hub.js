


var revenueChart = null;
var csrf_token = null;

let revenueChart_chart = null;


let totalRevenueProducts = "/admin/viewRevenue"

let specificRevenueProduct_url = "/admin/viewRevenue/"

let categoryRevenue_url = "/admin/viewCategoryRevenue"

let registeredUsers_url = "/admin/registeredUsers"

let registeredUsers_cumulative_url = "/admin/registeredUsers_time"

let findUser_url = "/admin/findUser"

let tag_all_url = "/tags"

let product_type_url = "/product/all-type"

let totalRevenueData = null;

let all_categories = null;

let revenueType_Chart = null;

let revenueTypeChart_chart = null;


// Returns current time in a format acceptable to how the database stores its time ( YYYY-MM-DD )
function currentTime()
{
  let curDay = new Date();
  return curDay;
}

function timeFormat(date)
{
  return date.getUTCFullYear().toString() + "-" + String((parseInt(date.getMonth())+1)).padStart(2,"0") + "-" + date.getUTCDate().toString();
}

async function getCategories()
{
  let all_types = null;
  await fetch(product_type_url,
    {
      method: "POST",
      headers : {
        "X-CSRF-TOKEN" : csrf_token_val
      },
    }
  ).then((x)=>x.json()).then(function (y)
{
  all_types = y;
})
return all_types; // Return the categories
}
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

document.addEventListener("DOMContentLoaded", async function()
{
    revenueChart = document.getElementById("revenue").getContext("2d");

    let registrationChart = document.getElementById("registration_chart").getContext("2d");

    revenueType_Chart = document.getElementById("revenueType_chart").getContext("2d");


    let search_button = document.getElementById("user_search_button");

    let revenueSection = document.getElementById("revenue_section");

    let btn_revenue_week = revenueSection.getElementsByClassName("week")[0];
    let btn_revenue_month = revenueSection.getElementsByClassName("month")[0];

    let revenueTypeSection = document.getElementById("revenueType_section");

    let btn_revenueType_week = revenueTypeSection.getElementsByClassName("week")[0];
    let btn_revenueType_month = revenueTypeSection.getElementsByClassName("month")[0];


    let curDate = timeFormat(currentTime())

    
    // Get CSRF token value
    csrf_token = document.getElementsByName("csrf-token")[0]
    csrf_token_val = csrf_token.getAttribute("content")

      btn_revenueType_week.addEventListener("click", function(x)
    {
      let curTime = new Date();
      curTime.setDate(curTime.getDate()-7);
      revenueType_change(timeFormat(curTime), timeFormat(currentTime()))
    })
    btn_revenueType_month.addEventListener("click", function(x)
    {
      let curTime = new Date();
      curTime.setDate();
      revenueType_change("", timeFormat(currentTime()))    })


      btn_revenue_week.addEventListener("click", function(x)
    {
      revenueSectionChange(1);
    })

    btn_revenue_month.addEventListener("click", function(x)
    {
      revenueSectionChange(2);
    })



    // User search
    search_button.addEventListener("click",emailClick);



    let fd = new FormData();

    console.log("HEYO");
    
    showTags();

    


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
    
    giveCategoryRevenue("2025-03-06", curDate).then(function (x)
  {

    giveChart_CategoryRevenue(x,revenueType_Chart).then(
      function(x)
      {
        console.log("hello")

        revenueTypeChart_chart = x;
        console.log(x)
      }
    )

    
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
      "endDate" : curDate,
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
    totalRevenueData = l;
    console.log("total rev data")
    console.log(l.slice(-7))
    
    response = keyVal_gen(l)

    revenueChart_chart = createBar(response[0],response[1], revenueChart);


})
});

function keyVal_gen(data)
{
  key = []
  val = []
  data.forEach(element => {
      console.log(element)
      key.push(element["date"]);
      val.push(element["total_sales"]);
  });
  return [key,val];
}


function revenueType_change(start_date,end_date)
{
  // const revenueType_chart = document.getElementById("revenueType_chart").getContext("2d");
  console.log(revenueTypeChart_chart)
  revenueTypeChart_chart.data.datasets[0].data = []
  revenueTypeChart_chart.update()

  giveCategoryRevenue(start_date, end_date).then(
    function(x)
    {
      dict = {}
     
      getCategories().then(function(all_cat) {

        Object.values(all_cat).forEach(category => {
          dict[category] = 0; 
        });
    
        dict["CPU"] = 350;
        x.forEach(element => {
          console.log("Processing element:", element);
    
          const categories = element["categories"];
          
          Object.keys(categories).forEach(category => {
            if (dict.hasOwnProperty(category)) {
              dict[category] += categories[category];  // Accumulate price for the category
            }
          });
        });
    
    
        // Transform dict object into keys and values for chart creation
      
        console.log("lookatmenow")
        console.log(dict);
        console.log(revenueChart_chart);
          revenueTypeChart_chart.data.labels = Object.keys(dict);
          revenueTypeChart_chart.data.datasets[0].data = Object.values(dict);

          console.log(revenueChart_chart.data)

        revenueTypeChart_chart.update()
 
    });

    }
  )
}


function revenueSectionChange(id)
{
  console.log(id);
  let prevDate = new Date(currentTime());
  prevDate.setDate(currentTime().getDate()-7);

  if (totalRevenueData)
  {
    data = null;
    console.log("Within cache");

    // Give previous week data
    if (id==1)
    {
      data = totalRevenueData.slice(-7)
    }
    // Give all data
    else
    {
        data = totalRevenueData
    }
    console.log(data);
    response = keyVal_gen(data)
    revenueChart_chart.data.labels = response[0];
    revenueChart_chart.data.datasets[0].data = response[1];
  
    console.log("updating");
    revenueChart_chart.update();
  }
  else
  {
  let sendData = {
    "startDate" : timeFormat(prevDate),
    "endDate" : timeFormat(currentTime()),
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

  response = keyVal_gen(l)

  revenueChart_chart.data.labels = response[0];
  revenueChart_chart.data.datasets[0].data = response[1];

  revenueChart_chart.update();
})
  };

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


  function giveChart_CategoryRevenue(x, chart) {
    return new Promise((res,rej)=>
    {
    let dict = {};  // Dictionary to store category as key and price as value
  
    // Fetch categories and then process the data
    getCategories().then(function(all_cat) {

      Object.values(all_cat).forEach(category => {
        dict[category] = 0; 
      });
  
      x.forEach(element => {
        console.log("Processing element:", element);
  
        const categories = element["categories"];
        
        Object.keys(categories).forEach(category => {
          if (dict.hasOwnProperty(category)) {
            dict[category] += categories[category];  // Accumulate price for the category
          }
        });
      });
  
  
      // Transform dict object into keys and values for chart creation
    
        chart = pieChart(Object.keys(dict), Object.values(dict), chart);
        revenueTypeChart_chart = chart;
        console.log("Completed")
        console.log(chart);
        res(chart);
    }).catch((error)=>
    {
      rej(error);
    });
  });
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

// Return all tags

function showTags()
{
    fetch(tag_all_url, 
      {
        method: "POST",
         headers: {"X-CSRF-TOKEN" : csrf_token_val},
      }
    ).then((x)=>x.json()).then(function (x)
  {
    console.log(x);
  })
}

function deleteTag($id)
{
  let delete_tag_url = `/tags/${id}`

  fetch(delete_tag_url,
    {
      method: "POST",
       headers: {"X-CSRF-TOKEN" : csrf_token_val},
    }
  ).then((x).json()).then(function(x)
{
  console.log(x);
})
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



function createLineChart(labels, y_val, chart)
{

  let data = {
    labels: labels,
    datasets: [{
      label: 'Amount of users',
      data: y_val,
      borderWidth: 1
    }]
  }
  
    return new Chart(chart, {
    type: 'line',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}

function pieChart(labels, y_val, chart)
{
  let data = {
    labels: labels,
    datasets: [{
      label: 'Revenue (£)',
      data: y_val,
      borderWidth: 1
    }]
  }


  return new Chart(chart, {
    type: 'pie',
    data: data,
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
  let data = {
    labels: labels,
    datasets: [{
      label: 'Revenue (£)',
      data: y_val,
      borderWidth: 1
    }]
  }
  return new Chart(chart, {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

}


