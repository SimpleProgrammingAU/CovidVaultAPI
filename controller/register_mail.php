<?php
$to = $query_email;
$subject = "CovidVault registration details for $query_name";
$from = "covid.register@simpleprogramming.com.au";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=unicode' . "\r\n";
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
$content = <<<CONTENT
<html>
<head>
</head>
<body lang=EN-AU link="#0563C1" vlink="#954F72" style='tab-interval:36.0pt'>
<div class=WordSection1>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Hello {$query_contact},</span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'></span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Thank you
for using CovidVault for the storage of your patron data for the purposes of
contact tracing.</span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'></span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>You are
now ready to go!</span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'></span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>You will
receive your business’ short URL (eg: <a href="http://b.link/SPAU">http://b.link/SPAU</a>)
within the next 24 hours. In the meantime, your customers can start using your
QR code to submit their contact details.</span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'></span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Please
ensure the details below are accurate:</span></p>
<p class=MsoNormal><b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Account
ID: </span></b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>{$query_id}</span><br />
<b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Business
Name: </span></b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>{$query_name}</span><br />
<b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Business
Address: </span></b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>{$location->address()->getStreetAddress()}, {$location->address()->getSuburb()}, {$location->address()->getState()}, {$location->address()->getPostcode()}.</span><br />
<b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Authorised
Contact: </span></b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>{$query_contact}</span><br />
<b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Contact
Number: </span></b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>{$query_phone}</span></p>
<p class=MsoNormal><b><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>{$query_name} QR Code:</span></b><br />
<span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'><img src="http://chart.googleapis.com/chart?cht=qr&chs=300x300&chld=M&chl=https://www.simpleprogramming.com.au/covid/?id=' . $query_id" alt="QR Code" /></span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>You can add this QR code to the template document available <a href="https://www.simpleprogramming.com.au/covid/templates/Template-Scan.docx">here</a> for your customers to scan upon arriving at your venue.</span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>If you
have a data request (or any questions), you are welcome to contact me via
either of the following methods:</span></p>
<ul style='margin-top:0cm' type=disc>
<li class=MsoListParagraph style='color:#7F7F7F;mso-themecolor:text1;
mso-themetint:128;margin-left:0cm;mso-list:l0 level1 lfo3'><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:VIC'>Email: <a
href="mailto:covid.register@simpleprogramming.com.au">covid.register@simpleprogramming.com.au</a>
or</span></li>
<li class=MsoListParagraph style='color:#7F7F7F;mso-themecolor:text1;
mso-themetint:128;margin-left:0cm;mso-list:l0 level1 lfo3'><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:VIC'>Phone:
0417-227-152</span></li>
</ul>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'></span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>A
business owner portal where you will be able to access customer details for
contact tracing without external assistance will be implemented in the near
future. Due to the sensitive nature of the data being stored, the level of
security must be sufficient prior to releasing such a system.</span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'></span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Cheers</span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'></span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'></span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'>Sam</span></p>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'><a
href="https://www.simpleprogramming.com.au/">Simple Programming</a> is proudly
made in North Melbourne, Australia.</span></p>
</div>
</body>
</html>
CONTENT;

if(!mail($to, $subject, $content, $headers)){
  error_log("Registration email not successfully send to $to.");
}