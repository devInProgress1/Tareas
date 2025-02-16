<?php if($_SESSION['rol']==1):?>
<form>
    <button type="submit" name="orden" value="Nuevo"> Cliente Nuevo </button><br>
</form>
<br>
<?php endif;?>
<table>
    <thead>
        <tr>
        <th><button onclick="location.href='?order_by=id'">ID</th>
        <th><button onclick="location.href='?order_by=first_name'">First Name</th>
        <th><button onclick="location.href='?order_by=email'">Email</th>
        <th><button onclick="location.href='?order_by=gender'">Gender</th>
        <th><button onclick="location.href='?order_by=ip_address'">IP Address</th>
        <th><button onclick="location.href='?order_by=telefono'">Teléfono</th>
        <th colspan="3" ></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tclientes as $cli): ?>
            <tr>
                <td><?= $cli->id ?> </td>
                <td><?= $cli->first_name ?> </td>
                <td><?= $cli->email ?> </td>
                <td><?= $cli->gender ?> </td>
                <td><?= $cli->ip_address ?> </td>
                <td><?= $cli->telefono ?> </td>
                <?php if($_SESSION['rol']==1):?>
                <td><a href="#" onclick="confirmarBorrar('<?= $cli->first_name ?>','<?= $cli->id ?>');">Borrar</a></td>
                <td><a href="?orden=Modificar&id=<?= $cli->id ?>">Modificar</a></td>
                <?php endif;?>
                <td><a href="?orden=Detalles&id=<?= $cli->id ?>">Detalles</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<form>
    <button name="nav" value="Primero"> << </button>
    <button name="nav" value="Anterior"> < </button>
    <button name="nav" value="Siguiente"> > </button>
    <button name="nav" value="Ultimo"> >> </button>
</form>