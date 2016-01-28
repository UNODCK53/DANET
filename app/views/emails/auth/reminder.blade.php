<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
</head>
<body>
  <table style="font-family:arial,helvetica,sans-serif;background-color:#f5f5f5;color:#333333;max-width:700px" align="center" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
      <tr>
        <td width="10px"></td>
        <td>
          <table style="color:#999999;font-size:10px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
              <tr>
                <td height="20">
                </td>
              </tr>
              <tr>
                <td valign="bottom" width="30">
                </td>
                <td valign="bottom">
                  <a style="color:#0192b5;text-decoration:none" href="http://danet.unodc.org.co"_blank">
                  <img style="display:block" src="http://danet.unodc.org.co/assets/img/unodc.png"CToWUd">
                  </a>
                </td>
              </tr>
              <tr>
                <td height="12">
                </td>
              </tr>
            </tbody>
          </table>
          <table align="center" cellpadding="0" cellspacing="0" width="616">
            <tbody>
              <tr>
                <td style="color:#333333;padding:20px;font-size:12px;border-right-color:#eaeae3;border-left-color:#eaeae3;border-right-width:1px;border-left-width:1px;border-right-style:solid;border-left-style:solid;background-color:white" bgcolor="white" width="616">
                  <table align="center" cellpadding="0" cellspacing="0" width="574">
                    <tbody>
                      <tr>
                        <td valign="top" width="470">
                          <span style="font-size:22px;font-weight:bold">Hola</span>
                          <br><br>
                          <div style="font-family:arial,helvetica,sans-serif;font-size:12px;line-height:18px;">
                            Recibimos una solicitud de nueva contraseña.
                            <br><br>
                            Para restaurar/crear la contraseña, complete los campos 
                            del siguiente link: {{ URL::to('password/reset', array($token)) }}<br/><br/>
                            Este link expirará en {{ Config::get('auth.reminder.expire', 60) }} minutos.
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
          <table style="color:#999999;font-size:10px;text-align:left;width:100%" align="center" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td height="10">
                </td>
              </tr>
              <tr>
                <td width="32">
                </td>
                <td style="text-align:left">
                  Unidad de Información – Monitoreo Integrado Desarrollo Alternativo – UNODC <br/>Bogotá - Colombia</p>
                </td>
              </tr>
              <tr>
                <td height="20">
                </td>
              </tr>
            </tbody>
          </table>
        </td>
        <td width="10px">
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>