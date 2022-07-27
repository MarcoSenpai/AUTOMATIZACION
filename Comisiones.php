<!DOCTYPE html>
<html>

<head>
    <title>Automatización</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/body-comisiones.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
</head>

<body>
    <main class="contenido">
        <div class="main--menu">
            <div class="user-admin">
                <img src="../img/icon-user.png" alt="">
                <h3>User</h3>
            </div>
            <ul class="nav--items">
                <li class="menu--item">
                    <a href="<?php echo base_url() ?>/biblioteca/public/" class="nav--item">Carga Horaria</a>
                </li>
                <li class="menu--item">
                    <a href="<?php echo base_url() ?>/biblioteca/public/profesores" class="nav--item">Profesores</a>
                </li>
                <li class="menu--item">
                    <a href="#" class="nav--item">Fichas docentes</a>
                </li>
                <li class="menu--item">
                    <a href="<?php echo base_url() ?>/biblioteca/public/Comisiones" class="nav--item">Comisiones</a>
                </li>
                <!--   <li class="menu--item">
          <a href="#" class="nav--item">Organismos</a>
        </li>
        <li class="menu--item">
          <a href="#" class="nav--item">Sub Comisiones</a>
        </li> -->
            </ul>
        </div>
        <div class="container">
            <?php
            $conn = new mysqli("localhost", "root", "", "bd_pruebas");
            ?>
            <div class="organizar">
                <div class="tablaorganizar">
                    <div class="orgComision">
                        <h3>Comision</h3>
                        <ul id="sortableComision">
                            <li class="ocultar"></li>
                        </ul>
                    </div>
                    <div class="orgSubComision">
                        <h3>Sub Comision</h3>
                        <ul id="sortableSubComision">
                        <li class="ocultar"></li>

                            
                        </ul>
                    </div>
                    <div class="orgCargos">
                        <h3>Cargos</h3>
                        <ul id="sortableCargo">
                        <li class="ocultar"></li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="seleccionar">
                <div class="comisiones">
                    <div class="tablacomisiones">
                        
                            <h3>Comision</h3>
                                <ul>
                                <?php
                                $sqlcomisiones = $conn->query("SELECT NOMBRE_COMISION FROM comisiones");
                                while ($comision = $sqlcomisiones->fetch_array()) {
                                    echo '
                                    <li class="letra dragComision">' . $comision['NOMBRE_COMISION'] . '</li>
                                    ';
                                }
                                ?>
                                </ul>
                    </div>

                </div>
                <div class="subcomisiones">
                    <div class="tablaSubcomisiones">
                        <h3>Sub Comision</h3>
                        <ul>
                            
                                <?php
                                $sqlSubcomisiones = $conn->query("SELECT NOMBRE_SUB_COMISION FROM sub_comision");
                                while ($Subcomision = $sqlSubcomisiones->fetch_array()) {
                                    echo '
                                    <li class="letra dragSubComision">' . $Subcomision['NOMBRE_SUB_COMISION'] . '</li>
                                    
                                    ';
                                }
                                ?>
                        </ul>
                    </div>

                </div>
                <div class="cargos">
                    <div class="tablacargos">
                        <h3>Cargos</h3>
                        <ul>

                                <?php
                                $sqlcargos = $conn->query("SELECT NOMBRE_CARGO FROM cargos");
                                while ($cargos = $sqlcargos->fetch_array()) {
                                    echo '
                                    
                                    <li class="letra dragCargo">' . $cargos['NOMBRE_CARGO'] . '</li>
                                    
                                    ';
                                }
                                ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </main>
    <footer>
        <p>OTIC FIIS</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">
       $(document).ready(function() {
            $('#sortableComision').sortable();
            $('#sortableSubComision').sortable();
            $('#sortableCargo').sortable();
            $('.dragComision').draggable({
                connectToSortable:"#sortableComision",
                cursor:"move",
                helper:"clone",
                revert:"invalid"
            });
            $('.dragSubComision').draggable({
                connectToSortable:"#sortableSubComision",
                cursor:"move",
                helper:"clone",
                revert:"invalid"
            });
            $('.dragCargo').draggable({
                connectToSortable:"#sortableCargo",
                cursor:"move",
                helper:"clone",
                revert:"invalid"
            });
        });
    </script>
</html>