<hr>
<button onclick="location.href='./'"> Volver </button>
<br><br>
<?php isset($_SESSION['msg'])??''?>
<form action="">
    <table>
        <tr>
            <?php $image = "app/uploads/".getImageName($cli->id)?>
            
            <td rowspan="9"><img src="<?= file_exists($image)? $image:'https://robohash.org/'.$cli->id;?>" alt="Foto de usuario"  width="300" height="300"></td>
        </tr>
        <tr>
            <td>id:</td>
            <td><input type="number" name="id" value="<?= $cli->id ?>" readonly> </td>
            <td rowspan="7">
                <img src=""></img>
            </td>
        </tr>
        <tr>
            <td>first_name:</td>
            <td><input type="text" name="first_name" value="<?= $cli->first_name ?>" readonly> </td>
        </tr>
        </tr>
        <tr>
            <td>last_name:</td>
            <td><input type="text" name="last_name" value="<?= $cli->last_name ?>" readonly></td>
        </tr>
        </tr>
        <tr>
            <td>email:</td>
            <td><input type="email" name="email" value="<?= $cli->email ?>" readonly></td>
        </tr>
        </tr>
        <tr>
            <td>gender</td>
            <td><input type="text" name="gender" value="<?= $cli->gender ?>" readonly></td>
        </tr>
        </tr>
        <tr>
            <td>ip_address:</td>
            <td><input type="text" name="ip_address" value="<?= $cli->ip_address ?>" readonly></td>
        </tr>
        <tr>    
            <?php if($flag == false): ?>
            <td>Ip sin pais asociado</td><td></td>
            <?php else:?>
            <td>Ubicacion: <?= htmlspecialchars($flag[1])?></td>
            <td><img src="<?= htmlspecialchars($flag[0])?>" alt="" width="100" height="60"></td>
            <?php endif;?>
        </tr>
        </tr>
        <tr>
            <td>telefono:</td>
            <td><input type="tel" name="telefono" value="<?= $cli->telefono ?>" readonly></td>
        </tr>
        </tr>
    </table>
        <button type="submit" name="nav-detalles" value="siguiente">siguente</button>
        <button type="submit" name="nav-detalles" value="anterior">anterior</button>
</form>