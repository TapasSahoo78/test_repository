<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .header {
            text-align: center;
            font-weight: bold;
        }

        .left-align {
            text-align: left;
        }

        p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <table>
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
                <td colspan="8" class="left-align">1</td>
            </tr>
            <tr>
                <td colspan="8" class="left-align">3</td>
            </tr>
            <tr>
                <td colspan="8" class="left-align">3</td>
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
                <td>1</td>
                <td>50</td>
                <td colspan="2">2222</td>
                <td colspan="2">3333</td>
                <td>1</td>
            </tr>
            <tr>
                <td>1</td>
                <td>50</td>
                <td colspan="2">2222</td>
                <td colspan="2">3333</td>
                <td>2</td>
            </tr>
        </tbody>
    </table>

</body>

</html>