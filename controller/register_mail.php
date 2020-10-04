<?php
$to = $query_email;
$subject = "CovidVault registration details for $query_name";
$from = "covid.register@simpleprogramming.com.au";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
$content = <<<CONTENT
<html>
<head>
<style type="text/css">
body {
margin: 1rem;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>
</head>
<body>
<p>Hello {$query_contact},</p>
<p>Thank you for using <a href="https://www.covidvault.com.au/">CovidVault</a> for the storage of your patron data for the purposes of contact tracing.</p>
<p>You are now ready to go!</p>
<p>Please ensure the details below are accurate:
<ul>
<li><b>Account ID</b>: {$query_id}</li>
<li><b>Business Name</b>: {$query_name}</li>
<li><b>Business Address</b>: {$location->address()->getStreetAddress()}, {$location->address()->getSuburb()}, {$location->address()->getState()}, {$location->address()->getPostcode()}</li>
<li><b>Authorised Contact</b>: {$query_contact}</li>
<li><b>Contact Number</b>: {$query_phone}</li>
</ul>
</p>
<p>Visitors will now be able to sign in using either the QR Code or the shortlink below.<br />
{$query_name} QR Code:<br />
<img src="http://chart.googleapis.com/chart?cht=qr&chs=300x300&chld=M&chl=https://www.covidvault.com.au/checkin/?id={$query_id}" />
</p>
<p>{$query_name} short URL:<br />
covidvault.com.au/{$query_shortname}</p>
<p>If you have a check-in kiosk set up at your entrance with a tablet device, use the following URL to enable kiosk mode:
<a href="https://www.covidvault.com.au/checkin/?id={$query_id}&kiosk">https://www.covidvault.com.au/checkin/?id={$query_id}&kiosk</a></p>
<p>To update your account details, please sign in to the <a href="https://www.covidvault.com.au/dashboard">account dashboard</a>.</p>
<p>If you have a data request (or any questions), you are welcome to contact me via either of the following methods:
<ul>
<li>Email: <a href="mailto: covid.register@simpleprogramming.com.au">covid.register@simpleprogramming.com.au</a> or</li>
<li>Phone: <a href="tel:+61390133909">+613 9013 3909</a></li>
</ul>
</p>
<p>CovidVault is free for up to 3,000 API calls per month per business and charged at 0.1 cents per each API call thereafter. Payment details will only be requested upon reaching the requisite usage in a given month. This ensures the application can be sufficiently tested prior to any payment. If you have any questions, please do not hesitate to contact me on the details above.</p>
<p>Kind regards, <br /></p>
<p>Sam<br />
Simple Programming is proudly made in North Melbourne, Australia.</p>
</body>
</html>
CONTENT;

if(!mail($to, $subject, $content, $headers)){
  error_log("Registration email not successfully send to $to.");
}