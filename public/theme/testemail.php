<?php
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	if ($_REQUEST['txt_email'] == ""){
	} 
	else {
	 		try{
					$to = $_POST["txt_email"];// "smartsanz@gmail.com"; //"sanket.solanki@in2ideas.com";
					$from = "no-reply@curatingcars.com";
					
					$subject = "CC - Email test";
					
					$message = "Hi,<br><br> This is test email";
					$message .= "Thank you.<br>";
					$headers  = "From: ".$from."\r\n";
					$headers .= "Content-type: text/html\r\n";
					//options to send to cc+bcc
					//$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
					//$headers .= "Bcc: [email]email@maaking.cXom[/email]";
					// now lets send the email.
					$success = mail($to, $subject, $message, $headers);
					if ($success) {
						echo "Mail has been sent!";
						// redirect to thank you page here
					}
					else {
						echo "Message failed";
					}
				}
				catch(Exception $ex){ echo $ex; }
	}
}
?>
<html>
	<form action="" method="post">
    <input placeholder="Email" type="text" name="txt_email"  width="200" /> &nbsp;
    <input type="submit" value="Send" />
    </form>
</html>