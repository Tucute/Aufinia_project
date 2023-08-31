<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Send Email</title>
</head>

<body>
  <table border="1" align="center" width="600" style="margin: 0; padding: 0;border-spacing: 0;">
    <tr>
      <td>
        <table cellspacing="0" cellpadding="0" border="0" style="display: block;width: 100%; height: 25%;margin: 0; padding: 0;">
          <tr>
            <td>
              <img width="600" height="150" src="./image/IMAGE_FOR_EMAIL.png" style="display: block;margin: 0; padding: 0;" />
            </td>
          </tr>
        </table>
        <table style="width:100%" cellspacing="0" cellpadding="10" border="0">
          <tr>
            <td>
              <h3>Thank you for purchasing SUPPLIER CHECKER !</h3>
              <hr />
            </td>
          </tr>
          <tr>
            <td>
              <p>Please check below your information:</p>
            </td>
          </tr>
          <tr>
            <td style="width:50%">
              <p>Email: {{email}}</p>
            </td>
            <td style="width:50%">
              <p>Invoice date: {{invoice_date}}</p>
            </td>
          </tr>
          <tr></tr>
          <tr>
            <td colspan="2">
              <table cellspacing="0" cellpadding="5" border="1" style="text-align: center; width:100%">
                <tr>
                  <td>Product name</td>
                  <td>License key</td>
                  <td>Purchase date</td>
                  <td>Valid until</td>
                </tr>
                <tr>
                  <td>SUPPLIER CHECKER</td>
                  <td>{{licensekey}}</td>
                  <td>{{invoice_date}}</td>
                  <td>{{invoice_date}} </td>
                </tr>
              </table>
              <br />
              <hr />
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table cellspacing="0" cellpadding="5" border="0" style="width:100%">
          <tr>
            <td style="width:50%;text-align: right;">
              <p>Click <a href="https://aufinia.com/asap-download">here</a> to download</p>
            </td>
            <td style="width:50%;text-align: left;">
              <img width="100" height="75" src="./image/Supplier-Checker_logo.png" style="display: block" />
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table cellspacing="0" cellpadding="5" border="1" style="text-align: left;width:100%">
          <tr bgcolor="#f0efef">
            <td style="padding: 20px;width:50%;word-break:break-all;">
              <img width="200" src="./image/Aufinia_logo_trans.png" />
            </td>
            <td style="padding: 20px;width:50%">
              Aufinia Consulting<br />
              20 Nguyen Dang Giai, Bao Phu Nu building, district 2 Ho Chi Minh city<br />
              Contact info: cjw@aufinia.com
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <p style="font-size: 10px; padding: 10px;">
                CONFIDENTIALITY NOTICE
                : This message is intended for the use of the individual or entity to which it is addressed and may contain information that is confidential, privileged and exempt from disclosure under applicable law. If the reader of this message is not the intended recipient, you are hereby notified that any printing, copying, dissemination, distribution, disclosure or forwarding of this communication is strictly prohibited.
                If you have received this communication in error, please contact the sender immediately and delete it from your system. Thank You.
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>