<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
</head>
<body>
    <div id="app" data-page="{{ json_encode($page) }}">
        <welcome :description="{{ json_encode($services) }}" :about="{{ json_encode($about) }}" :testimonialsuf="{{ json_encode($depoimentos) }}" :address="{{ json_encode($address) }}" :phone="{{ json_encode($phone) }}" :email="{{ json_encode($email) }}" />
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
