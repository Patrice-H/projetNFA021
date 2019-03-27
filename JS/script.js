/*  Fichier : script.js                                             *
 *                                                                  *
 *  Script de l'exercice sur le formulaire d'inscription 			*
 *                                                                  *
 *  @ C:/wamp64/www/projetNFA021/HTML/inscription.html              */

/*function conversion(chaine){
	var rep = "";
	for(i = 0; i < chaine.length; i++){
		if(isNaN(chaine[i])){
			rep += ",";
		}
		else{
			rep += chaine[i];
		}
	}
	return rep;
}*/

function verifText(chaine){
	var rep = true;
	for(i = 0; i < chaine.length; i++){
		if(!isNaN(parseInt(chaine[i], 10))){
			rep = false;
		}
	}
	return rep;
}

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

function ajaxReq(data){
	var recup;
	var chargement = "vérification en cours"
	var xhr = getXhr();
	    
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4){
			if (xhr.status == 200){
	    		validation = xhr.responseText;
	    		
	    		//if(validation == "false"){
	    			document.getElementById("erreur_mail").innerHTML  = "Votre e-mail est déjà enregistré";
	    		//}
	    		
	    		
	    		//return validation;
			}
	    	//else{
	    		//alert("status = " + xhr.status);
	    	//}
		}
		else{
	    	alert("readyState = " + xhr.readyState);
	    	//if(xhr.readyState < 4){
	    	//	document.getElementById("erreur_mail").innerHTML  = chargement += ".";
	    	//}
	    }
	};
	xhr.open("POST", "../traitement.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("mail="+data);
	
	
	//if(xhr.readyState == 4 && xhr.status == 200){
	//	alert("val " + validation);
	//}
}


function envoieForm(){  
    validation = false;
    var formulaire = {};
    formulaire.nom = document.getElementsByName("nom")[0].value;
    formulaire.prenom = document.getElementsByName("prenom")[0].value;
    formulaire.fonction = document.getElementsByName("fonction")[0].value;
    formulaire.mail = document.getElementsByName("mail")[0].value;
    formulaire.date = document.getElementsByName("enregistrement")[0].value;
    formulaire.pass = document.getElementsByName("pass")[0].value;
    formulaire.repass = document.getElementsByName("repass")[0].value;
    
    // Vérification de la double saisie du mot de passe
    
    if(formulaire.pass !== formulaire.repass){
    	document.getElementById("erreur_repass").innerHTML  = "Les mots de passe ne sont pas identiques";
    	validation = false;
    }
    else{
    	document.getElementById("erreur_repass").innerHTML  = "";
    	
    }
    
    // Vérification de la validité de la date d'enregistrement (=== date du jour)
   
    var dateJour = new Date();
    var dateTable = formulaire.date.split("-");
    var dateEnregistrement = new Date(dateTable[0],dateTable[1] - 1,dateTable[2]);
    
    if(dateJour.getDate() !== dateEnregistrement.getDate() || dateJour.getMonth() !== dateEnregistrement.getMonth() || dateJour.getFullYear() !== dateEnregistrement.getFullYear()){
    	
    	document.getElementById("erreur_enregistrement").innerHTML  = "La date indiquée doit être celle d'aujourdhui";
    	validation = false;
    }
    else{
    	document.getElementById("erreur_enregistrement").innerHTML  = "";
    	
    }
    
    // Vérification de la conformité de l'adresse e-mail

    ajaxReq(formulaire.mail);
    
   // if(!ajaxReq(formulaire.mail)){
   // 	alert("validation = " + validation + " - ");
   // }
   // if(typeof(ajaxReq(formulaire.mail)) == "undefined"){validation = false;}
    
    // Vérification de la conformité du type des champs 'nom' et 'prenom' (!= NaN)
    
    if(!verifText(formulaire.nom)){
    	document.getElementById("erreur_nom").innerHTML  = "Votre nom ne doit comporter que des lettres";
    	validation = false;
    }
    else{
    	document.getElementById("erreur_nom").innerHTML  = "";
    	
    }
    if(!verifText(formulaire.prenom)){
    	document.getElementById("erreur_prenom").innerHTML  = "Votre prénom ne doit comporter que des lettres"
    	validation = false;
    }
    else{
    	document.getElementById("erreur_prenom").innerHTML  = ""
        	
    }
    
    // Vérification de la conformité du mot de passe (longueur, caractères obligatoires)
   
 
    // requète AJAX
    
    /*var recup;
    var xhr = getXhr();
	    
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4){
			if (xhr.status == 200){
	    		recup = xhr.responseText;
	    		alert("recup1 = " +  recup);
	    		//return recup;
			}
	    	//else{
	    		//alert("status = " + xhr.status);
	    	//}
		}
	    else{
	    		alert("readyState = " + xhr.readyState);
	    }
	};
	xhr.open("POST", "../verifMail.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("mail="+data);*/
	
	
    return validation;       
}