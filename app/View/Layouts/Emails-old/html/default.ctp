<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buy Main Street U.S.A</title>
<style>
.style1 {
	font-size: 13px;
	color:#666;
}
body{
	margin:0px;
	padding:0px;
	background:#FFF;
}
</style>
</head>

<body>  
<table width="100%" style="font-size: 13px;" cellpadding="0" cellspacing="0">
  <tr valign="top">

    <td>
      <table width="540" height="100%" border="0" cellspacing="0" cellpadding="8" align="center" style="border:1px solid #ccc; border-collapse:collapse;">        
        <tr width="540"   align="center" bgcolor="#f2f7f9">
          <td width="540" height="70" align="left" valign="middle"><a title="Buy Main Street U.S.A" href="<?=$url?>" target="_blank" class="myfooterlink"><img src="<?=$logo?>" alt="" border="0" class="img"/></a></td>
        </tr>
        <tr>
        	<td height="1" style="background:#210472;"></td>
        </tr>
        <tr width="540">
          <td width="540" bgcolor="#f2f7f9" style="padding: 0 20px;">
		  
		  
		  <p></p>
<h1 style="margin: 0pt; font-size: 22px; color:#000;"><font face="Arial"><?=$heading?><br />
</font></h1>
<br />
<br />
<?php echo $this->fetch('content'); ?>
</p>
		  
		  
		  
		  </td>
        </tr>
        <tr width="540">
          <td width="540" align="left" valign="top" style="background:#210472;"><strong><font color="#fff" size="2" face="Arial">Regards,</font></strong><br /><strong><a title="" href="<?=$url?>" target="_blank" style="color:#fff">Buy Main Street U.S.A</a></strong></td>
		</tr>
      </table>
    </td>
  </tr>
</table>
</font>
</body>
</html>



<!--

<table width="70%" cellspacing="0" cellpadding="0" border="0">
    <tbody style="font-weight:bold;">
        <tr>
            <td width="25%" style="font-size: 12px; color: #000;"><font face="Arial, Helvetica, sans-serif">Your Name</font></td>
            <td width="9%">&nbsp;</td>
            <td width="66%" style="font-size: 12px; color: #444;">{Name}</td>
        </tr>
        <tr>
            <td height="5px" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td width="25%" style="font-size: 12px; color: #000;"><font face="Arial, Helvetica, sans-serif"> Sur Name</font></td>
            <td width="9%">&nbsp;</td>
            <td width="66%" style="font-size: 12px; color: #444;">{USER}</td>
        </tr>
        <tr>
            <td height="5px" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-size: 12px; color: #000;"><label>Your Email:</label></td>
            <td>&nbsp;</td>
            <td style="font-size: 12px; color: #444;">{<font face="Arial, Helvetica, sans-serif">Mail</font>}</td>
        </tr>
        <tr>
            <td height="5px" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td width="25%" style="font-size: 12px; color: #000;"><font face="Arial, Helvetica, sans-serif">Date of birth</font></td>
            <td width="9%">&nbsp;</td>
            <td width="66%" style="font-size: 12px; color: #444;">{D.O.B.}</td>
        </tr>
        <tr>
            <td height="5px" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-size: 12px; color: #000;"><label><font face="Arial, Helvetica, sans-serif">Subject</font>:</label></td>
            <td>&nbsp;</td>
            <td style="font-size: 12px; color: #444;">{<font face="Arial, Helvetica, sans-serif">Subject</font>}</td>
        </tr>
        <tr>
            <td height="5px" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-size: 12px; color: #000;"><label><font face="Arial, Helvetica, sans-serif">Your Message:</font></label></td>
            <td>&nbsp;</td>
            <td style="font-size: 12px; color: #444;">{<font face="Arial, Helvetica, sans-serif">Your Message</font>}</td>
        </tr>
        
        <tr>
            <td height="5px" colspan="3">&nbsp;</td>
        </tr>
    </tbody>
</table>

-->


