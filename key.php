<?php  /* db-tilkobling */
/*
/*  Programmet foretar tilkobling til database-server og valg av database
*/

  $servername="localhost";
  $username="265635";
  $password="2lIlrHPV";
  $database="265635"; /* verdier satt for vert, bruker, passord og database for tilkobling til databaseserver */


$db = mysqli_connect($servername,$username,$password,$database) or die ("Could not connect to server...");
?>






