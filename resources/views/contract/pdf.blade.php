<!DOCTYPE html>
<html>
<head>
    <title>Shartnoma</title>
</head>
<body>
<h1>ARTOVA KOMPANIYASI BILAN SHARTNOMA</h1>
<p>Shartnoma raqami: {{ $contract->id }}</p>
<p>Shartnoma tuzilgan sana: {{ $contract->contract_date }}</p>

<h2>Tomonlar:</h2>
<p><strong>Ijrochi:</strong> Artova kompaniyasi</p>
<p><strong>Buyurtmachi:</strong> {{ $contract->customer_name }}</p>
<p>Manzil: {{ $contract->customer_address }}</p>
<p>INN: {{ $contract->customer_inn }}</p>
<p>Telefon: {{ $contract->customer_phone }}</p>
</body>
</html>
