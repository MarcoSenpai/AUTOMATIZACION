<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ImportarExcel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Importar extends Controller
{
    public function index()
    {
        return view('ImportarBD');
        $this->load->model('ImportarExcel');
    }
    public function Profesores()
    {
        return view('Profesores');
    }
    public function Comisiones()
    {
        return view('Comisiones');
    }
    public function spreadsheet_import_progra_horaria()
    {
        $mysqli = mysqli_connect("localhost", "root", "", "bd_pruebas_2");
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
        if ($extension == 'csv') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else if ($extension == 'xls') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else if ($extension == 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        $sheetdata = $spreadsheet->getActiveSheet()->toArray();
        $sheetCount = count($sheetdata);
        print $sheetCount;
        if ($sheetCount > 1) {
            $sqlCodigo_detalle = "ALTER TABLE DETALLE_CURSOS AUTO_INCREMENT = 1";
            $mysqli->query($sqlCodigo_detalle);
            for ($i = 1; $i < $sheetCount; $i++) {
                $ciclo_curso = $sheetdata[$i][0];
                $codigo_curso = $sheetdata[$i][1];
                $nombre_curso = $sheetdata[$i][2];
                $escuela_profesional = $sheetdata[$i][14];
                $plan_estudios = $sheetdata[$i][3];
                $sql_curso = "REPLACE INTO cursos (ID_CURSO, NOM_CURSO, ESCUELA_PROFESIONAL, PLAN_ESTUDIOS, CICLO) VALUES ('$codigo_curso','$nombre_curso','$escuela_profesional','$plan_estudios','$ciclo_curso')";
                $mysqli->query($sql_curso);
            }
            for ($i = 1; $i < $sheetCount; $i++) {
                $codigo_docente = $sheetdata[$i][4];
                $nombre_docente = $sheetdata[$i][5];
                $sede_docente = $sheetdata[$i][16];
                $sql_docente = "REPLACE INTO docentes (ID_DOCENTE, APELLIDOS_NOMBRES, SEDE) VALUES ('$codigo_docente','$nombre_docente','$sede_docente')";
                $mysqli->query($sql_docente);
            }
            for ($i = 1; $i < $sheetCount; $i++) {
                $codigo_curso_detalle = $sheetdata[$i][1];
                $estado_curso = $sheetdata[$i][15];
                $cupos_curso = $sheetdata[$i][13];
                $codigo_docente_detalle = $sheetdata[$i][4];
                $codigo_tipo_detalle = $sheetdata[$i][12];
                $seccion_curso = $sheetdata[$i][6];
                $hora_inicial = $sheetdata[$i][8];
                $hora_final = $sheetdata[$i][9];
                $duracion = $sheetdata[$i][10];
                $dias_curso = $sheetdata[$i][7];

                $sql_detalles_curso = "INSERT INTO detalle_cursos (ID_CURSO, ESTADO, CUPOS_CURSO, ID_DOCENTE, ID_TIPO, SECCION_CURSO, HORA_INICIAL, HORA_FINAL,DURACION ,DIAS_CURSO) VALUES ('$codigo_curso_detalle','$estado_curso','$cupos_curso','$codigo_docente_detalle','$codigo_tipo_detalle','$seccion_curso','$hora_inicial','$hora_final','$duracion','$dias_curso')";
                $mysqli->query($sql_detalles_curso);
            }
        }
        return redirect()->to(base_url() . '/biblioteca/public');
    }
    public function spreadsheet_import_carga_no_lectiva()
    {
        $mysqli = mysqli_connect("localhost", "root", "", "bd_pruebas_2");
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
        if ($extension == 'csv') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else if ($extension == 'xls') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else if ($extension == 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        $sheetdata = $spreadsheet->getActiveSheet()->toArray();
        echo "<pre>";
        print_r($sheetdata);
        echo "<pre>";
        $sheetCount = count($sheetdata);
        print $sheetCount;
        $countComision = 1;
        $countCargo = 1;
        $countSubComision = 1;
        if ($sheetCount > 1) {
            for ($i = 1; $i < $sheetCount; $i++) {
                $codigo_organismo = $sheetdata[$i][0];
                $nombre_organismo = $sheetdata[$i][1];
                $sql_organismo = "REPLACE INTO organismos (ID_ORGANISMO, NOMBRE_ORGANISMOS) VALUES ('$codigo_organismo','$nombre_organismo')";
                $mysqli->query($sql_organismo);
            }
            for ($i = 1; $i < $sheetCount; $i++) {
                if ($countComision > 0 && $countComision <= 9) {
                    $codComision = 'C000' . $countComision;
                } else if ($countComision >= 10 && $countComision <= 99) {
                    $codComision = 'C00' . $countComision;
                } else {
                    $codComision = 'C0' . $countComision;
                }
                $nombre_comision = $sheetdata[$i][2];
                $codigo_organismo_comision = $sheetdata[$i][0];
                $sql_verificar_comision = mysqli_query($mysqli, "SELECT * FROM comisiones where NOMBRE_COMISION ='$nombre_comision'");
                if (mysqli_num_rows($sql_verificar_comision) > 0) {
                    continue;
                } else {
                    $sql_comisiones = "INSERT INTO comisiones (ID_COMISION,NOMBRE_COMISION,ID_ORGANISMO) VALUES ('$codComision','$nombre_comision','$codigo_organismo_comision')";
                    $mysqli->query($sql_comisiones);
                    $countComision = $countComision + 1;
                }
            }
            for ($i = 1; $i < $sheetCount; $i++) {
                if ($countCargo > 0 && $countCargo <= 9) {
                    $codCargo = 'CA00' . $countCargo;
                } else if ($countCargo >= 10 && $countCargo <= 99) {
                    $codCargo = 'CA0' . $countCargo;
                } else {
                    $codCargo = 'CA' . $countCargo;
                }
                $nombre_cargo = $sheetdata[$i][6];
                $sql_verificar_cargos = mysqli_query($mysqli, "SELECT * FROM cargos where NOMBRE_CARGO ='$nombre_cargo'");
                if (mysqli_num_rows($sql_verificar_cargos) > 0) {
                    continue;
                } else {
                    $sql_cargos = "INSERT INTO cargos (ID_CARGO,NOMBRE_CARGO) VALUES ('$codCargo','$nombre_cargo')";
                    $mysqli->query($sql_cargos);
                    $countCargo = $countCargo + 1;
                }
            }
            for ($i = 1; $i < $sheetCount; $i++) {
                if ($countSubComision > 0 && $countSubComision <= 9) {
                    $codSubComision = 'S000' . $countSubComision;
                } else if ($countSubComision >= 10 && $countSubComision <= 99) {
                    $codSubComision = 'S00' . $countSubComision;
                } else {
                    $codSubComision = 'S0' . $countSubComision;
                }
                $nombre_SubComision = $sheetdata[$i][3];
                $sql_verificar_subcomisiones = mysqli_query($mysqli, "SELECT * FROM sub_comision where NOMBRE_SUB_COMISION ='$nombre_SubComision'");
                if (mysqli_num_rows($sql_verificar_subcomisiones) > 0) {
                    continue;
                } else {
                    $sql_sub_comision = "INSERT INTO sub_comision (ID_SUB_COMISION,NOMBRE_SUB_COMISION) VALUES ('$codSubComision','$nombre_SubComision')";
                    $mysqli->query($sql_sub_comision);
                    $countSubComision = $countSubComision + 1;
                }
            }
        }
    }
    public function mostrarProfesores()
    {
        $mysqli = mysqli_connect("localhost", "root", "", "bd_pruebas_2");
    }
}

/* public function spreadsheet_borrar(){
    $mysqli = mysqli_connect("localhost","root","","bd_pruebas");
    $sql = "DELETE FROM dinosaurios";
    $mysqli->query($sql);
    alter table nombre_de_la_tabla AUTO_INCREMENT=1; // este es para resetear el auto incremento de la tabla detalle cursos y detalle comisiones
 */
