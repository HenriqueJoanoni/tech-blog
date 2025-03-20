<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechBlog Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #2563eb;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            padding: 20px;
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            background-color: #2563eb;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #666;
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        TechBlog
    </div>
    <div class="content">
        <h2>Hello, {{ $details['name'] }} 👋</h2>
        {!! $details['message'] !!}
        <p>Stay updated with the latest in tech by visiting our website.</p>
        <div class="button-container">
            <a href="http://localhost:8000" class="button">Visit TechBlog</a>
        </div>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} TechBlog. All rights reserved.
    </div>
</div>
</body>
</html>
