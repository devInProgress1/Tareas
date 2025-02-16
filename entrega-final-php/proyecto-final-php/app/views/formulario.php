<hr>
<form method="POST" enctype="multipart/form-data">

    <?php if($_GET["orden"]=="Modificar"): ?>            
        <img src="<?= file_exists($image)? $image:'https://robohash.org/'.$cli->id;?>" alt="Foto de usuario" width="300" height="150">
        <label for="id">Id:</label>
        <input type="text" name="id" readonly value="<?= $cli->id ?>">
    <?php endif; ?>

    <label for="first_name">Nombre:</label>
    <input type="text" id="first_name" name="first_name" value="<?= isset($_POST['first_name'])?$_POST['first_name']:$cli->first_name; ?>">

    <label for="last_name">Apellido:</label>
    <input type="text" id="last_name" name="last_name" value="<?= isset($_POST['last_name'])?$_POST['last_name']:$cli->last_name; ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= isset($_POST['email'])?$_POST['email']:$cli->email; ?>">

    <label for="gender">Género:</label>
    <input type="text" id="gender" name="gender" value="<?= isset($_POST['gender'])?$_POST['gender']:$cli->gender; ?>">

    <label for="ip_address">Dirección IP:</label>
    <input type="text" id="ip_address" name="ip_address" value="<?= isset($_POST['ip_address'])?$_POST['ip_address']:$cli->ip_address; ?>">
    
    <?php if(isset($flag)):?>
    <?php if($flag == false): ?>
    <p>Ip sin pais asociado</p>
    <?php else:?>
    <label for="">Ubicacion: <?= htmlspecialchars($flag[1])?></label>
    <img src="<?= htmlspecialchars($flag[0])?>" alt="" width="100" height="60">
    <?php endif;?>
    <?php endif; ?>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" value="<?= isset($_POST['telefono'])?$_POST['telefono']:$cli->telefono; ?>">


    <input type="submit" name="orden" value="<?= $orden ?>">
    <input type="submit" name="orden" value="Volver">
    <br><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
    <label>Elija el archivo a subir</label> <input type="file" name="profileImage"  accept="image/.jpg, image/.png"/>
    <?php if($_GET["orden"]=="Modificar"):?>
    <br><br>
    <button type="submit" name="nav-detalles" value="siguiente">siguente</button>
    <button type="submit" name="nav-detalles" value="anterior">anterior</button>
    <?php endif; ?>
</form>