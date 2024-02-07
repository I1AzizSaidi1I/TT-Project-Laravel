<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h1 {
            color: #007bff;
            text-align: center;
        }
        .invoice-details {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
            margin-top: 20px;
        }
        .invoice-details p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invoice</h1>
        <div class="invoice-details">
            <p><strong>Invoice Number:</strong> INV-12345</p>
            <p><strong>Date:</strong> January 31, 2024</p>
            <p><strong>Amount:</strong> $500.00</p>
            <p><strong>Due Date:</strong> February 15, 2024</p>
        </div>
        <p>Dear Customer,</p>
        <p>Thank you for your business. Please find attached the invoice for your recent purchase.</p>
        <p>If you have any questions or concerns regarding this invoice, please feel free to contact us.</p>
        <p>Best regards,<br>Your Company Name</p>
    </div>
</body>
</html>
