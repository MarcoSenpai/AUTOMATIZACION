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
                    <a href="<?php echo base_url() ?>/biblioteca/public/Profesores" class="nav--item">Profesores</a>
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
            $conn = new mysqli("localhost", "root", "", "bd_pruebas_2");
            ?>
            <div class="organizar">
                <div class="tablaorganizar">
                    <table class="table table-hover table-stripped table-bordered">
                        <thead>
                            <tr>
                                <td>Comision</td>
                                <td>Sub Comision</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="seleccionar">
                <div class="comisiones">
                    <div class="tablacomisiones">
                        <table class="table table-hover table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <td>Comision</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sqlcomisiones = $conn->query("SELECT NOMBRE_COMISION FROM comisiones");
                                while ($comision = $sqlcomisiones->fetch_array()) {
                                    echo '
                                    <tr>
                                    <td class="letra">' . $comision['NOMBRE_COMISION'] . '</td>
                                    </tr>
                                    ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="subcomisiones">
                    <div class="tablaSubcomisiones">
                        <table class="table table-hover table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <td>Sub Comision</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sqlSubcomisiones = $conn->query("SELECT NOMBRE_SUB_COMISION FROM sub_comision");
                                while ($Subcomision = $sqlSubcomisiones->fetch_array()) {
                                    echo '
                                    <tr>
                                    <td class="letra">' . $Subcomision['NOMBRE_SUB_COMISION'] . '</td>
                                    </tr>
                                    ';
                                }
                                ?>
                            </tbody>
                        </table>
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

</html>