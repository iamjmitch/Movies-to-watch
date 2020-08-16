<?php
   require_once './inc/functions.inc.php';
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Movie Watch List</title>
      <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet"
         crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
   </head>
   <style>
      body{
      background:White;
      margin:0;
      padding:0;
      }
      * {
      font-family: "Roboto", sans-serif;
      }
      .pageContainer {
      max-width: 1270px;
      min-width: 400px;
      margin: 0 auto;
      padding: 10px;
      box-sizing:border-box; 
      }
      .movieContainer {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      }
      .heading {
      text-align: center;
      text-transform: uppercase;
      color:black;
      margin: 10px;
      margin-top:0;
      font-family: \'Bangers\', cursive!important;
      font-size:30px;
      }
      h1{
      font-family: \'Bangers\', cursive!important;                
      letter-spacing: 5px;
      margin-top:0;
      }
      .seachBar {
      display: flex;
      width: 100%;
      flex-direction: row;
      flex-wrap: nowrap;
      padding: 0 10px;
      border: 1px solid grey;
      border-radius: 24px;
      justify-content: center;
      align-items: center;
      margin-right: 10px;
      }
      .searchBox{
      display: flex;
      width: 100%;
      flex-direction: row;
      flex-wrap: nowrap;
      margin-bottom:20px;
      }
      form {
      display: flex;
      flex-direction: row;
      width: 100%;
      }
      input#search {
      font-size: 16px;
      line-height: 16px;
      text-transform: capitalize;
      width: 100%;
      border: none;
      padding: 10px;
      border-radius: 20px;
      }
      button {
      padding: 2px 26px;
      font-size: 16px;
      border-radius: 24px;
      border: 1px solid grey;
      font-weight: bolder;
      background: rgb(131,58,180);
      background: linear-gradient(329deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 100%);
      color: white;
      letter-spacing: 1px;
      transition:0.3s;
      }
      button:hover{
      box-shadow: inset 150px 30px 0 0 #03a9f4;
      cursor: pointer;
      }
      .movie {
      display: flex;
      flex-direction: row;
      border: 1px solid grey;
      margin-top: 25px;
      background: rgb(131,58,180);
      background: linear-gradient(329deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 100%);
      padding:20px;
      border-radius: 12px;
      box-shadow: -3px 4px 7px -2px rgba(0, 0, 0, 0.5);
      max-width: 553px;
      margin: 15px;
      align-items: center;
      }
      img {
      width: 100%;
      }
      .poster {
      min-width: 150px;
      max-width: 150px;
      overflow: hidden;
      border: 2px solid white;
      display: flex;
      }
      .title {
      color: white;
      font-size: 28px;
      text-align: center;
      }
      .title:after {
      content: "";
      background-color: #fff;
      height: 3px;
      width: 20%;
      margin: 5px auto;
      display: block;
      }
      .title p {
      margin:0;
      padding:0;
      }
      .plot {
      color: white;
      font-size: 16px;
      padding: 10px 0;
      text-align: center;
      }
      .words {
      display: flex;
      flex-direction: column;
      padding: 0 20px;
      }
      .movieButtons {
      display: flex;
      flex-direction: row;
      justify-content: space-evenly;
      height: 100%;
      align-items: flex-end;
      }
      button.YT, button.imdb {
      background: white;
      color: black;
      border: 1px solid grey;
      padding: 5px 29px;
      font-size: 16px;
      }
      a {
      text-decoration: none;
      color: #ef83b0;
      font-size: 18px;
      transition: 0.3s;
      }
      a:hover{
      color: #03a9f4;
      cursor: pointer;
      }
      .desk{
      display: unset;
      }
      .delete.desk{
      align-self: flex-start;
      }
      .mobile{
      display:none;
      }
      .extras {
      font-size: 12px;
      color: white;
      display: flex;
      flex-direction: row;
      justify-content: space-evenly;
      }
      .extras p {
      padding: 0 8px;
      }
      .plot:before, .plot:after{
      content: "";
      background-color: #ffffff40;
      height: 1px;
      width: 100%;                
      display: block;
      margin: 15px auto;
      }
      #loading {
      display:none;
      width: 100%;
      height: 110vh;
      background: #000000a6;
      justify-content: center;
      align-items: center;
      position: absolute;
      color: white;
      font-size: 2em;
      }
      @media only screen and (max-width: 599px) {
      .pageContainer {
      width: 100%;
      margin: 0 auto;
      }
      .movie {
      display: flex;
      flex-direction: column ;
      justify-content: center;
      align-items: center;
      }
      .title {
      margin-bottom: 15px;
      font-size:25px;
      }
      .plot p{
      margin: 0;
      }
      .plot{
      padding:0;
      text-align:left;
      }
      .movieButtons {
      margin-bottom: 20px;
      }
      .desk{
      display: none;
      }
      .mobile{
      display:block;
      }
      .poster {
      min-width: 120px;
      max-width: 120px;
      overflow: hidden;
      border: 2px solid white;
      display: flex;
      max-height: 180px;
      }
      .movieButtons {
      display: flex;
      flex-direction: row;
      justify-content: space-evenly;
      height: 100%;
      align-items: center;
      padding:0;
      padding-top: 10px;
      margin-bottom:0;
      }
      .words {
      padding: 0;
      }
      .topContainer {
      display: flex;
      }
      .mobile .extras {
      flex-direction: column;
      margin-top: 0;
      font-size: 14px;
      }
      .mobile .extras p {
      padding: 1px; 
      margin: 2px 0;
      }
      .mobile .title{
      text-align: left;
      }
      .topContainer {
      display: flex;
      width: 100%;
      }
      .words.mobile {
      width: 100%;
      padding: 0 15px;
      display: flex;
      justify-content: center;
      }
      }
      @keyframes load {
      0%{
      opacity: 0.08;
      /*         font-size: 10px; */
      /* 				font-weight: 400; */
      filter: blur(5px);
      letter-spacing: 3px;
      }
      100%{
      /*         opacity: 1; */
      /*         font-size: 12px; */
      /* 				font-weight:600; */
      /* 				filter: blur(0); */
      }
      }
      .animate {
      display:flex;
      justify-content: center;
      align-items: center;
      height:100%;
      margin: auto;
      /* 	width: 350px; */
      /* 	font-size:26px; */
      font-family: Helvetica, sans-serif, Arial;
      animation: load 1.2s infinite 0s ease-in-out;
      animation-direction: alternate;
      text-shadow: 0 0 1px white;
      }
   </style>
   <body>
      <div id="loading">
         <h2 class="animate">Searching...</h2>
      </div>
      <div class="pageContainer">
         <div class="heading">
            <h1>To  Watch  List</h1>
         </div>
         <div class="searchBox">
            <form action="selectmovie.php" method="POST" onsubmit="load()">
               <div class="seachBar">
                  <i class="fas fa-search"></i>
                  <input type="text" name="search" id="search">
               </div>
               <button type="submit" name="searchSubmit" name="searchSubmit">Search</button>
            </form>
         </div>
         '
         <?php
            $i = new movieGetter;
            $i->display();
            ?>
      </div>
   </body>
   <script>
      function load(){
          document.getElementById("loading").style.display = "flex";
      }
   </script>
</html>
';