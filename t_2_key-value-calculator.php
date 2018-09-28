<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
// A simple web site in Cloud9 that runs through Apache
// Press the 'Run' button on the top to start the web server,
// then click the URL that is emitted to the Output tab of the console

header('Content-Type: text/html; charset=utf-8');

//funktio arpoo avaimen annetun pituuden perusteella
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz���ABCDEFGHIJKLMNOPQRSTUVWXYZ���'; //merkit jotka mahdollisia avaimeen
    $charactersLength = strlen($characters); //Merkkijonon pituus talteen
    $randomString = ''; //Aloitetaan Jonon muodostus tyhj�st�
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)]; //Valitaan merkkijonosta Annettu m��r� satunnaisia merkkej�
    }
    return $randomString; //Palautetaan jono
}


$a = array(); // Tyhj� array


// muodostetaan 1000 kpl Key Value pareja
for($i=0; $i <= 999;){
    
    $randomizedString = generateRandomString(rand(1,5)); //Muodostetaan Avain
    
    //Tarkistaan onko Avain jo Arrayss�
    if(!array_key_exists($randomizedString, $a)){
        //Jos ei niin tallennetaan uusi pari Arrayhin
        $a[$randomizedString] = preg_match_all('/[aeiou���]/i',$randomizedString,$matches);    
        //Aloitetaan uuden luominen
        $i++;
    }
    
}

//Matematiikkaa helpottavat muuttujat
$summaA = 0;
$summaB = 0;
$summaC = 0;

$helpperB = 0;
$helpperC = 0;
//K�yd��n koko array l�pi
foreach($a as $key => $value){

    //tarkistetaan l�ytyyk� avaimesta ab kirjaimia
    if(preg_match_all('/[ab]/i',strtolower($key),$matches) > 0){
        $summaA += $value; //lis�t��n arvo muuttuja
    }
    //tarkistetaan l�ytyyk� avaimesta ��� kirjaimia
    if(preg_match_all('/[���]/i',strtolower($key),$matches) > 0){
        $summaB += $value; //lis�t��n arvo muuttujaan
        $helpperB++;//kasvatetaan jakajaa keskiarvon laskemista varten
    }
    //tarkastetaan l�ytyyk� avaimesta kirjaimia
    if(preg_match('/[abcdefghijklmnopqrstuvwxyz���]/i',$key,$matches) == 0){
        $summaC += $value;//lis�t��n arvo muuttujaan
        $helpperC++;//kasvatetaan jakajaa keskiarvon laskemista varten
    }
}

//Lasketaan keskiarvot B ja C kohdalle
$keskiarvoB = $summaB / $helpperB;
$keskiarvoC = $summaC / $helpperC;


// muodostetaan haluttu vastaus Array
$jsonArray = array('A Kohdan vastaus' => $summaA, 'B Kohdan vastaus' => $keskiarvoB, 'C Kohdan summa' => $summaC, 'C Kohdan keskiarvo' => $keskiarvoC );

// Printataan ulos JSON muodossa
echo json_encode($jsonArray);
?>
</body>
</html>