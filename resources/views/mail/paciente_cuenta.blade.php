
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <style type="text/css">
        * { margin: 0; padding: 0; font-size: 100%; font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        img { max-width: 80%; margin: 0 auto; display: block;}
        body, .body-wrap { width: 100% !important; height: 100%; background: #f8f8f8; }
        a { color: #7367f0; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .button { display: inline-block; color: white; background: #7367f0; border: solid #7367f0; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; }
        .button:hover { text-decoration: none; }
        h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }
        h1 { font-size: 32px; }
        h2 { font-size: 28px; }
        h3 { font-size: 24px; }
        h4 { font-size: 20px; }
        h5 { font-size: 16px; }
        p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }
        .container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important; }
        .container table { width: 100% !important; border-collapse: collapse; }
        .container .masthead { padding: 10px 0; background: #fff; color: white; border-bottom: 3px solid #f2f2f2; border-top: 8px solid #7367f0}
        .container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }
        .container .content { background: white; padding: 30px 35px; }
        .container .content.footer { background: none; }
        .container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }
        .container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }
        .container .content.footer a:hover { text-decoration: underline; }
        .text-email { color: #7367f0; }
        .lista { margin-left: 40px; }
    </style>
</head>
<body>
    <table class="body-wrap">
        <tr>
            <td class="container" style="background-color: #fff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                <table>
                    <tr>
                        <td align="center" class="masthead">
                            <!-- <img src="https://herramientas/img/1583780987.png" alt="logo"> -->
                            <h3 style="color:#7367f0; text-transform: uppercase;">{{$msg['nombre_clinica']}}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <p>Estimado {{$msg['paciente_nombre']}},</p>
                            <p>Adjunto encontrarás la contraseña para acceder al sistema, donde podrás visualizar y hacer seguimiento de la información registrada en la clínica. Utiliza tu correo electrónico proporcionado a la clínica como usuario.</p>
                            
                            <div align="center" style="margin-bottom:10px; padding: 10px; font-style: normal; letter-spacing: normal; color: #673de6; background-color: #f0f0f0; border-radius: 10px; font-size: 20px;">
                                <b>{{$msg['paciente_pass']}}</b>
                            </div>
                            
                            <a class="button" style="color:white;" target="_blank" href="{{$msg['paciente_ruta']}}">Ingresar</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="container">
                <table>
                    <tr>
                        <td class="content footer" align="center">
                            <p>Este correo es generado automáticamente. Por favor, no responda.</p>
                            <b>© RMM asdasd🎉</b>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>

</html>