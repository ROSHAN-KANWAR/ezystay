<!DOCTYPE html>
<html>
<head>
    <title>Guest Documents - Booking #{{ $booking->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .booking-info { margin-bottom: 30px; }
        .guest-section { margin-bottom: 40px; page-break-after: always; }
        .document-row { display: flex; margin-bottom: 20px; }
        .document-info { flex: 1; }
        .document-image { flex: 1; text-align: center; }
        img { max-width: 100%; max-height: 200px; border: 1px solid #ddd; }
        .footer { margin-top: 50px; font-size: 0.8em; text-align: center; }
        @media print {
            .no-print { display: none; }
            body { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Guest Documents</h2>
        <h3>Booking #{{ $booking->booking_id }}</h3>
    </div>

    @foreach($documents as $guestName => $guestDocs)
    <div class="guest-section">
        <h4>Guest: {{ $guestName }}</h4>
        
      <?php
      echo "<pre>";
print_r($guestDocs);

?>
    </div>
    @endforeach

    <div class="footer">
        <p>Printed on: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 30px;">
        <button onclick="window.print()" class="btn btn-primary">Print Documents</button>
    </div>
</body>
</html>