<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação</title>
    <!-- Adicione aqui seus estilos CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 40px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        .success-icon {
            color: #28a745;
            font-size: 5em;
            animation: rotateIcon 1s ease infinite;
        }

        .success-message {
            color: #28a745;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        @keyframes rotateIcon {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="fas fa-check-circle success-icon"></i>
        <h2 class="success-message">Pedido de reserva enviado com sucesso!</h2>
        <a href="index.html" class="btn">Voltar para a Página Inicial</a>
    </div>
</body>
</html>
