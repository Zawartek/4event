<?php
//$host =  "vs-09-wamp" ;  //localhost chez vous
//$user =  "ilie1" ;
//$pass  = "ilie1" ;
//$base	= $user;

$Cnx = array ();
$Cnx[] = array('host' => 'vs-09-wamp' , 'nom' => 'ilie1' , 'pass' => 'ilie1', 'base' => 'ilie1'); 
$Cnx[] = array('host' => 'localhost'  , 'nom' => 'root' , 'pass' => '', 'base' => 'ilie1'); 

$link=null;   //$link :  référence de connexion
connect($Cnx);

function connect($Cnx) {
global $link; 

//	echo ('<pre>'); 
//	print_r($Cnx);
//	echo ('</pre>');
//	die();

//	$link=@mysql_connect ($Cnx[0]['host'], $Cnx[0]['nom'], $Cnx[0]['pass']);
	foreach ($Cnx as $t) { 
		if (!$link && !($link=mysql_connect ($t['host'], $t['nom'], $t['pass']))) 
					continue;	
	}
//die ('ICI');

	if (!$link) 
		die ("erreur de connexion à MYSQL : <br/>" . mysql_error());
	
	mysql_select_db ($t['base'], $link) 
					or die ("erreur de connexion à la base :" . $t['base']);
	return $link; 
}


?>