<?php

	$user = "root";
	$pass = "";

	try {
	    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=db_erp_nfce', $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
	
	include "conection_estados.php";

?>
