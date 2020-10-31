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
<p>We have received a request for a data extract. If you did not make this request, please contact us at <a href="mailto:hi@covidvault.com.au">hi@covidvault.com.au</a> immediately to report the data breach. Otherwise, please see the attached CSV file with your requested data extract.</p>
<p>Remember, to avoid a visitor warning from being displayed on your check-in screen, make sure to reply to this email with evidence of the data request from the relevant state health authority. If we do not hear from you within 24 hours, the advisory warning will be added to your account.</p>
<p>Thank you for using <a href="https://www.covidvault.com.au/">CovidVault</a> for the storage of your patron data for the purposes of contact tracing.</p>
<p>Kind regards, <br /></p>
<p>Sam<br />
<a href="https://www.simpleprogramming.com.au/">Simple Programming</a> is proudly made in North Melbourne, Australia.</p>
</body>
</html>

--[UID]
Content-Type: text/csv; name="extract.csv"
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename="extract.csv"

[B64CSV]

--[UID]--
CONTENT;