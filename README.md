<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Design</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        .left-align {
            text-align: left;
        }
        .main-download{
            margin-bottom: 20px !important;
        }
    </style>
</head>

<body>
    <table border="1" class="container" id="invoiceContent">
        <thead>

            <tr>
                <td colspan="8" class="header">
                    <p>
                        AL SAHRAA FREIGHT TRANSPORT AND LOGISTICS L.L.C.<br>
                        الصحراء للنقل والخدمات اللوجستية ذ.م.م<br>
                        Vehicle Impounding Yard Baniyas West<br>
                        ساحة حجز المركبات بني ياس غرب<br>
                        Abu Dhabi
                    </p>
                </td>
            </tr>

            <tr>
                <td style="font-weight: 600;text-align: left;padding-bottom:20px" colspan="8">
                    <div class="text-left">
                        1
                    </div>
                </td>
            </tr>
            <tr>
                <td style="font-weight: 600;text-align: left;padding-bottom:20px" colspan="8">
                    3
                </td>
            </tr>
            <tr></tr>
            <td style="font-weight: 600;text-align: left;padding-bottom:20px" colspan="8">
                3
            </td>
            </tr>



            <tr>
                <th colspan="2">Charge / رسوم</th>
                <th colspan="2" rowspan="2">Charge / رسوم</th>
                <th colspan="2" rowspan="2">Particular / التفاصيل</th>
                <th rowspan="2">#</th>
            </tr>
            <tr>
                <th>Fils</th>
                <th>AED</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>1</th>
                <th>2</th>

                <th colspan="2">2222</th>
                <th colspan="2">3333</th>
                <th>4444</th>

            </tr>
            <tr>
            <tr>
                <th>1</th>
                <th>2</th>

                <th colspan="2">2222</th>
                <th colspan="2">3333</th>
                <th>4444</th>
            </tr>
            </tr>
            <th>1</th>
            <th>2</th>

            <th colspan="2">2222</th>
            <th colspan="2">3333</th>
            <th>4444</th>
            </tr>
        </tbody>
    </table>

    <div class="main-download">
        <center>
            <div class="download">
                <button class="btn btn-primary btn-md" id="printInvoice">Print</button>
                <button class="btn btn-primary btn-md" id="downloadInvoice">Download</button>
            </div>
        </center>
    </div>

</body>

</html>
