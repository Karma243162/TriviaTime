console.log('EH EHE  H');
import { getReponse } from "./api/api_reponse.js";

async function AfficherReponse() {
  try {
    const reponse = await getReponse();
    console.log(reponse);
  } catch (erreur) {}
}

AfficherReponse()
