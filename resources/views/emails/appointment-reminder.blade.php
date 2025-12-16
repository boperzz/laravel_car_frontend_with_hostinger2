<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Reminder</title>
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
            border-bottom: 2px solid #f59e0b;
        }
        .header h1 {
            color: #f59e0b;
            margin: 0;
            font-size: 24px;
        }
        .icon {
            font-size: 48px;
            color: #f59e0b;
            margin-bottom: 10px;
        }
        .reminder-box {
            background-color: #fef3c7;
            border: 2px solid #f59e0b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            text-align: center;
        }
        .reminder-box h2 {
            color: #92400e;
            margin: 0 0 10px 0;
        }
        .details {
            background-color: #f9fafb;
            border-left: 4px solid #f59e0b;
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
            background-color: #fffbeb;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
            border-left: 3px solid #f59e0b;
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
            background-color: #f59e0b;
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
            <div class="icon">⏰</div>
            <h1>Appointment Reminder</h1>
            <p>Don't forget your upcoming appointment!</p>
        </div>

        <div class="reminder-box">
            <h2>Your Appointment is Tomorrow!</h2>
            <p style="font-size: 18px; margin: 10px 0;">
                <strong>{{ $appointment->appointment_date->format('l, F d, Y') }}</strong>
            </p>
            <p style="font-size: 20px; margin: 5px 0; color: #92400e;">
                <strong>{{ $appointment->appointment_date->format('h:i A') }}</strong>
            </p>
        </div>

        <div class="details">
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
            </div>
            @endforeach
        </div>

        <div style="background-color: #dbeafe; padding: 15px; border-radius: 4px; margin: 20px 0; border-left: 3px solid #3b82f6;">
            <strong>📍 Location:</strong>
            <p style="margin: 5px 0 0 0;">Please arrive 10 minutes before your scheduled appointment time.</p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('customer.appointments.show', $appointment) }}" class="button">View Appointment Details</a>
        </div>

        <div class="footer">
            <p>We look forward to seeing you tomorrow!</p>
            <p>If you need to reschedule or cancel, please visit your dashboard or contact us.</p>
            <p style="margin-top: 15px; font-size: 11px;">
                This is an automated reminder. Please do not reply directly to this message.
            </p>
        </div>
    </div>
</body>
</html>

