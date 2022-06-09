<!-- PARA INCLUIR LA CABECERA Y PIE DE PAGINA SE VA AL CONTROLADOR libros.php -->
<?=$cabecera?>
<a class="btn btn-success" href="<?=base_url('crear')?>">CREAR LIBRO NUEVO</a>
<br>
<br>
<table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                  <!--es la de $datos['libros'] se le pone el signo $  -->
                <?php foreach($libros as $libro): ?>
                    <tr>
                        <td><?=$libro['id'];?></td> <!-- Imprime la informacion -->
                        <td>
                            <img class="img-thumbnail" src="<?=base_url()?>/uploads/<?=$libro['imagen']?>" 
                            width="100" alt="">    
                        </td>
                        <td><?=$libro['nombre'];?></td>
                        <td>
                            <a href="<?=base_url('editar/'.$libro['id']);?>" class="btn btn-primary" type="button">EDITAR</button>    
                            <a href="<?=base_url('borrar/'.$libro['id']);?>" class="btn btn-danger" type="button">BORRAR</button>    
                        </td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
<?=$pie?>

