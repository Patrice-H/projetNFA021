<?php
	header('content-type: text/html; charset=utf-8');
	
	/*if(isset($_POST['nom'])){
		$nom = "essai";
	}
	else {
		$nom = $_POST['nom'];
	}*/
   /* $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $fonction = $_POST['fonction'];*/
    $mail = $_POST['mail'];
   /* $enregistrement = $_POST['enregistrement'];
    $pass = $_POST['pass'];*/
    $ecriture = true;
    
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetNFA021;charset=utf8', 'root', '');
    }
    catch(Exception $e){
        die($e->getMessage());
    }
    
    $donnees = $bdd->query('SELECT * FROM client');
    while ($champ = $donnees->fetch()){

    	if($champ['mail'] === $mail){
    		
    		$ecriture = false;
    		echo "true";
    		
    		/*$doc = new DOMDocument();
    		$doc->loadHTMLFile(utf8_decode("HTML/inscription.html"));
    		$trans = utf8_encode("Cette adresse e-mail est déjà utilisée");
    		$text = $doc->createTextNode($trans);
    		$span = $doc->getElementById('erreur_mail');	//->firstChild();
    		$var = $span->firstChild();
    		
    		$span->appendChild($text);
    		$doc->saveHTMLFile("HTML/inscription.html");	
            header('Location: HTML/inscription.html');*/
           	//exit();
        }
    }
        
	if($ecriture){
		$req = $bdd->prepare('INSERT INTO client(nom, prenom, fonction, mail, date_enregistrement, pass) VALUES(:nom, :prenom, :fonction, :mail, :date_enregistrement, :pass)');
		$req->execute(array(
			'nom' => $_POST['nom'],
			'prenom' => $_POST['prenom'],
			'fonction' => $_POST['fonction'],
			'mail' => $_POST['mail'],
			'date_enregistrement' => $_POST['enregistrement'],
			'pass' => $_POST['pass']	
        	));
        	echo utf8_encode("Votre compte est enregistré");
 	}   
?>