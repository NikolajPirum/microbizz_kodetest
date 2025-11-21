<?php 
/* 
codeCracker.php purpose: run every 4 digit code compination for MicroBizz door entry.
The arraylist "$fourDigitsCombination" contains all possible code combinations.
*/
$fourDigitsCombination = [9];
$num =  9999;

// ================================================FOR AND WHILE LOOPS FOR CODE COMBINATION================================================
//loops numbers from 9999 to 1000 and pushes to array
 while($num != 1000){
    $num--;
    $fourDigitNumber = $num; 
    array_push($fourDigitsCombination, $fourDigitNumber);
 }

//loops from 999 to 100 and adds a zero in front of the 3 digit-number.
for($num=999; $num >= 100; $num--){
    $threeDigitNumber = 0 . $num;
    array_push($fourDigitsCombination, $threeDigitNumber);
}

//loops from 99 to 10 and adds and adds two zeroes in front of the 2 digit-number.
for($num; $num >= 10; $num--){
    $twoDigitNumber = 0 . 0 . $num;
    array_push($fourDigitsCombination, $twoDigitNumber);
}
//loops from 10 to 0 and adds three zeroes in front of the number
for($num; $num != -1; $num--){
    $oneDigitNumber = 0 . 0 . 0 . $num;
    array_push($fourDigitsCombination, $oneDigitNumber);
}

//==========================================================CREATE & WRITE TO ALL COMBINATIONS TO FILE==========================================

//creates textfile "åbningskoder" if it dont exists, or overwrites it. 
$fileName = "koder/åbningskoder.txt";
$myfile = fopen($fileName, "w");

// check for duplicate items in fourDigitsCombination[]
$uniqueCodeCombinations = array_unique($fourDigitsCombination);

// join array items into one string
$oneStringCodeCombinations = implode("",$uniqueCodeCombinations);

fwrite($myfile, $oneStringCodeCombinations);


//========================================================= FTP SERVER ======================================================

$ftp_server = "ftp.microbizz.dk";

//hard coded credentials whoops
$ftp_user_name = "pentacon";
$ftp_user_pass = "j8betk";

//local_file -> koder/åbningskoder.txt
$local_file  = $fileName;
$remote_file = "koder/åbningskoder.txt"; 

$ftp = ftp_connect($ftp_server);

$login_result = ftp_login($ftp, $ftp_user_name, $ftp_user_pass);

ftp_put($ftp, $remote_file, $local_file);
ftp_close($ftp);

?>