var indexQuestion = 0; // counter for questions
var selectedTags = [];
var questionResponses = {};
var QUESTIONS = [
    {
        "question": "What do you plan to use your PC for?",
        "choices": [
            { "choice": "Gaming", "tags": ["gaming"] },
            { "choice": "Office Work", "tags": ["office"] },
            { "choice": "Rendering", "tags": ["rendering"] },
            { "choice": "Unsure", "tags": ["unsure_usage"] }
        ]
    },
    {
        "question": "How much RAM do you need?",
        "choices": [
            { "choice": "16GB", "tags": ["16GB"] },
            { "choice": "32GB", "tags": ["32GB"] },
            { "choice": "64GB", "tags": ["64GB"] },
            { "choice": "Unsure", "tags": ["unsure_ram"] }
        ]
    },
    {
        "question": "What kind of storage would you like?",
        "choices": [
            { "choice": "HDD", "tags": ["HDD"] },
            { "choice": "SSD", "tags": ["SSD"] },
            { "choice": "Hybrid", "tags": ["hybrid_storage"] },
            { "choice": "Unsure", "tags": ["unsure_storage"] }
        ]
    }
];

function loadApplication() {
    document.getElementById("btnNext").addEventListener("click", clickNext)
    document.getElementById("btnSubmit").style.display = "none";
    loadQuestion(indexQuestion);
}

function clickNext() {
    saveAnswer();
    checkAnswer();
}

function saveAnswer() {
    const selectElement = document.getElementById("choice"); // should get the tag db
    const selectedIndex = selectElement.selectedIndex;

    if (selectedIndex >= 0) {
        const selectedTags = QUESTIONS[indexQuestion].choices[selectedIndex].tags;
        const selectedChoiceTags = QUESTIONS[indexQuestion].choices[selectedIndex].tags;
        // line above should get associated tags with the options from above

        const questionKey = "question_" + indexQuestion;
        questionResponses[questionKey] = {
            questionText: QUESTIONS[indexQuestion].question,
            selectedChoice: selectedChoice,
            selectedTags: selectedChoiceTags,
            isSpecial: selectedChoice == "unsure" || selectedChoice === "hybrid"
        };
        if (selectedChoiceTags && selectedChoiceTags.length > 0)
            selectedChoiceTags.forEach(tag => {
                if (!selectedTags.includes(tag)) {
                    selectedTags.push(tag);
                }
            });

    }
}


function nextQuestion() {
    if (indexQuestion < QUESTIONS.length - 1) {
        indexQuestion++;
        loadQuestion(indexQuestion);
    } else {

        document.getElementById("questionContainer").style.display = "none";
        document.getElementById("btnNext").style.display = "none";
        document.getElementById("btnSubmit").style.display = "block";

        const tagsInput = document.createElement("input");
        tagsInput.type = "hidden";
        tagsInput.name = "selected_tags";
        tagsInput.value = JSON.stringify(selectedTags);
        document.getElementById("questionnaireForm").appendChild(tagsInput);

        const responsesInput = document.createElement("input");
        responsesInput.type = "hidden";
        responsesInput.name = "question_responses"
        responsesInput.value = JSON.stringify(questionResponses);
        document.getElementById("questionnaireForm").appendChild(responsesInput);
    }
}



function loadQuestion(indexQuestion) {
    document.getElementById("question").textContent = QUESTIONS[indexQuestion].question;
    var choices = "";
    var i = 0
    while (i < QUESTIONS[indexQuestion].choices.length) {
        choices += "<option value='" + i + "'>" + QUESTIONS[indexQuestion].choices[i].choices[i].choice + "</option>";
        i++
    }
    document.getElementById("choice").innerHTML = choices;
    document.getElementById("choice").addEventListener("change", selectAnswer)
}
function submitQuestionnaire() {
    document.getElementById("questionnaireForm").submit();
}

document.addEventListener("DOMContentLoaded", loadApplication);


/* https://stackoverflow.com/questions/68564754/is-there-a-way-to-make-my-next-button-displaying-questions-every-time-a-user-c -*/
/*https://codepen.io/nithinthampi/pen/Yzzqqae*/
