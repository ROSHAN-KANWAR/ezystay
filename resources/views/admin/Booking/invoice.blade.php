<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Invoice Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        .hotel-name {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .hotel-tagline {
            font-style: italic;
            margin-bottom: 10px;
        }
        .hotel-info {
            margin-bottom: 5px;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .customer-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
        }
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature-box {
            width: 200px;
            border-top: 1px solid #000;
            text-align: center;
            padding-top: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-style: italic;
        }
        @media print {
            body {
                padding: 0;
                font-size: 13px;
            }
            .no-print {
                display: none;
            }
        }
        h4{
            text-align: center;
            margin-top: 20px;
            font-style: italic;
            background:red;  
            padding:2px 0;
            color:white;
        }
    </style>
</head>
<body>
    <div class="header">
    
        <div class="hotel-name">EzyStay HOTEL & RESTAURANT</div>
        <div class="hotel-tagline">The Book Your Best Room</div>
        <div class="hotel-info">TP Nagar Korba (C.G)</div>
        <div class="hotel-info">Contact: 9001254887</div>
        <div class="hotel-info">Reg.No.: 078041/MKS/BSS/2521 | GST No.: 22BDKD555D5DSX</div>
    </div>
    <h4 id="bill" >{{strtoupper($booking->status)}} BILL</h4>
    <div class="invoice-details">
        <div>
            <strong>Invoice Number:</strong> {{$booking->booking_id}}<br>
            <strong>Date:</strong> {{$today}}
        </div>
        <div>
            <strong>Room No.:</strong>  {{$booking->room->room_no}}<br>
            <strong>Customer ID:</strong> Not Available
        </div>
    </div>

    <div class="customer-info">
        <div><strong>Mr./Mrs:</strong> {{strtoupper($booking->name)}}</div>

        <div><strong>Address:</strong>  {{strtoupper($booking->address)}} | <strong>Ph.:</strong> {{strtoupper($booking->phone)}}</div>
        <div>
            <strong>Arrival Date:</strong>  {{$booking->created_at->toDateString()}}| <strong>Time:</strong> {{$booking->created_at->format('H:i:s')}}<br>
            <strong>Departure Date:</strong> {{$booking->check_out_date}}| <strong>Time:</strong> {{$booking->updated_at->format('H:i:s')}}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. of Days</th>
                <th>Particular</th>
                <th>CGST</th>
                <th>SGST</th>
                <th>Amount (in ₹)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$booking->no_of_nights}}</td>
                <td>{{strtoupper($booking->room->type)}} - {{$booking->room->price}}</td>
                <td>6%</td>
                <td>6%</td>
                <td>{{$total}}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>CGST Applied<br>{{$cgst}}</td>
                <td>SGST Applied<br>{{$sgst}}</td>
                <td></td>
            </tr>
            <tr class="total-row">
                <td colspan="4">Total Amount</td>
                <td>{{$total}} - {{strtoupper($booking->payment_mode)}}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature-area">
        <div class="signature-box">
            Signature of Authorized Person<br>
           EztStay
        </div>
        <div class="signature-box">
            Receiver's Signature
        </div>
    </div>

    <div class="footer">
        THANK YOU....VISIT AGAIN....<br>
        www.ezystay.in
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 8px 15px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Print Invoice
        </button>
        <a href="{{route('bookinglist')}}">   <button  style="padding: 8px 15px; background:blue; color: white; border: none; border-radius: 4px; cursor: pointer;">
          Back Home
        </button></a>
    </div>
</body>
</html>