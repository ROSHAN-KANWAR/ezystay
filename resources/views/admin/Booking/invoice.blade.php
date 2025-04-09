<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Invoice Bill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .invoice-container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #e0e0e0;
        }
        .hotel-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #2c3e50;
        }
        .hotel-tagline {
            font-style: italic;
            margin-bottom: 10px;
            color: #7f8c8d;
        }
        .hotel-info {
            margin-bottom: 5px;
            color: #555;
        }
        .invoice-title {
            text-align: center;
            margin: 20px 0;
            padding: 8px 0;
            background-color: #dc3545;
            color: white;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .customer-info {
            margin-bottom: 25px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        th {
            background-color: #343a40;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border: 1px solid #e0e0e0;
        }
        .total-row {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature-box {
            width: 45%;
            border-top: 1px solid #000;
            text-align: center;
            padding-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-style: italic;
            color: #7f8c8d;
        }
        .action-buttons {
            text-align: center;
            margin-top: 30px;
        }
        .btn-print {
            background-color: #28a745;
        }
        .btn-back {
            background-color: #007bff;
        }
        @media print {
            body {
                padding: 0;
                background-color: white;
            }
            .no-print {
                display: none;
            }
            .invoice-container {
                box-shadow: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <div class="hotel-name">EzyStay HOTEL & RESTAURANT</div>
            <div class="hotel-tagline">The Book Your Best Room</div>
            <div class="hotel-info">TP Nagar Korba (C.G)</div>
            <div class="hotel-info">Contact: 9001254887</div>
            <div class="hotel-info">Reg.No.: 078041/MKS/BSS/2521 | GST No.: 22BDKD555D5DSX</div>
        </div>
        
        <div class="invoice-title">{{strtoupper($booking->status)}} BILL</div>
        
        <div class="invoice-details">
            <div>
                <strong>Invoice Number:</strong> {{$booking->booking_id}}<br>
                <strong>Date:</strong> {{$today}}
            </div>
            <div>
                <strong>Room No.:</strong> {{$booking->room->room_no}}<br>
                <strong>Customer ID:</strong> Not Available
            </div>
        </div>

        <div class="customer-info">
            <div><strong>Mr./Mrs:</strong> {{strtoupper($booking->name)}}</div>
            <div><strong>Address:</strong> {{strtoupper($booking->address)}} | <strong>Ph.:</strong> {{strtoupper($booking->phone)}}</div>
            <div>
                <strong>Arrival Date:</strong> {{$booking->created_at->toDateString()}} | <strong>Time:</strong> {{$booking->expected_checkin_time}}<br>
                <strong>Departure Date:</strong> {{$booking->check_out_date}} | <strong>Time:</strong> {{$booking->updated_at->format('H:i:s')}}
            </div>
        </div>

        <table class="table">
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
                    <td>{{$booking->tax_amount + $booking->subtotal +  $booking->extra_charges}}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                   
                    <td>CGST & SGST Applied<br>{{$booking->tax_amount}}</td>
                    <td colspan="2">
                        Advance - {{$booking->advance_payment}}
                    </td>
 
                </tr>
                <tr class="total-row">
                    <td colspan="4">Total Amount</td>
                    <td>{{$total}} - {{strtoupper($booking->payment_status)}}</td>
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

        <div class="action-buttons no-print">
            <button onclick="window.print()" class="btn bg-success text-white me-2">
                Print Invoice
            </button>
            <a href="{{route('bookinglist')}}" class="btn bg-primary">
                Back Home
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>