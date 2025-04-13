<!DOCTYPE html>
<html>
<head>
    <title>Booking Documents - #{{ $booking->booking_id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .guest-section { 
            margin-bottom: 40px; 
            page-break-inside: avoid;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
        .guest-name { 
            background: #f5f5f5; 
            padding: 10px; 
            margin-bottom: 15px;
            border-radius: 3px;
        }
        .documents-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        .document-container {
            flex: 1;
            min-width: 300px;
            border: 1px solid #eee;
            padding: 10px;
            border-radius: 3px;
        }
        .document-image-container {
            text-align: center;
            margin-bottom: 10px;
        }
        .document-image {
            max-width: 100%;
            max-height: 300px;
            height: auto;
            object-fit: contain;
        }
        .document-pdf {
            width: 100%;
            height: 400px;
            border: none;
        }
        .document-title {
            font-weight: bold;
            margin-bottom: 5px;
            text-align: center;
        }
        .document-type {
            color: #666;
            font-size: 0.9em;
            text-align: center;
        }
        .action-buttons {
            text-align: center;
            margin: 20px 0;
        }
        .print-button {
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .print-button:hover {
            background: #45a049;
        }
        @media print {
            .action-buttons {
                display: none;
            }
            body {
                margin: 0;
                padding: 0;
            }
            .guest-section {
                border: none;
                padding: 0;
            }
            .document-image {
                max-height: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Booking Documents</h1>
        <h2>Booking ID: #{{ $booking->booking_id }}</h2>
    </div>

    <div class="action-buttons">
        <button class="print-button" onclick="window.print()">Print All Documents</button>
    </div>

    @foreach($documents as $guestName => $guestDocs)
        <div class="guest-section">
            <div class="guest-name">
                <h2>Guest: {{ $guestName }}</h2>
            </div>
            
            <div class="documents-row">
                @php
                    $frontDoc = $guestDocs->firstWhere('side', 'front');
                    $backDoc = $guestDocs->firstWhere('side', 'back');
                @endphp
                
                <!-- Front Document -->
                <div class="document-container">
                    <div class="document-title">Front Side</div>
                    <div class="document-type">{{ $frontDoc->document_type }}</div>
                    <div class="document-image-container">
                        @if(pathinfo($frontDoc->file_path, PATHINFO_EXTENSION) === 'pdf')
                            <embed src="{{ asset($frontDoc->file_path) }}" 
                                   class="document-pdf" 
                                   type="application/pdf">
                        @else
                            <img src="{{ asset($frontDoc->file_path) }}" 
                                 class="document-image"
                                 alt="Front side document">
                        @endif
                    </div>
                </div>
                
                <!-- Back Document (if exists) -->
                @if($backDoc)
                    <div class="document-container">
                        <div class="document-title">Back Side</div>
                        <div class="document-type">{{ $backDoc->document_type }}</div>
                        <div class="document-image-container">
                            @if(pathinfo($backDoc->file_path, PATHINFO_EXTENSION) === 'pdf')
                                <embed src="{{ asset($backDoc->file_path) }}" 
                                       class="document-pdf" 
                                       type="application/pdf">
                            @else
                                <img src="{{ asset($backDoc->file_path) }}" 
                                     class="document-image"
                                     alt="Back side document">
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

    <div class="action-buttons" style="margin-top: 30px;">
        <button class="print-button" onclick="window.print()">Print All Documents</button>
    </div>
</body>
</html>