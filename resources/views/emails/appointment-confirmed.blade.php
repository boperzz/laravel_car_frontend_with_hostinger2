<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmed</title>
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
            border-bottom: 2px solid #3b82f6;
        }
        .header h1 {
            color: #3b82f6;
            margin: 0;
            font-size: 24px;
        }
        .icon {
            font-size: 48px;
            color: #10b981;
            margin-bottom: 10px;
        }
        .details {
            background-color: #f9fafb;
            border-left: 4px solid #3b82f6;
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
        .services {
            margin: 20px 0;
        }
        .service-item {
            background-color: #eff6ff;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
            border-left: 3px solid #3b82f6;
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
            background-color: #3b82f6;
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
            <div class="icon">✓</div>
            <h1>Appointment Confirmed!</h1>
            <p>Your appointment has been successfully booked.</p>
        </div>

        <div class="details">
            <div class="detail-row">
                <span class="label">Date & Time:</span>
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
                <span class="value" style="font-weight: bold; color: #10b981;">${{ number_format($appointment->total_price, 2) }}</span>
            </div>
        </div>

        <div class="services">
            <h3 style="color: #111827; margin-bottom: 10px;">Services Scheduled:</h3>
            @foreach($appointment->services as $service)
            <div class="service-item">
                <strong>{{ $service->name }}</strong> - 
                <span>${{ number_format($service->pivot->price, 2) }}</span>
                <span style="color: #6b7280;">({{ $service->duration_minutes }} minutes)</span>
            </div>
            @endforeach
        </div>

        @if($appointment->notes)
        <div style="background-color: #fef3c7; padding: 15px; border-radius: 4px; margin: 20px 0; border-left: 3px solid #f59e0b;">
            <strong>Your Notes:</strong>
            <p style="margin: 5px 0 0 0;">{{ $appointment->notes }}</p>
        </div>
        @endif

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('customer.appointments.show', $appointment) }}" class="button">View Appointment Details</a>
        </div>

        <div class="footer">
            <p>Thank you for choosing Car Maintenance!</p>
            <p>If you need to reschedule or cancel, please visit your dashboard or contact us.</p>
            <p style="margin-top: 15px; font-size: 11px;">
                This is an automated email. Please do not reply directly to this message.
            </p>
        </div>
    </div>
</body>
</html>

