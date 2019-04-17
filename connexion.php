<?php
	/**
	 * Classe Connexion (Singleton)
	 * 
	 * Crée un unique objet connexion
	 * @version 1.0.1 
	 */
	class Connexion{
		
		/**
		 * Instance de la classe Connexion
		 * @static
		 * @var {PDO}
		 */
		private static  $_instance = null;
		
		
		/**
		 * Constructeur privé
		 * 
		 * Pas d'instanciation possible de la classe
		 * @access private
		 */
		private function __construct(){}
		
		/**
		 * Fonction retournant l'unique instance de la classe
		 * 
		 * @static
		 * @param {string} $host
		 * @param {string} $dbname
		 * @param {string} $user
		 * @param {string} $pass
		 * @return {PDO} $_instance
		 */
		public static function getInstance($host, $dbname, $user, $pass){
			if(is_null(self::$_instance)){
				try {
					self::$_instance = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
				}
				catch(Exception $e){
					die($e->getMessage());
				}
			}
			return self::$_instance;
		}
		
	}
?>