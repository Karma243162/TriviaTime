
import { getQuizzId } from "./api/api_quizz.js";


let indice = 0;
var question;
var buttonA;
var buttonB; 
var buttonC; 
var buttonD; 
var reponse; 

var quizz;

async function QuizzId(id) {
  try {
    quizz = await getQuizzId(id)
    console.log(quizz);
    var quizzDiv = document.getElementById("quizz");
    var score = 0;
    function isTrue() {
      if (this.reponse == true) {
        alert("la reponse est bonne")
        this.classList.add("btn-success");
        score++
        updateScore();
        console.log(score);
      } else {
        alert("la reponse est mauvaise")
        this.classList.add("btn-success");
      }
      suivant();
    }

    function updateScore() {
      // Mettre à jour l'affichage du score
      point.innerText = "Votre score : " + score;
  }

    //title
    var titleQuizz = document.createElement("h1");
    titleQuizz.classList.add("text-white", "mt-5");
    titleQuizz.innerText = quizz.titre;

    //question
    question = document.createElement("p");
    question.classList.add("text-white");
    question.innerText = quizz.questions[0].contenu + " ?";

    //reponses


    var divAb = document.createElement("div")
    divAb.classList.add("form-group", "d-flex", "justify-content-center")

    // reponse > Button

     buttonA = document.createElement("button")
    buttonA.classList.add("btn", "btn-dark", "w-25", "m-2")
    buttonA.addEventListener('click', isTrue, false)
    buttonA.innerText = quizz.questions[0].reponses[0].contenu
    buttonA.reponse = quizz.questions[0].reponses[0].isTrue;



     buttonB = document.createElement("button")
    buttonB.classList.add("btn", "btn-dark", "w-25", "m-2")
    buttonB.innerText = quizz.questions[0].reponses[1].contenu;
    buttonB.reponse = quizz.questions[0].reponses[1].isTrue;
    buttonB.addEventListener('click', isTrue, false)

    var divCd = document.createElement("div")
    divCd.classList.add("form-group", "d-flex", "justify-content-center")

     buttonC = document.createElement("button")
    buttonC.classList.add("btn", "btn-dark", "w-25", "m-2")
    buttonC.innerText = quizz.questions[0].reponses[2].contenu
    buttonC.reponse = quizz.questions[0].reponses[2].isTrue;
    buttonC.addEventListener('click', isTrue, false)

    buttonD = document.createElement("button")
    buttonD.classList.add("btn", "btn-dark", "w-25", "m-2")
    buttonD.innerText = quizz.questions[0].reponses[3].contenu
    buttonD.reponse = quizz.questions[0].reponses[3].isTrue;
    buttonD.addEventListener('click', isTrue, false)
    
    // Question numero

    var point = document.createElement("p");
    point.classList.add("text-white");

  

    //appenChild

    divAb.appendChild(buttonA)
    divAb.appendChild(buttonB)
    divCd.appendChild(buttonC)
    divCd.appendChild(buttonD)
    quizzDiv.appendChild(titleQuizz);
    quizzDiv.appendChild(question);
    quizzDiv.appendChild(divAb)
    quizzDiv.appendChild(divCd)
    quizzDiv.appendChild(point)




  } catch (erreur) {
    console.error('Erreur lors de la recuperation :', erreur);
    throw erreur; 
  }
}


var quizz = document.getElementById('quizz');
var idQuiz = quizz.getAttribute('data-idQuizz');

QuizzId(idQuiz);

function suivant(){
  indice++;
  question.innerText = quizz.questions[indice].contenu + " ?";
  buttonA.innerText = quizz.questions[indice].reponses[0].contenu
  buttonA.reponse = quizz.questions[indice].reponses[0].isTrue;
  buttonB.innerText = quizz.questions[indice].reponses[1].contenu
  buttonB.reponse = quizz.questions[indice].reponses[1].isTrue;
  buttonC.innerText = quizz.questions[indice].reponses[2].contenu
  buttonC.reponse = quizz.questions[indice].reponses[2].isTrue;
  buttonD.innerText = quizz.questions[indice].reponses[3].contenu
  buttonD.reponse = quizz.questions[indice].reponses[3].isTrue;
}