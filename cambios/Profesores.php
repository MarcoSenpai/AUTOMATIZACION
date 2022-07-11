<!DOCTYPE html>
<html>

<head>
    <title>Automatización</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/body-profesores.css">
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
                    <a href="#" class="nav--item">Comisiones</a>
                </li>
                <li class="menu--item">
                    <a href="#" class="nav--item">Organismos</a>
                </li>
                <li class="menu--item">
                    <a href="#" class="nav--item">Sub Comisiones</a>
                </li>
            </ul>
        </div>
        <div class="container">
            <h2>Profesores</h2>
            <div class="profesores">
                <form method="POST" action="<?php echo base_url('biblioteca/importar/mostrarProfesores'); ?>">
                    <div class="form-group">
                        <input type="text" class=" form-control" placeholder="Nombre del profesor" name="lista_profesores" id="lista_profesores" enctype="multipart/form-data">
                    </div>
                    <div class="tablaProfesores">
                        <table class="table table-hover table-stripped table-bordered" ">
                            <thead>
                                <tr>
                                    <td>Id docente</td>
                                    <td>Apellidos y Nombres</td>
                                    <td>sede</td>
                                    <td>No lectiva</td>
                                    <td>Ficha</td>
                                    <td>Descarga</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conn = new mysqli("localhost", "root", "", "bd_pruebas_2");
                                $sql = $conn->query("SELECT ID_DOCENTE, APELLIDOS_NOMBRES, SEDE , FICHA FROM docentes");
                                while ($data = $sql->fetch_array()) {
                                    if ($data['FICHA'] == 'SI') {
                                        $download = 'download-si';
                                        $checkficha = 'check-ficha-si';
                                        echo '
                                            <tr>
                                            <td>' . $data['ID_DOCENTE'] . '</td>
                                            <td>' . $data['APELLIDOS_NOMBRES'] . '</td>
                                            <td>' . $data['SEDE'] . '</td>
                                            <td><button>No lectiva</button></td>
                                            <td><button class="' . $checkficha . '"></button></td>
                                            <td><button class="' . $download . '"></button></td>
                                            </tr>
                                            ';
                                    } else {
                                        $download = 'download-no';
                                        $checkficha = 'check-ficha-no';
                                        echo '
                                            <tr>
                                            <td>' . $data['ID_DOCENTE'] . '</td>
                                            <td>' . $data['APELLIDOS_NOMBRES'] . '</td>
                                            <td>' . $data['SEDE'] . '</td>
                                            <td><button>No lectiva</button></td>
                                            <td><button class="' . $checkficha . '"></button></td>
                                            <td><button class="' . $download . '" disabled></button></td>
                                            </tr>
                                            ';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class=" form-group">
                            <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('table tbody').sortable();
        });
    </script>
</body>

</html>