<?php
include "header.php";
?>
<form action = "validate.php" method = "post">
<table width = "100%">
<tr>
<td width = "50%">
<p><span width = "250px">Login ID:</span><input type = "text" name = "name"></p>
<p><span width = "250px">Password:</span><input type = "password" name = "password"></p>
<input class = "login" type = "submit" value = "Login">
</td>
<td style = "border-left:groove #938048 2px;vertical-align:top;">
Sign Up to get started.<br/><br/>
<a href = "register.php"><input class = "login" value = "Sign up" type = "button"></a>
</td>
</tr>
</table>
</form>
<?php
include "footer.php";
?>
