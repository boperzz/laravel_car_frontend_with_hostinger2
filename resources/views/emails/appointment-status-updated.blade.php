<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Status Updated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #6366f1;
        }
        .header h1 {
            color: #6366f1;
            margin: 0;
            font-size: 24px;
        }
        .status-box {
            text-align: center;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            background-color: 
                @if($appointment->status == 'confirmed') #dbeafe;
                @elseif($appointment->status == 'in_progress') #e9d5ff;
                @elseif($appointment->status == 'completed') #d1fae5;
                @elseif($appointment->status == 'cancelled') #fee2e2;
                @else #f3f4f6;
                @endif
            border: 2px solid 
                @if($appointment->status == 'confirmed') #3b82f6;
                @elseif($appointment->status == 'in_progress') #8b5cf6;
                @elseif($appointment->status == 'completed') #10b981;
                @elseif($appointment->status == 'cancelled') #ef4444;
                @else #6b7280;
                @endif
        }
        .status-box h2 {
            margin: 0;
            color: 
                @if($appointment->status == 'confirmed') #1e40af;
                @elseif($appointment->status == 'in_progress') #6b21a8;
                @elseif($appointment->status == 'completed') #065f46;
                @elseif($appointment->status == 'cancelled') #991b1b;
                @else #374151;
                @endif
        }
        .details {
            background-color: #f9fafb;
            border-left: 4px solid #6366f1;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #6b7280;
        }
        .value {
            color: #111827;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #6366f1;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Appointment Status Updated</h1>
            <p>Your appointment status has been changed.</p>
        </div>

        <div class="status-box">
            <h2>Status: {{ ucfirst($appointment->status) }}</h2>
            <p style="margin: 10px 0 0 0;">
                Changed from <strong>{{ ucfirst($oldStatus) }}</strong> to <strong>{{ ucfirst($appointment->status) }}</strong>
            </p>
        </div>

        <div class="details">
            <div class="detail-row">
                <span class="label">Appointment Date:</span>
                <span class="value">{{ $appointment->appointment_date->format('l, F d, Y') }} at {{ $appointment->appointment_date->format('h:i A') }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Vehicle:</span>
                <span class="value">{{ $appointment->vehicle->full_name }} ({{ $appointment->vehicle->license_plate }})</span>
            </div>
            @if($appointment->staff)
            <div class="detail-row">
                <span class="label">Assigned Staff:</span>
                <span class="value">{{ $appointment->staff->name }}</span>
            </div>
            @endif
            <div class="detail-row">
                <span class="label">Total Amount:</span>
                <span class="value" style="font-weight: bold;">${{ number_format($appointment->total_price, 2) }}</span>
            </div>
        </div>

        @if($appointment->staff_notes)
        <div style="background-color: #e0e7ff; padding: 15px; border-radius: 4px; margin: 20px 0; border-left: 3px solid #6366f1;">
            <strong>Staff Notes:</strong>
            <p style="margin: 5px 0 0 0;">{{ $appointment->staff_notes }}</p>
        </div>
        @endif

        @if($appointment->status == 'completed' && $appointment->service_results)
        <div style="background-color: #d1fae5; padding: 15px; border-radius: 4px; margin: 20px 0; border-left: 3px solid #10b981;">
            <strong>Service Results:</strong>
            <p style="margin: 5px 0 0 0;">{{ $appointment->service_results }}</p>
        </div>
        @endif

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('customer.appointments.show', $appointment) }}" class="button">View Appointment Details</a>
        </div>

        <div class="footer">
            <p>Thank you for choosing Car Maintenance!</p>
            <p>If you have any questions, please contact us or visit your dashboard.</p>
            <p style="margin-top: 15px; font-size: 11px;">
                This is an automated email. Please do not reply directly to this message.
            </p>
        </div>
    </div>
</body>
</html>

