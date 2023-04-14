<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <title>Mail Content</title>
</head>
<body>
    <div class="emailContainer">
        <nav><img src="/img/default-img-dark.png" alt=""></nav>
        <div class="content">
            <img src="/img/undraw_export_files_re_99ar.svg" alt="">
            <div class="body">
            <h4>Hey {{auth()->user()->fname}},</h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Here is the PDF you requested!</p>
            <a href="http://system-admin.herokuapp.com/export">Click me to download file</a>
            <h5>From Team F2P</h5>
        </div>
        </div>
    </div>
</body>
</html>