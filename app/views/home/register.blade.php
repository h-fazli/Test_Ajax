<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body>
<h1>This is Register Form's Up</h1>
<div class="row">
    <div class="col">
        <form id="register" action="/home/register2" method="post">
            <input type="text" name="username" placeholder="username"><br>
            <input type="password" name="password"  placeholder="password"><br>
            <button type="submit">Register</button>
        </form>
    </div>
</div>
<h2>This is Register Form's Bottom</h2>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $('#register').on('submit', function(e) {
        e.preventDefault();
        var details = $('#register').serialize();
        console.log('details',details);
        $.post('/home/register', details, function(dt){
            console.log('dt',dt);
            dt = JSON.parse(dt);
            $('#register').html('Welcome dear ' + dt.username);
        });
    });
</script>
</body>
</html>
