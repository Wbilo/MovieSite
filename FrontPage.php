<html>
<head>
    <meta charset="utf-8">
    <title>MovieSite</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="front.css">	
</head>
</html>

<?php
// Inkludere headeren
include "header.html"
?>

<?php
// Jeg inkuldere curl.php  fordi at den indeholder funktionen "curl" som jeg vil bruge
include"curl.php";

// Jeg benytter curl funktionen på page/main får at få fat på genrerne
$array = curl("http://bbmiddleware.wexo.dk/page/main");

// Følgende looper igennem alle genrer i page/main. For hver loop bliver den næste genrer i rækken sat til "$val[1]". Jeg sætter [1] efter $val da det er et array som vi har med at gøre.
foreach($array as $val[1])
{
    // Jeg har valgt at ekskludere følgende genrer da der ikke er nogen film der tilhører disse genrer.
    if($val[1] == "familyfun-mix") continue; 
    if($val[1] == "children") continue; 
    if($val[1] == "road_movies") continue;
    if($val[1] == "action-kitsch") continue;
    if($val[1] == "sing-dance") continue;
    if($val[1] == "blodig-fredag") continue;
    
    // Følgende udskriver all genrer og jeg har gjort sådan at genrertitlen fungere som et link der når man klikker på det, åbner en side med alle film fra den valgte genrer.
    echo "<h1><a href=genremovies.php?genreid=$val[1]>" . $val[1] . "</a></h1><br>";
    
    // Jeg benytter curl functionen til at få fat i alt det data som er inde under feed/'genrer'/movies og sætter det = $array1
    $array1 = curl("http://bbmiddleware.wexo.dk/feed/$val[1]/movies");
     
    //Nu laver jeg en tabel får at placere filmene i rækker 
    echo "<table>";
    // Jeg sætter $i til -1 så den første række ikke viser en mindre film end resten af rækkerne
    $i = -1;
    // Jeg bruger $x til at bestemme hvornår rækkerne skal stoppe
    $x = -1;
    
    //Nu laver jeg en foreach loop og fanger det data som er inde under feed/{identifier}/movies, for hver omgang bliver det næste element i rækken sat til "$val"
    foreach($array1 as $val)
    {
        // Denne if statement sørger for at der kun bliver placeret 3 film i hver række
        if ($i == 2) 
        { 
            echo "<tr></tr>"; 
            $i = 0;
            //Denne if statement sørger for at antallet af film der bliver vist under hver genre ikke overstiger et bestemt antal. 
            if ($x == 10)
            {
            break;
            }
      
        } else 
        {
            $i++;
            $x++;
        }
        // Følgende gør at for hver eneste film, bliver der vist filmens titel og thumbnail og det hele bliver lavet til et link man kan trykke på, som refere til filmens id, hvor du kommer ind på en side der viser alt information om filmen. 
        echo "<td><a href=movieid.php?id=". $val["simpleId"] ."><img src=". $val["selectedImages"]["thumbnail"] .">" . "</img>" ."<table style='width:100%;'><tr><th>" . $val["title"] . "</p></th></tr></table></td>";
    }
    echo "</table>";          
}  
?>




