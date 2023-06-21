<!DOCTYPE html>
<html>
<head>
    <title>Bem-vindo ao nosso site</title>
    <style>
        /* Estilos personalizados */
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #666666;
            margin-bottom: 10px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 3px;
        }
        .button:hover {
            background-color: #0056b3;
        }

        .btn_link {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .btn_link a {
            color: #fff;
            background-color: rgb(10, 126, 227);
            padding: 5px 23px;
            text-decoration: none;
            text-transform: uppercase;
        }

        div#img_logo {
            width: 165px;
            height: 68px;
        }

        #img_logo img {
            width: 100%;
            height: auto;
        }

    </style>
</head>
<body>
<div class="container">
    <div id="img_logo">
        <img src="{{ asset('img/logo.webp') }}" alt="">
    </div>
    <h1>Bem-vindo!</h1>
    <p>Olá, <strong>{{ $data['name'] }}</strong>!</p>
    <p>Seja bem-vindo ao nosso sistema. Agradecemos por se juntar a nós.</p>

    <footer>
        <div class="btn_link">
            <a href="{{ config('app.vexpenses_url') }}">Acessar nosso site</a>
        </div>
    </footer>
</div>
</body>
</html>
