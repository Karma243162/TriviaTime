console.log('EH EHE  H');
import { getReponse } from "./api/api_reponse.js";
// import { getQuizzId } from "./api/api_quizz.js"

async function AfficherReponse() {
  try {
    const reponse = await getReponse();
    const reponses = reponse["hydra:member"]
    var quizz = document.getElementById('Quizz')
    
    for (const reponse of reponses) {
      console.log(reponse);
      var question = document.createElement("p");
      question.classList.add("text-white");
      question.innerText = reponse.question.contenu + " ?";
      quizz.appendChild(question);
  } 

   
 
  } catch (erreur) {
    console.error('Erreur lors de la recuperation :', erreur); 
    throw erreur; // passer l erreur
  }
}

// async function QuizzId(id) { 
//   try {
//     const quizz = await getQuizzId(id)
//     console.log(quizz);
//   } catch(erreur) { 
//     console.error('Erreur lors de la recuperation :', erreur); 
//     throw erreur; // passer l erreur
//   }
// }

AfficherReponse()
// QuizzId()
