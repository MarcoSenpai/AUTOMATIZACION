<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ImportarExcel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Importar extends Controller{
    public function _construct(){
        parent::_construct();
        
    }
public function index(){
    return view('ExcelPruebas/ImportarBD');
    $this->load->model('ImportarExcel');
}
public function spreadsheet_import_progra_horaria(){
    $mysqli = mysqli_connect("localhost","root","","bd_pruebas");
    $upload_file = $_FILES['upload_file']['name'];
    $extension = pathinfo($upload_file,PATHINFO_EXTENSION);
    if($extension=='csv'){
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    }else if ($extension=='xls'){
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();

    }else if($extension=='xlsx'){
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
    $spreadsheet=$reader->load($_FILES['upload_file']['tmp_name']);
    $sheetdata=$spreadsheet->getActiveSheet()->toArray();
    echo "<pre>";
    print_r($sheetdata);
    echo "<pre>";
    $sheetCount= count($sheetdata);
    print $sheetCount;
    if($sheetCount>1){
        for ($i=1; $i < $sheetCount; $i++) { 
            $ciclo_curso=$sheetdata[$i][0];
            $codigo_curso=$sheetdata[$i][1];
        $nombre_curso=$sheetdata[$i][2];
        $escuela_profesional=$sheetdata[$i][14];
        $plan_estudios= $sheetdata[$i][3];
        $sql_curso= "REPLACE INTO cursos (ID_CURSO, NOM_CURSO, ESCUELA_PROFESIONAL, PLAN_ESTUDIOS, CICLO) VALUES ('$codigo_curso','$nombre_curso','$escuela_profesional','$plan_estudios','$ciclo_curso')";
        $mysqli->query($sql_curso);
        }
        for ($i=1; $i < $sheetCount; $i++) { 
            $codigo_docente=$sheetdata[$i][4];
            $nombre_docente=$sheetdata[$i][5];
            $sede_docente=$sheetdata[$i][16];
            $sql_docente= "REPLACE INTO docentes (ID_DOCENTE, APELLIDOS_NOMBRES, SEDE) VALUES ('$codigo_docente','$nombre_docente','$sede_docente')";
            $mysqli->query($sql_docente);
          }
          for ($i=1; $i < $sheetCount; $i++) { 
            $codigo_curso_detalle=$sheetdata[$i][1];
            $estado_curso=$sheetdata[$i][15];
            $cupos_curso=$sheetdata[$i][13];
            $codigo_docente_detalle=$sheetdata[$i][4];
            $codigo_tipo_detalle=$sheetdata[$i][12];
            $seccion_curso=$sheetdata[$i][6];
            $hora_inicial=$sheetdata[$i][8];
            $hora_final=$sheetdata[$i][9];
            $dias_curso=$sheetdata[$i][7];

            $sql_detalles_curso= "INSERT INTO detalle_cursos (ID_CURSO, ESTADO, CUPOS_CURSO, ID_DOCENTE, ID_TIPO, SECCION_CURSO, HORA_INICIAL, HORA_FINAL, DIAS_CURSO) VALUES ('$codigo_curso_detalle','$estado_curso','$cupos_curso','$codigo_docente_detalle','$codigo_tipo_detalle','$seccion_curso','$hora_inicial','$hora_final','$dias_curso')";
            $mysqli->query($sql_detalles_curso);
        }
    }
    
}
public function spreadsheet_import_carga_no_lectiva(){
    $mysqli = mysqli_connect("localhost","root","","bd_pruebas");
    $upload_file = $_FILES['upload_file']['name'];
    $extension = pathinfo($upload_file,PATHINFO_EXTENSION);
    if($extension=='csv'){
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    }else if ($extension=='xls'){
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();

    }else if($extension=='xlsx'){
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
    $spreadsheet=$reader->load($_FILES['upload_file']['tmp_name']);
    $sheetdata=$spreadsheet->getActiveSheet()->toArray();
    echo "<pre>";
    print_r($sheetdata);
    echo "<pre>";
    $sheetCount= count($sheetdata);
    print $sheetCount;
    $j=1;
    if($sheetCount>1){
        for ($i=1; $i < $sheetCount; $i++) 
            { 
                if($j>0 && $j<=9)
                {
                    $codigo_player='P000'. $j;
                }
                else if($j>=10 && $j<=99)
                {
                    $codigo_player='P00'. $j;
                }else
                {
                    $codigo_player='P0'. $j;
                }
                $nick_player=$sheetdata[$i][0];
                $rol_player=$sheetdata[$i][1];
                $team_player=$sheetdata[$i][2];
                $region_player=$sheetdata[$i][3];
                $sql_verificar_player=mysqli_query($mysqli,"SELECT * FROM jugadores where NICK_PLAYER='$nick_player'");
                    if(mysqli_num_rows($sql_verificar_player)>0){
                        continue;
                    }
                    else{
                            $sql_player="INSERT INTO jugadores (ID_PLAYER,NICK_PLAYER,ROL,TEAM,REGION) VALUES ('$codigo_player','$nick_player','$rol_player','$team_player','$region_player')";
                            $mysqli->query($sql_player);
                            $j=$j+1;
                        } 

            } 
        }

     /*    for ($i=1; $i < $sheetCount; $i++) { 
        $codigo_organismo=$sheetdata[$i][0];
        $nombre_organismo=$sheetdata[$i][1];
        $sql_organismo= "REPLACE INTO organismos (ID_ORGANISMO, NOMBRE_ORGANISMOS) VALUES ('$codigo_organismo','$nombre_organismo')";
        $mysqli->query($sql_organismo);
        }
        for ($i=1; $i < $sheetCount; $i++) { 
        $nombre_comision=$sheetdata[$i][2];
        $codigo_organismo_comision=$sheetdata[$i][0];
        $sql_comisiones= "REPLACE INTO comisiones (NOMBRE_COMISION,ID_ORGANISMO) VALUES ('$nombre_comision','$codigo_organismo_comision')";
        $mysqli->query($sql_comisiones);
        }
        for ($i=1; $i < $sheetCount; $i++) { 
        $nombre_cargo=$sheetdata[$i][6];
        $sql_cargo= "REPLACE INTO cargos (NOMBRE_CARGO) VALUES ('$nombre_cargo')";
        $mysqli->query($sql_cargo);
        }
        for ($i=1; $i < $sheetCount; $i++) { 
        $nombre_subcomision=$sheetdata[$i][4];
        $sql_subcomision= "REPLACE INTO sub_comision (NOMBRE_SUB_COMISION) VALUES ('$nombre_subcomision')";
        $mysqli->query($sql_subcomision);
        } */
      /*   for ($i=1; $i < $sheetCount; $i++) { 
            $nombre_docente=$sheetdata[$i][5];
            $codigo_cargo=$sheetdata[$i][5];
            $sede_docente=$sheetdata[$i][16];
            $sql_detalles_docente= "INSERT INTO detalles_comision (ID_DOCENTE) values (select ID_DOCENTE from docentes where APELLIDOS_NOMBRES = '$nombre_docente')";
            $mysqli->query($sql_docente);
          } */
         /*  for ($i=1; $i < $sheetCount; $i++) { 
              $codigo_curso_detalle=$sheetdata[$i][1];
            $estado_curso=$sheetdata[$i][15];
            $cupos_curso=$sheetdata[$i][13];
            $codigo_docente_detalle=$sheetdata[$i][4];
            $codigo_tipo_detalle=$sheetdata[$i][12];
            $seccion_curso=$sheetdata[$i][6];
            $hora_inicial=$sheetdata[$i][8];
            $hora_final=$sheetdata[$i][9];
            $dias_curso=$sheetdata[$i][7];
            
            $sql_detalles_curso= "INSERT INTO detalle_cursos (ID_CURSO, ESTADO, CUPOS_CURSO, ID_DOCENTE, ID_TIPO, SECCION_CURSO, HORA_INICIAL, HORA_FINAL, DIAS_CURSO) VALUES ('$codigo_curso_detalle','$estado_curso','$cupos_curso','$codigo_docente_detalle','$codigo_tipo_detalle','$seccion_curso','$hora_inicial','$hora_final','$dias_curso')";
            $mysqli->query($sql_detalles_curso);
          } */
    }
    
}
/* public function spreadsheet_borrar(){
    $mysqli = mysqli_connect("localhost","root","","bd_pruebas");
    $sql = "DELETE FROM dinosaurios";
    $mysqli->query($sql);
    alter table nombre_de_la_tabla AUTO_INCREMENT=1; // este es para resetear el auto incremento de la tabla detalle cursos y detalle comisiones
 */
