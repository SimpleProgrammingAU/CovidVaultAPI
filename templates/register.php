<?php
$mail_template = <<<CONTENT
--[UID]
Content-Type: text/html; charset="UTF-8"
Content-Transfer-Encoding: 8bit

<html>
<head>
<meta charset="utf-8" />
<style type="text/css">
body {
margin: 1rem;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>
</head>
<body>
<p>Hello [CONTACT_NAME],</p>
<p>Thank you for using <a href="https://www.covidvault.com.au/">CovidVault</a> for the storage of your patron data for the purposes of contact tracing.</p>
<p>You are almost ready to go!</p>
<p>Please verify your account at <a href="[VERIFY_LINK]">[VERIFY_LINK]</a>
<p>Please ensure the details below are accurate:
<ul>
<li><b>Account ID</b>: [ACCOUNT_ID]</li>
<li><b>Business Name</b>: [BUSINESS_NAME]</li>
<li><b>Business Address</b>: [BUSINESS_ADDRESS]</li>
<li><b>Authorised Contact</b>: [CONTACT_NAME]</li>
<li><b>Contact Number</b>: [CONTACT_PHONE]</li>
</ul>
</p>
<p>Visitors will now be able to sign in using either the QR Code or the shortlink below.<br />
[BUSINESS_NAME] QR Code:<br />
<img src="http://chart.googleapis.com/chart?cht=qr&chs=300x300&chld=M&chl=https://www.covidvault.com.au/checkin/?id=[ACCOUNT_ID]" />
</p>
<p>[BUSINESS_NAME] short URL:<br />
covidvault.com.au/[SHORTNAME]</p>
<p>If you have a check-in kiosk set up at your entrance with a tablet device, use the following URL to enable kiosk mode:
<a href="https://www.covidvault.com.au/checkin/?id=[ACCOUNT_ID]&kiosk">https://www.covidvault.com.au/checkin/?id=[ACCOUNT_ID]&kiosk</a></p>
<p>To update your account details, please sign in to the <a href="https://www.covidvault.com.au/dashboard">account dashboard</a>.</p>
<p>If you need printable templates for your QR Codes, please see the <a href="https://www.covidvault.com.au/faq.html">CovidVault FAQ</a>.</p>
<p>If you have a data request (or any questions), you are welcome to contact me via either of the following methods:
<ul>
<li>Email: <a href="mailto: covid.register@simpleprogramming.com.au">covid.register@simpleprogramming.com.au</a> or</li>
<li>Phone: <a href="tel:+61390133909">+613 9013 3909</a></li>
</ul>
</p>
<p>CovidVault is free for up to 5,000 API calls per month per business and charged at $0.01 per each API call thereafter. Payment details will only be requested upon reaching the requisite usage in a given month. This ensures the application can be sufficiently tested prior to any payment. If you have any questions, please do not hesitate to contact me on the details above.</p>
<p>Kind regards, <br /></p>
<p>Sam<br />
<a href="https://www.simpleprogramming.com.au/">Simple Programming</a> is proudly made in North Melbourne, Australia.</p>
</body>
</html>

--[UID]--
CONTENT;