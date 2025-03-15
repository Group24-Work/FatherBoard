var indexQuestion = 0; // counter for questions
var indexAnswer = "";

var QUESTIONS = [
    {
    "question":"What do you plan to use your PC for?",
    "choices":["Gaming", "Office Work", "CPU Intensive Tasks", "Unsure"]
    },
    {
    "question":"Do you have a brand preference?",
    "choices":["NVIDIA","AMD","Intel","No preference"]
    },
    {
    "question":"How much RAM do you need?",
    "choices":["16GB","32GB","64GB","Unsure"]
    },
    {
    "question":"What kind of storage would you like?",
    "choices":["HDD","SSD","Hybrid","Unsure"]
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
        choices += "<option>"+ QUESTIONS[indexQuestion].choices[i] + "</option>";
        i++
    }
    document.getElementById("choices").innerHTML = choices;
    document.getElementById("choices").addEventListener("change",selectAnswer)
    
}
document.addEventListener("DOMContentLoaded",loadApplication); 


/* https://stackoverflow.com/questions/68564754/is-there-a-way-to-make-my-next-button-displaying-questions-every-time-a-user-c -*/ 
/*https://codepen.io/nithinthampi/pen/Yzzqqae*/