<?php
$message = $_REQUEST['message'] ;
ini_set("SMTP", "stmp.gre.ac.uk");
ini_set ("sendmail_from", "you@gre.ac.uk");
mail("you@gre.ac.uk", "the subject - testing e-mail connection", $message);
echo "This worked !";
?>