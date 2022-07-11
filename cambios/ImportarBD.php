<!DOCTYPE html>
<html>

<head>
  <title>Automatización</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/menu.css">
  <link rel="stylesheet" type="text/css" href="../css/body-carga.css">
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
      <div class="carga">
        <h2><b>Colocar programación horaria</b> </h2>
        <br>
        <form method="post" action="<?php echo base_url('biblioteca/public/Importar/spreadsheet_import_progra_horaria'); ?>" enctype="multipart/form-data">
          <div class="form-group">
            <input type="file" name="upload_file" class="form-control" placeholder="Enter Name" id="upload_file" required>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary">
          </div>
        </form>
      </div>
      <!--   <br>
  <h3>Colocar carga no lectiva</h3>
  <hr>
  <form method="post" action="<?php echo base_url('biblioteca/public/Importar/spreadsheet_import_carga_no_lectiva'); ?>" enctype="multipart/form-data">
    <div class="form-group">
      <input type="file" name="upload_file" class="form-control" placeholder="Enter Name" id="upload_file" required>
    </div>
      <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary">
      </div>
  </form> -->
    </div>

  </main>
  <footer>
    <p>OTIC FIIS</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>