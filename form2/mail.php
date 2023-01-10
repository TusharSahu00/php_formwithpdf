<?php
$filenameee = $_FILES['file']['name'];
$fileName = $_FILES['file']['tmp_name'];
$name = $_POST['name'];
$email = $_POST['email'];
$Enquiry_subject = $_POST['subject'];
$usermessage = $_POST['message'];


// $message = '<html><body>';
// $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
// $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
// $message .= "<tr style='background: #eee;'><td><strong>SurName:</strong> </td><td>" . $surname . "</td></tr>";
// $message .= "<tr><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
// $message .= "<tr><td><strong>Subject:</strong> </td><td>" . $Enquiry_subject . "</td></tr>";
// $message .= "<tr><td><strong>Message:</strong> </td><td>" . $usermessage . "</td></tr>";
// $message .= "</table>";
// $message .= "</body></html>";

 $message = "Name = " . $name . "\r\n  Email = " . $email . "\r\n Subject = " . $Enquiry_subject . "\r\n  Message =" . $usermessage;

$subject = "Enquiry From Website Form";
$fromname = "HS Corporation";
$fromemail = 'info@shreekrishnaresidency.co.in'; //if u dont have an email create one on your cpanel
$mailto = 'sahutushar538@gmail.com'; //the email which u want to recv this email
$content = file_get_contents($fileName);
$content = chunk_split(base64_encode($content));
// a random hash will be necessary to send mixed content
$separator = md5(time());
// carriage return type (RFC)
$eol = "\r\n";
// main header (multipart mandatory)
$headers = "From: " . $fromname . " <" . $fromemail . ">" . $eol;
$headers .= "MIME-Version: 1.0" . $eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
$headers .= "This is a MIME encoded message." . $eol;
// message
$body = "--" . $separator . $eol;
$body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
$body .= "Content-Transfer-Encoding: 8bit" . $eol;
$body .= $message . $eol;
// attachment
$body .= "--" . $separator . $eol;
$body .= "Content-Type: application/octet-stream; name=\"" . $filenameee . "\"" . $eol;
$body .= "Content-Transfer-Encoding: base64" . $eol;
$body .= "Content-Disposition: attachment" . $eol;
$body .= $content . $eol;
$body .= "--" . $separator . "--";
//SEND Mail
if (mail($mailto, $subject, $body, $headers)) {
  ?>
  <script language="javascript" type="text/javascript">  // do what you want after sending the email
    alert('Thank you for the message. We will contact you shortly.');
    window.location = 'index.html';
  </script>
  <?php


} else {
  ?>
  <script language="javascript" type="text/javascript">
    alert('Message failed. Please, send an email to HRcooperation.com');
  </script>
  <?php
}
header('Location: index.html');
?>