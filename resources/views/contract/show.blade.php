<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h1>Shartnoma Detallari</h1>
    <p><strong>Shartnoma turi:</strong> {{ $contract->type }}</p>
    <p><strong>Ismi:</strong> {{ $contract->first_name ?? $contract->company_name }}</p>
    <p><strong>Qo'shimcha ma'lumot:</strong> {{ $contract->additional_info }}</p>
    <a href="{{ route('contract.index') }}" class="btn btn-primary">Orqaga</a>
</div>

</body>
</html>
