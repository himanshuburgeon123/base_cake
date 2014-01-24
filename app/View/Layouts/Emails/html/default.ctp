<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Datanomers</title>
</head>

<body>
<table bgcolor="#FFF" width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">
  <tr>
    <td align="center">
    	<table width="700" bgcolor="#efebef" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #cccccc;">
          <tr>
            <td style="padding:10px 0 10px 0; text-align:center;"><img src="<?=Configure::read('Site.logo');?>" alt="" /></td>
          </tr>
          <tr>
            <td bgcolor="#004F78" style="padding:8px; color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:16px;"><strong>Welcome to Datanomers</strong></td>
          </tr>
          <tr>
            <td bgcolor="#fff">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:0px; color:#000; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:24px;">
					<?php echo $this->fetch('content'); ?>
				</table>

            </td>
          </tr>
          <tr>
            <td bgcolor="#E8E8E8"><strong style="color:#000;">Regards :-<br /><a href="<?=Configure::read('Site.url');?>" style="color:#004F78; line-height:22px;" target="_blank"><?=Configure::read('Site.site_name');?></a></strong></td>
          </tr>
        </table>
    </td>
  </tr>
</table>
</body>
</html>
