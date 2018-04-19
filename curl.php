<?php

// kilde: https://documenter.getpostman.com/view/223701/blockbuster-middleware/6nBvVzH#59c94b40-d9b4-f201-fcb2-8fc40755491c

//cURL eller Client URL er et bibliotek der gør det muligt at forbinde til og kommunikere med servere
// cURL bliver brugt til at hente data fra en server.
//Jeg har lavet en funktion som jeg kalder "curl" som tager en 'URL' som parameter
function curl($url)
{
    // Starter en ny curl resurse (initiate curl)
    $curl = curl_init();
    
    // Man kan sætte en setting ved at bruge curl_setopt() method
    
    // Denne her funktion er brugbar når man skal sætte en stor mængde af cURL indstillinger 
    curl_setopt_array($curl, array(
     
      // URL som man sender anmodning til.
      CURLOPT_URL => $url,
       
      // Returnere responsen som en string istedetfor at outputte det på skærmen.
      CURLOPT_RETURNTRANSFER => true,
     
      // Dette gør sådan at man kan decode det man får tilbage. 
      CURLOPT_ENCODING => "",
        
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
    ));

    //curl_exec() metoden eksekvere cURL anmodningen.
    // $response indeholder nu responsen fra siden.
    $response = curl_exec($curl);
    
    // Følgende tjekker om der er sket en fejl
    $err = curl_error($curl);
    // Følgende lukker cURL resursen, og frigøre system resurser
    curl_close($curl);

    //Hvis der er sket en fejl, uskriv en fejlbesked
    if ($err) 
    {
      return("cURL Error #:" . $err);
    } else 
    {
      // Følgende tager en JSON encoded string og konvetere det til en PHP variabel.
      return(json_decode($response, true));
    }
}
?>