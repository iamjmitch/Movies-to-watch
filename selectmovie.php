<?php
   require_once './inc/functions.inc.php';
   
   
   if(!isset($_POST['searchSubmit'])){
       header("Location: index.php");
       exit;
       }
       else{
           if (isset($_POST['search'])){
               $searchQuery = $_POST['search'] ; 
               echo '<!DOCTYPE html>
               <html lang="en">
               <head>
                   <meta charset="UTF-8">
                   <meta name="viewport" content="width=device-width, initial-scale=1.0">
                   <meta http-equiv="X-UA-Compatible" content="ie=edge">
                   <title>Document</title>
                   <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">
                   <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
               </head>
               <style>
               * {
                   font-family: "Roboto", sans-serif;
               }
               .resultsContainer {
                   max-width: 1200px;
                   margin: 0 auto;
                   display: flex;
                   flex-direction: row;
                   flex-wrap: wrap;
                   justify-content: center;
               }
   
               .result {
                   border: 1px solid #DBDBDB;
                   background: rgb(131,58,180);
                   background: linear-gradient(329deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 100%);
                   padding: 20px;
                   margin: 10px;
                   display: flex;
                   flex-direction: column;
                   max-width: 280px;
                   justify-content: center;
                   align-items: center;
                   box-sizing: border-box;
                   box-shadow: 0px 0px 19px 2px rgba(0, 0, 0, 0.14);
                   border-radius: 7px;
   
               }
   
               img {
                   width: 100%;
                   height: 351px;
                   object-fit: cover;
                   object-position: center;
               }
   
   
   
               p {
                   width: 100%;
                   font-size: 22px;
                   text-align: center;
                   color: white;
               }
   
               form {
                   display: flex;
                   flex-direction: column;
                   align-items: center;
                   justify-content: flex-end;
                   height: 100%;
               }
   
               button {
                   font-size: 20px;
                   padding: 5px 20px;
                   border: 2px solid white;
                   border-radius: 10px;
                   color: white;
                   background: transparent;
                   text-transform: uppercase;
                   transition: 0.3s;
               }
   
               button:hover{
                   box-shadow: inset 150px 30px 0 0 #03a9f4;
                   cursor: pointer;
               }
   
               h1{
                   text-align:center;                
                   font-family: \'Bangers\', cursive!important;                
                   letter-spacing: 5px;
                   font-size:30px;
               }
                   
   
               @media only screen and (max-width: 599px) {
   
                   .result {
                       width: 100%;
                       max-width: 100%;
                       display: flex;
                       flex-direction: row;
                       padding: 10px;
                   }
   
                   img {
                       width: 100%;
                       height: unset;
                       object-fit: cover;
                       object-position: center;
                   }
   
                   form {
                       display: flex;
                       flex-direction: column;
                       align-items: center;
                       justify-content: center;
                       height: 100%;
                   }
   
                   button {
                       font-size: 15px;
                       padding: 5px 15px;
                       border: 2px solid white;
                       border-radius: 10px;
                       color: white;
                       background: transparent;
                       text-transform: uppercase;
                       transition: 0.3s;
                       margin-left: 17px;
                   }
   
                   p {
                       width: 100%;
                       font-size: 16px;
                       text-align: center;
                       color: white;
                       padding-left: 13px;
                   }
   
                   .imgContainer {
                       width: 150px;
                       display: flex;
                   }
   
                   h1{
                       font-size: 50px;
                   }
   
   
   
               }
   
   
   
   
   
               </style>
               <body><h1>Matches</h1>';  
   
               
   
               $i = new movieGetter;
               $i->displayResults($searchQuery);
   
               echo '</body>
               </html>';
   
           }
           else{
               header("Location: index.php");
           }
       }
   
   
   
   
   
   ?>