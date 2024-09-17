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
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .left-align {
            text-align: left;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th rowspan="2">#</th>
                <th colspan="2">Particular / التفاصيل</th>
                <th colspan="2">Charge / رسوم</th>
            </tr>
            <tr>
                <th>No Of Days Stayed</th>
                <th>Towing Charge</th>
                <th>AED</th>
                <th>Fils</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td class="left-align">No Of Days Stayed</td>
                <td class="left-align">489</td>
                <td>0</td>
            </tr>
            <tr>
                <td>2</td>
                <td class="left-align">Towing Charge</td>
                <td class="left-align">539</td>
                <td>50</td>
            </tr>
            <tr>
                <td colspan="3" class="left-align"><strong>Total</strong></td>
                <td>565</td>
                <td>95</td>
            </tr>
            <tr>
                <td colspan="3" class="left-align"><strong>VAT 5%</strong></td>
                <td>26</td>
                <td>95</td>
            </tr>
            <tr>
                <td colspan="3" class="left-align"><strong>Total Amount</strong></td>
                <td>565</td>
                <td>95</td>
            </tr>
        </tbody>
    </table>
</body>
</html>