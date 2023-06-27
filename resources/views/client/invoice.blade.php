<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #FF6161;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
               <!-- <img src="/images/Lengkuas_Logo_1.svg" alt="LG Logo" style="width:180px;height:45px;"> -->
                    <h2 class="text-start">INVOICE</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #{{ $order->id }}</span> <br>
                    <span>Date: {{ date('d/m/Y') }}</span> <br>
                    <span>Zip code : 68100</span> <br>
                    <span>Address: Lot 1521, Selangor, Jalan 2, Taman Selayang Baru, Batu Caves, Selangor</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">Client Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>PO No.:</td>
                <td>{{ $order->PONo }}</td>

                <td>Full Name:</td>
                <td>{{ $order->getClient->buyerCorrespondentOrName }}</td>
            </tr>
            <tr>
                <td>Issued Date:</td>
                <td>{{ $order->IssuedDate }}</td>

                <td>Authorization Code:</td>
                <td>{{ $order->getClient->authorizationCodeOrName }}</td>
            </tr>
            <tr>
                <td>Delivery Date:</td>
                <td>{{ $order->deliveryDateETA }}</td>

                <td>Buyer Section Code / Name:</td>
                <td>{{ $order->getClient->buyerSectionCodeOrName }}</td>
            </tr>
            <tr>
                <td>Reference Date/ETD:</td>
                <td>{{ $order->referenceDateETD }}</td>

                <td>Address:</td>
                <td>{{ $order->getClient->buyerAddress }}</td>
            </tr>
            <tr>
                <td>Currency Code:</td>
                <td colspan="3">{{ $order->currencyCode }}</td>
            </tr>
            <tr>
                <td>Payment Term:</td>
                <td colspan="3">{{ $order->paymentTerm }}</td>
            </tr>
            <tr>
                <td>Remarks:</td>
                <td colspan="3">{{ $order->remark }}</td>
            </tr>
            <tr>
                <td>Comment:</td>
                <td colspan="3">{{ $order->comment }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>Line No</th>
                <th>Part No</th>
                <th>Part Label</th>
                <th>Sales Unit Price Basis (UOM)</th>
                <th>Quantity Per Package (UOM)</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10%">{{ $order->lineNo }}</td>
                <td width="10%">{{ $order->partNo }}</td>
                <td>{{ $order->partDescription }}</td>
                <td>{{ $order->salesUnitPriceBasisUOM }}</td>
                <td>{{ $order->quantityPerPackageUOM }}</td>
                <td width="10%">{{ $order->getDesign->unitPrice }}</td>
                <td width="10%">{{ $order->quantity }}</td>
            </tr>
            
            <tr>
                <td colspan="6" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                <td colspan="1" class="total-heading">{{ $order->amount }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with Lengkuas Grafik Sdn Bhd
    </p>

</body>
</html>