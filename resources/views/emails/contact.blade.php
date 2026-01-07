<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form Submission - Hope Foundation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #2c3e50, #e74c3c);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 30px;
        }
        .field-group {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #e74c3c;
        }
        .field-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        .field-value {
            color: #555;
            font-size: 16px;
        }
        .message-box {
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-top: 10px;
            white-space: pre-line;
        }
        .email-footer {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .inquiry-badge {
            display: inline-block;
            background: #f39c12;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>📧 New Contact Form Submission</h1>
            <p style="margin: 10px 0 0; opacity: 0.9;">Hope Foundation Website</p>
        </div>
        
        <div class="email-body">
            <p style="font-size: 16px; margin-bottom: 25px;">
                You have received a new message through the Hope Foundation contact form.
            </p>

            <div class="field-group">
                <div class="field-label">From</div>
                <div class="field-value"><strong>{{ $name }}</strong></div>
            </div>

            <div class="field-group">
                <div class="field-label">Email Address</div>
                <div class="field-value">
                    <a href="mailto:{{ $email }}" style="color: #e74c3c; text-decoration: none;">{{ $email }}</a>
                </div>
            </div>

            @if($phone)
            <div class="field-group">
                <div class="field-label">Phone Number</div>
                <div class="field-value">
                    <a href="tel:{{ $phone }}" style="color: #e74c3c; text-decoration: none;">{{ $phone }}</a>
                </div>
            </div>
            @endif

            <div class="field-group">
                <div class="field-label">Inquiry Type</div>
                <div class="field-value">
                    <span class="inquiry-badge">{{ ucwords(str_replace('_', ' ', $inquiry_type)) }}</span>
                </div>
            </div>

            <div class="field-group">
                <div class="field-label">Subject</div>
                <div class="field-value"><strong>{{ $subject }}</strong></div>
            </div>

            <div class="field-group">
                <div class="field-label">Message</div>
                <div class="message-box">{{ $message }}</div>
            </div>

            <hr style="margin: 30px 0; border: none; height: 1px; background: #dee2e6;">
            
            <p style="font-size: 14px; color: #6c757d; margin: 0;">
                <strong>Submitted:</strong> {{ now()->format('F j, Y \a\t g:i A T') }}<br>
                <strong>IP Address:</strong> {{ request()->ip() }}
            </p>
        </div>

        <div class="email-footer">
            <p style="margin: 0;">
                Hope Foundation | Making a Difference Together<br>
                <small>This email was automatically generated from the contact form on hopefoundation.org</small>
            </p>
        </div>
    </div>
</body>
</html>
