/*  Fichier : script.js                                             *
 *                                                                  *
 *  Script de l'exercice sur le formulaire d'inscription 			*
 *                                                                  *
 *  @see ../projetNFA021/HTML/inscription.html                      *
 ********************************************************************/


var formulaire = {};

/**
 * Instancie et retourne un objet de type XMLHttpRequest -
 * 
 * Renvoie false sinon
 * @throw ActiveX XMLHttp < Internet Explorer 7 : e1
 * @throw ActiveX XMLHttp >= Internet Explorer 7 : e2
 * @throw XMLHttpRequest autres navigateurs : e3
 * @returns {Object\Boolean} : xhr
 */
function getXhr(){
	
	var xhr = null;
	
	try {
		xhr = new ActiveXObject('Msxml2.XMLHTTP');
	}
	catch (e1){
		try {
			xhr = new ActiveXObject('Microsoft.XMLHTTP');
			}
		catch (e2){
			try {
				xhr = new XMLHttpRequest();
				}
			catch (e3){
				alert("AJAX n'est pas supporté par votre navigateur");
				return false;
			}
		}
	}
	return xhr;
}

/**
 * Vérifie la concordance des mots de passes saisis -
 * 
 * Modifie le DOM Id = 'erreur_repass'
 * @param {String} : pass
 * @param {String} : repass
 */
function controleDoubleSaisie(pass, repass){
	
	if(pass !== repass){
    	document.getElementById("erreur_repass").innerHTML  = "Les mots de passe ne sont pas identiques";
    	return false;
    }
    else{
    	document.getElementById("erreur_repass").innerHTML  = "";
    	return true;
    }
}

/**
 * Vérifie la longueur du mot de passe passé en paramètre -
 * 
 * Modifie le DOM Id = "erreur_pass"
 * @param {String} : pass
 * @returns {Boolean}
 */
function controleLongueur(pass){
	
	if(pass.length < 8){
		document.getElementById("erreur_pass").innerHTML  = "votre mot de passe doit contenir 8 caratères au moins";
		return false;
	}
	else{
		document.getElementById("erreur_pass").innerHTML  = "";
		return true;
	}
}

/**
 * Effectue la checklist des contrôles -
 * 
 * valide le formulaire
 * @param responseText Ajax : reponse
 */
function controleValidation(reponse){
	
	var validation = true;
	
	if(reponse == "false"){
		validation = false;
	}
	if(!controleLongueur(formulaire.pass)){
		validation = false;
	}
	if(!controleDoubleSaisie(formulaire.pass, formulaire.repass)){
		validation = false;
	}
	if(validation){
		document.getElementById("saisie").submit();
	}
}

/**
 * Vérifie la réponse texte Ajax fournie en paramètre -
 * 
 * Modifie le DOM Id = "erreur_mail"
 * @param responseText Ajax : resultat
 */
function controleMail(resultat){
	
	if(resultat == "false"){
		document.getElementById("erreur_mail").innerHTML  = "Votre e-mail est déjà enregistré";
	}
	else{
		document.getElementById("erreur_mail").innerHTML  = "";
	}
	controleValidation(resultat);
}


/**
 * Requête Ajax vérifiant si un e-mail est déjà enregistré -
 * 
 * Renvoie la reponse en paramètre de la fonction validMail()
 * @param {String} : data
 */
function ajaxReq(data){
	
	var xhr = getXhr();
	    
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4){
			if (xhr.status == 200){
				alert(xhr.responseText);
	    		controleMail(xhr.responseText);	
			}
		}
	};
	xhr.open("POST", "../enregistrement.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("origine=reqajax&mail="+data);
}

/**
 * Fonction d'entrée du script déclenchée à l'évènement onsubmit du formulaire -
 * 
 * Encapsule les données dans un objet formulaire et déclenche les contôles de saisie
 * @returns {Boolean}
 */
function envoieForm(){
	
    formulaire.nom = document.getElementsByName("nom")[0].value;
    formulaire.prenom = document.getElementsByName("prenom")[0].value;
    formulaire.fonction = document.getElementsByName("fonction")[0].value;
    formulaire.mail = document.getElementsByName("mail")[0].value;
    formulaire.date = document.getElementsByName("enregistrement")[0].value;
    formulaire.pass = document.getElementsByName("pass")[0].value;
    formulaire.repass = document.getElementsByName("repass")[0].value;
    
    ajaxReq(formulaire.mail);
    return false;       
}