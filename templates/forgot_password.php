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
<p>We have received a request to reset your password. If you did not make this request, please ignore this email. Otherwise, click the link below to reset your password.</p>
<p><a href="[VERIFY_LINK]">[VERIFY_LINK]</a></p>
<p>Thank you for using <a href="https://www.covidvault.com.au/">CovidVault</a> for the storage of your patron data for the purposes of contact tracing.</p>
<p>Kind regards, <br /></p>
<p>Sam<br />
<a href="https://www.simpleprogramming.com.au/">Simple Programming</a> is proudly made in North Melbourne, Australia.</p>
</body>
</html>

--[UID]--
CONTENT;