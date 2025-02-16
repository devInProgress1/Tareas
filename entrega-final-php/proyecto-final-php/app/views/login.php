<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD CLIENTES</title>
<link href="web/css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>
<div id="container" style="width: 950px;">
<div id="header">
<h1>MIS CLIENTES CRUD versión 1.0</h1>
</div>
<div id="aviso">
<?= $msg ?>
</div>
<div id="content">
<form method="post">
    <table>
        <tr>
            <td>Login</td>
            <td><input type="text" name="login" id=""></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="passwd" id=""></td>
        </tr>

    </table>
    
    <input type="submit" value="Iniciar sesión">
</form>
</div>
</div>
</body>
</html>
<?php exit(); ?>