<!DOCTYPE html>
<html>
<head>
    <title>New Form Submission</title>
    <style>
        body {
            font-family: 'Avenir', 'Montserrat', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .header {
            background-color: oklch(55.66% 0.21 19.69deg); /* Primary color */
            padding: 20px;
            text-align: center;
            color: white;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .footer {
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            background-color: oklch(55.66% 0.21 19.69deg);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>VS Forms</h1>
    </div>

    <div class="content">
        <h2>New Submission Received</h2>
        <p>You have received a new submission for your form: <strong>{{ $form->title }}</strong></p>

        <p>View the full submission details by clicking the button below:</p>

        <a href="{{ $url }}" class="button">View Submission</a>

        <p>This information has been securely stored in your VS Forms account.</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} VS Forms by Voyager Social AI - Empowering travel professionals with intelligent tools</p>
        <p>If you have any questions, please contact our support team at support@voyagersocial.ai</p>
    </div>
</body>
</html>
