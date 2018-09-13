<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    {{ get_title() }}
    {{ stylesheet_link('css/bootstrap.min.css') }}
    {{ stylesheet_link('css/main.css') }}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your invoices">
    <meta name="Raite" content="Time Tracking System">
</head>
<body>
{{ content() }}
{{ javascript_include('js/jquery.min.js') }}
{{ javascript_include('js/bootstrap.min.js') }}
{{ javascript_include('js/utils.js') }}
{{ javascript_include('js/scripts.js') }}
</body>
</html>
