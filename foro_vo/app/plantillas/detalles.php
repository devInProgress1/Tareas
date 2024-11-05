<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen($_REQUEST['comentario']) ?></td></tr>
<tr><td>Nº de palabras:    </td><td><?=wordCount($_REQUEST['comentario'])?></td></tr>
<tr><td>Letra + repetida:  </td><td><?=mostRepeatedLetter($_REQUEST['comentario'])?></td></tr>
<tr><td>Palabra + repetida:</td><td><?=mostRepeatedWord($_REQUEST['comentario'])?></td></tr>
</table>
</div>

