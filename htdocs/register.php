<?php
include "header.php";
?>
<form action = "register_entry.php" method = "post">
<table width = "100%">
<tr>
<td width = "50%">
<p>Login ID:<input type = "text" name = "name"></p>
<p>Password:<input type = "password" name = "password"></p>
<input class = "login" type = "submit" value = "Sign Up">
</td>
<td style = "border-left:groove #938048 2px;vertical-align:top;">
Type a desired user name in Login ID and set your password in Password box.
<br/>
<hr/>
<br/>
Note: This may take sometime after you submit form.ie. click on sign up.
</td>
</tr>
</table>
</form>
<?php
include "footer.php";
?>
