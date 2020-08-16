<?php
   require_once './inc/functions.inc.php';
   
   if(!isset($_GET['imdbID'])){
   header("Location: index.php");
   exit;
   }
   else{
       $imdbID = $_GET['imdbID'];
       $i = new movieGetter;
       $i->remove($imdbID);
       header("Location: index.php?message=removeSuccess");
       
   }
   
   
   ?>