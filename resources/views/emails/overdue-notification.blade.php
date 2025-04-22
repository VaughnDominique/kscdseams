<!DOCTYPE html>
<html>
<head>
    <title>Overdue Item Notification</title>
</head>
<body>
    <h2>Overdue Item Notification</h2>
    <p>Dear {{ $borrow->fname }} {{ $borrow->lname }},</p>
    
    <p>This is a friendly reminder that you borrowed equipment that was due to be returned on {{ date('F d, Y', strtotime($borrow->dateretured)) }}.</p>
    
    <p><strong>Equipment Details:</strong><br>
    Type: {{ $borrow->equiptype }}<br>
    Quantity: {{ $borrow->equipqty }}</p>
    
    <p>Please return the item as soon as possible to avoid any penalties.</p>
    
    <p>Thank you.</p>
    <p>KSCD Equipment Management System</p>
</body>
</html>
