<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            width: 100%;
        }
        .left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50%;
            height: 100%;
        }
        .logo-empresa {
            width: 60%;
            margin-top: 70px;
        }
        .developer {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: flex-end;
            width: 100%;
            height: 100%;
            margin-top: -20px;
            margin-right: 20px;
        }
        .developer p {
            margin: 0;
            font-size: 16px;
            color: black;
        }
        .logo-desarrollador {
            width: 30%;
            margin-top: 20px;
            margin-right: 15px;
            position: relative;
        }
        .right {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
            height: 100%;
            background-color: #a19e9e;
            color: black;
            flex-direction: column;
            align-items: center;
            margin-top: 5px;
        }
        .titles {
            margin-bottom: 70px; /* adjust the margin to your liking */
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            width: 100%;
            align-items: center;
        }
        label {
            font-size: 20px;
            margin-bottom: 10px;
            width: 80%;
            color: black;
        }
        input[type="text"], input[type="password"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            width: 40%;
            padding: 10px;
            background-color: white;
            color: black;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            box-sizing: border-box;
        }
        button[type="submit"]:hover {
            background-color: #ee7203;
        }
    </style>
</head>
<body>
    <div class="container" class="login-page">
        <div class="left">
            <img src="img/N2.png" alt="Logo Empresa" class="logo-empresa">
            <div class="developer">
                <img src="img/InnovaOrigin2.png" alt="Logo Desarrollador" class="logo-desarrollador">
                <!--<p>Desarrollado by Innovatech Manizales</p> -->
            </div>       
        </div>
        <div class="right">
            <div class="titles">
                <h1>Inicio Sesión</h1>
                <p>Inicie sesión para continuar</p>
            </div>
            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_GET['message']) ?>
                </div>
            <?php endif; ?>
            <form action="peticiones/logincontroller.php" method="post">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
                <button type="submit">Inicio</button>
            </form>
        </div>
    </div>
</body>
</html>
