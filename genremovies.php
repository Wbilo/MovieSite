
<?php 
// Jeg inkludere header
include "header.html"?>


<?php
    
// Jeg inkuldere curl.php  fordi at den indeholder "curl" funktionen som jeg vil bruge
include"curl.php";

// På samme måde som i movieid.php bruger jeg $_GET.
// $_GET henter værdien af det som der kommer efter = tegnet i ?genreid= i url'en, hvilket i dette tilgælde er genrerne.
if (isset($_GET['genreid'])) 
{
    $genremovid = $_GET['genreid'];
     // Nu henter jeg alt data for hver genrer og ligger det ind i $array4
    $array5 = curl("http://bbmiddleware.wexo.dk/feed/$genremovid/movies");
   
    //Jeg udskriver tiltlen på genren øverst på siden under headeren
    echo "<h1>". $genremovid ."</h1>";
    
    //Nu laver jeg en tabel får at placere filmene i rækker 
    echo "<table>";
    $i = -1;
    
    //Nu laver jeg en foreach loop og fanger det data som er inde under feed/{identifier}/movies, for hver omgang bliver det næste element i rækken sat til "$val"
    foreach($array5 as $val)
    {
       // Denne if statement sørger for at der kun bliver placeret 3 film i hver række
       if ($i == 2) 
        { 
            echo "<tr></tr>"; 
            $i = 0;
        } else 
        {
            $i++;
        }
        // Følgende gør at for hver eneste film, bliver der vist filmens titel og thumbnail og det hele bliver lavet til et link man kan trykke på, som refere til filmens id, hvor du kommer ind på en side der viser alt information om filmen.
        echo "<td><a href=/movieid.php?id=". $val["simpleId"] ."><img src=". $val["selectedImages"]["thumbnail"] .">" . "</img>" ."<table style='width:100%;'><tr><th><p class='movie-list'>" . $val["title"] . "</p></th></tr></table></td>";
    }
    echo "</table>";
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Genre</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
 
table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  table-layout: fixed;
  width: 100%;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
    
}

.menu {
  float: left;
  width: 20%;
}
.menuitem {
  padding: 8px;
  margin-top: 7px;
  border-bottom: 1px solid #f1f1f1;
}
.main {
  float: left;
  width: 60%;
  padding: 0 20px;
  overflow: hidden;
}
.right {
  background-color: lightblue;
  float: left;
  width: 20%;
  padding: 10px 15px;
  margin-top: 7px;
} 
 body{
	background: ivory;
    
}   
h1 {
    background-color: ivory;
    color: black;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}


h1 {
    background-color: lightgray;
}   
      
td { 
    
    width:20px; 
    height:20px;
    overflow="auto"
    
}
    
td a:link, a:visited {
    background-color: ivory;
    color: black;
    padding: 20px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
     box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}


td a:hover, h1 a:active {
    background-color: lightgrey;
}   
        
h2 {color:lightgrey;}
    </style>   

</head>
</html>