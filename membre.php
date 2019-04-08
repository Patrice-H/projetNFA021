<?php
	/**
	 * Classe Membre
	 * 
	 * Crée un objet membre
	 * @version 1.0.1 
	 */
	class Membre{
		
		
		/**
		 * Id du membre
		 * @var {int}
		 */
		private $_id;
		
		/**
		 * Nom du membre
		 * @var {string}
		 */
		private $_nom;
		
		/**
		 * Prénom du membre
		 * @var {string}
		 */
		private $_prenom;
		
		/**
		 * E-mail du membre
		 * @var {string}
		 */
		private $_mail;
		
		/**
		 * Date de naissance du membre
		 * @var {date}
		 */
		private $_naissance;
		
		/**
		 * Mot de passe du membre
		 * @var {string}
		 */
		private $_mot_passe;
		
		/**
		 * Mot de passe de confirmation de saisie
		 * @var {string}
		 */
		private $_re_mot_passe;
		
		
		/**
		 * Constructeur
		 * 
		 * Nécessite une table de données en paramètre
		 * @param {array} $data
		 */
		public function __construct($data){
			$this->_id = $data['id'];
			$this->_nom = $data['nom'];
			$this->_prenom = $data['prenom'];
			$this->_mail = $data['mail'];
			$this->_naissance = $data['date_enregistrement'];
			$this->_mot_passe = $data['pass'];
			$this->_re_mot_passe = $data['repass'];
		}
		
		
		/**
		 * Getteur Id
		 * 
		 * @return {int} Id du membre
		 */
		public function getId(){
			return $this->_id;
		}
		
		/**
		 * Getteur Nom
		 * 
		 * @return {string} Nom membre
		 */
		public function getNom(){
			return $this->_nom;
		}
		
		/**
		 * Getteur Prénom
		 * 
		 * @return {string} Prénom membre
		 */
		public function getPrenom(){
			return $this->_prenom;
		}
		
		/**
		 * Getteur E_mail
		 * 
		 * @return {string} E-mail membre
		 */
		public function getMail(){
			return $this->_mail;
		}
		
		/**
		 * Getteur Date naissance
		 * 
		 * @return {date} Naissance membre
		 */
		public function getNaissance(){
			return $this->_naissance;
		}
		
		/**
		 * Getteur Mot de passe 1
		 * 
		 * @return {string} Pass membre
		 */
		public function getMotPasse(){
			return $this->_mot_passe;
		}
		
		/**
		 * Getteur Mot de passe 2
		 *
		 * @return {string} Pass membre
		 */
		public function getRePasse(){
			return $this->_re_mot_passe;
		}
		
		/**
		 * Setteur Nom
		 * 
		 * @param {string} $nom
		 */
		public function setNom($nom){
			$this->_nom = $nom;
		}
		
		/**
		 * Setteur Prénom
		 * 
		 * @param {string} $prenom
		 */
		public function setPrenom($prenom){
			$this->_prenom = $prenom;
		}
		
		/**
		 * Setteur E-mail
		 * 
		 * @param {string} $mail
		 */
		public function setMail($mail){
			$this->_mail = $mail;
		}
		
		/**
		 * Setteur Naissance
		 * 
		 * @param {date} $naissance
		 */
		public function setNaissance($naissance){
			$this->_naissance = $naissance;
		}
		
		/**
		 * Setteur Mot de passe 1
		 * 
		 * @param {string} $mot_passe
		 */
		public function setMotPasse($mot_passe){
			$this->_mot_passe = $mot_passe;
		}
		
		/**
		 * Setteur Mot de passe 2
		 *
		 * @param {string} $mot_passe
		 */
		public function setRePasse($mot_passe){
			$this->_re_mot_passe = $mot_passe;
		}
	
		/**
		 * Fonction email
		 *
		 * Contrôle la présence de l'e-mail dans la base de données
		 * @return {boolean}
		 */
		public function email(){
			$match = false;
			try{
				$bdd = new PDO('mysql:host=localhost;dbname=projetNFA021;charset=utf8', 'root', '');
			}
			catch(Exception $e){
				die($e->getMessage());
			}
			$donnees = $bdd->query('SELECT mail FROM client');
			while ($ligne = $donnees->fetch()){
				if($this->getMail() === $ligne['mail']){
					$match = true;
				}
			}
			return $match;
		}
		
		/**
		 * Fonction checkPassword
		 * 
		 * vérifie la concordance des mots de passe saisies
		 * @return {boolean}
		 */
		public  function checkPassword(){
			if($this->getMotPasse() === $this->getRePasse()){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function ecrire(){
			
			try{
				$bdd = new PDO('mysql:host=localhost;dbname=projetNFA021;charset=utf8', 'root', '');
			}
			catch(Exception $e){
				die($e->getMessage());
			}
			$req = $bdd->prepare('INSERT INTO client(nom, prenom, mail, date_enregistrement, pass) VALUES(:nom, :prenom, :mail, :date_enregistrement, :pass)');
			$req->execute(array(
					'nom' => $this->getNom(),
					'prenom' => $this->getPrenom(),
					'fonction' => '',
					'mail' => $this->getMail(),
					'date_enregistrement' => $this->getNaissance(),
					'pass' => $this->getMotPasse()
			));
		}
	}
?>