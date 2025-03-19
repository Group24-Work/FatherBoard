var indexQuestion = 0; // counter for questions
var indexAnswer = "";

var QUESTIONS = [
    {
    "question":"What do you plan to use your PC for?",
    "choices":[
        {"choice": "Gaming", "tags":["gaming"]},
        {"choice":"Office Work", "tags": ["office"]},
        {"choice":"Rendering","tags":["rendering"]},
        {"choice":"Unsure", "tags":[""] } 
        ]
    },
    {
    "question":"How much RAM do you need?",
    "choices":[
        {"choice":"16GB", "tags":["16GB"]},
        {"choice":"32GB", "tags":["32GB"]},
        {"choice":"64GB", "tags":["64GB"]},
        {"choice":"Unsure", "tags":[""]}
        ]
    },
    {
    "question":"What kind of storage would you like?",
    "choices":[
        {"choice":"HDD","tags":["HDD"]},
        {"choice":"SSD","tags":["SSD"]},
        {"choice":"Hybrid","tags":[""]},
        {"choice":"Unsure","tags":[""]}
        ]
    }
];

function loadApplication(){
    document.getElementById("btnNext").addEventListener("click",clickNext)
    loadQuestion(indexQuestion);
}

function clickNext(){
    checkAnswer();
}

function checkAnswer(){
    if (indexAnswer == ""){
        nextQuestion();
    }
    else{
        alert("Please enter an answer!");
    }
}

function nextQuestion(){
    if(indexQuestion<QUESTIONS.length-1){
        indexQuestion++
        loadQuestion(indexQuestion);
    }
}



function loadQuestion(indexQuestion){
    document.getElementById("question").textContent = QUESTIONS[indexQuestion].question;
    var choices = "";
    var i = 0
    while(i<QUESTIONS[indexQuestion].choices.length){
        choices += "<option>"+ QUESTIONS[indexQuestion].choices[i].choice + "</option>";
        i++
    }
    document.getElementById("choices").innerHTML = choices;
    document.getElementById("choices").addEventListener("change",selectAnswer)
    
}
document.addEventListener("DOMContentLoaded",loadApplication); 


/* https://stackoverflow.com/questions/68564754/is-there-a-way-to-make-my-next-button-displaying-questions-every-time-a-user-c -*/ 
/*https://codepen.io/nithinthampi/pen/Yzzqqae*/