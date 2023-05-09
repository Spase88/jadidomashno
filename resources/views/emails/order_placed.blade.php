<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        p {
            margin: 0 0 10px;
        }
        
        .order-details {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .order-details h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .order-details p {
            margin-bottom: 5px;
        }
        
        .thank-you {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Нова нарачка!</h1>
        
        <div class="order-details">
            <h2>Детали за нарачката:</h2>
            <p><strong>Рецепт:</strong> {{ $recipeName }}</p>
            <p><strong>Количина:</strong> {{ $quantity }}</p>
            <p><strong>Цена:</strong> {{ $price }}</p>
        </div>
        
        <div class="thank-you">
            <p>Проверете го вашиот дашборд за повеќе информации!</p>
        </div>
    </div>
</body>
</html>
