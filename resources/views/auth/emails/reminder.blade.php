{!! MailVariable::prepareData(str_replace('{{ reset_link }}', $link, '

{{ header }}

<strong>Hello!</strong> <br /><br />

You are receiving this email because we received a password reset request for your account. <br /><br />

<a href="{{ reset_link }}">Reset password</a> <br /><br />

If you did not request a password reset, no further action is required. <br /><br />

Regards, <br />
{{ site_title }}

<hr />

If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: {{ reset_link }}

{{ footer }}

')) !!}
