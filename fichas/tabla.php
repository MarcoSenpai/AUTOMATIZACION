<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h2>Ficha profesores</h2>
<table>
<tr>
    <th colspan= 4>I. Actividades Academicas</th>
    <th colspan=3>Horas</th>
    <th rowspan=2>Escuela <br>Profesional</th>
    <th rowspan=2>Fecha <br>Inicio</th>
    <th rowspan=2>Local</th>
    <th rowspan=2>Horas <br>Semanales</th>
    <th rowspan=2>Horas<br> Semestrales</th>
    <th rowspan=2>Lunes</th>
    <th rowspan=2>Martes</th>
    <th rowspan=2>Miercoles</th>
    <th rowspan=2>Jueves</th>
    <th rowspan=2>Viernes</th>
    <th rowspan=2>Sabado</th>
</tr>
<tr>
    <td ROWSPAN=6>1.1 Labores <br>Lectivas</td>
    <td>COD.ASIG.</td>
    <td>G.H</td>
    <td>Asignatura</td>
    <td>T</td>
    <td>P</td>
    <td>L</td>
</tr>
<?php 
$conn = new mysqli("localhost:3306", "root", "", "bd_pruebas");
$sqlProfesor = $conn->query("SELECT ID_DOCENTE FROM DOCENTES WHERE APELLIDOS_NOMBRES='CASAZOLA CRUZ DANIEL OSWALDO'");
$idp = $sqlProfesor->fetch_array();
$idProfesor = $idp['ID_DOCENTE'];
$sqlcurso = $conn->query("SELECT ID_CURSO, ID_TIPO,SECCION_CURSO, HORA_INICIAL, HORA_FINAL, DIAS_CURSO FROM DETALLE_CURSOS WHERE ID_DOCENTE = '$idProfesor'");



$arraytemporal =array();
$datos=[];
$idc = $sqlcurso->fetch_array();


$varTemporal = $idc["ID_CURSO"];

$nomCurso = $conn->query("SELECT NOM_CURSO FROM cursos WHERE ID_CURSO = '$varTemporal'");
$arrCurso=$nomCurso->fetch_array();
$nombreCurso=$arrCurso["NOM_CURSO"];

$sqlProfesor = $conn->query("SELECT ID_DOCENTE FROM DOCENTES WHERE APELLIDOS_NOMBRES='CASAZOLA CRUZ DANIEL OSWALDO'");
$idp = $sqlProfesor->fetch_array();
$idProfesor = $idp['ID_DOCENTE'];


$datos["COD_ASIG"]="";
$datos["GH"]="";
$datos["TEORIA"]="";
$datos["PRACTICA"]="";
$datos["LABORATORIO"]="";


do{
    array_push ($arraytemporal,$idc["ID_TIPO"],$idc["SECCION_CURSO"],$idc["HORA_INICIAL"],$idc["HORA_FINAL"],$idc["DIAS_CURSO"]);
            $idc = $sqlcurso->fetch_array();
            $datos["COD_ASIG"]=$idc["ID_CURSO"];

            if($varTemporal == $idc["ID_CURSO"]){
                array_push ($arraytemporal,$idc["ID_TIPO"],$idc["SECCION_CURSO"],$idc["HORA_INICIAL"],$idc["HORA_FINAL"],$idc["DIAS_CURSO"]);
                $arrTemp2 = new ArrayObject($arraytemporal);
                $copy = $arrTemp2 -> getArrayCopy();
                $datos["GH"]=$idc["SECCION_CURSO"];
                $datos["HORAINI"]=$idc["HORA_INICIAL"];
                $datos["HORAFIN"]=$idc["HORA_FINAL"];
                echo "<pre>";
                var_dump($copy);
                echo "</pre>";  

            }else{
                array_push ($arraytemporal,$idc["ID_CURSO"],$idc["ID_TIPO"],$idc["SECCION_CURSO"],$idc["HORA_INICIAL"],$idc["HORA_FINAL"],$idc["DIAS_CURSO"]);
                $arrTemp2 = new ArrayObject($arraytemporal);
                $copy = $arrTemp2 -> getArrayCopy();

                echo "<pre>";
                var_dump($copy);
                echo "</pre>"; 
            }
            unset($arraytemporal);
            $arraytemporal = array();
        }while($idc = $sqlcurso->fetch_array());

        $contar=count($copy);
        print_r($contar);
        $i=0;
        
        do {
            switch($copy[$i]){
                case 'T':   $datos["TEORIA"]=$copy[$i]; break;
                case 'P':   $datos["PRACTICA"]=$copy[$i]; break;
                case 'L':   $datos["LABORATORIO"]=$copy[$i]; break;
            } 
            echo "<br>".$copy[$i];
            $i=$i+1;
        }
        while($i<$contar); 

echo "<br>";
echo "<br>";
print_r($datos);

$cod=$datos["COD_ASIG"];
$gh=$datos["GH"];
$teoria=$datos["TEORIA"];
$practica=$datos["PRACTICA"];
$laboratorio=$datos["LABORATORIO"];
$sumahoras=($datos["HORAINI"]." - ".$datos["HORAFIN"]);
echo "<br>";
echo "<br>";
print_r($sumahoras);



$sql_insertar="INSERT INTO ficha (COD_ASIG, GH, ASIGNATURA, TIPO_T, TIPO_P, TIPO_L,LUNES) VALUES ('$cod','$gh','$nombreCurso','$teoria','$practica','$laboratorio','$sumahoras')";
$conn->query($sql_insertar); 


    
/* while ($idc = $sqlcurso->fetch_array()) {
array_push($arreglo, $idc['ID_CURSO'], $idc['ID_TIPO']);
array_push($arreglo, $idc['SECCION_CURSO']);
array_push($arreglo, $idc['HORA_INICIAL']);
array_push($arreglo, $idc['HORA_FINAL']);
array_push($arreglo, $idc['DIAS_CURSO']);
} */



/* if($idc['ID_TIPO']=='T'){
    echo '<tr>';
    echo '
        <td> '.$idc['ID_CURSO'].'</td>
        <td>'.$idc['SECCION_CURSO'].'</td>
        <td>ABC</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td>SISTEMAS</td>
        <td>04/04/2022</td>
        <td>CALLAO</td>
        <td></td>
        <td></td>';
        if($idc['DIAS_CURSO']=='Lun'){
            echo'
            <td>'.$idc['HORA_INICIAL'].' a '.$idc['HORA_FINAL'].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            ';
        } else if($idc['DIAS_CURSO']=='Mar'){
            echo'
            <td></td>
            <td>'.$idc['HORA_INICIAL'].' a '.$idc['HORA_FINAL'].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            ';
        }else if($idc['DIAS_CURSO']=='Mi??'){
            echo'
            <td></td>
            <td></td>
            <td>'.$idc['HORA_INICIAL'].' a '.$idc['HORA_FINAL'].'</td>
            <td></td>
            <td></td>
            <td></td>
            ';
        }else if($idc['DIAS_CURSO']=='Jue'){
            echo'
            <td></td>
            <td></td>
            <td></td>
            <td>'.$idc['HORA_INICIAL'].' a '.$idc['HORA_FINAL'].'</td>
            <td></td>
            <td></td>
            ';
        }else if($idc['DIAS_CURSO']=='Vie'){
            echo'
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$idc['HORA_INICIAL'].' a '.$idc['HORA_FINAL'].'</td>
            <td></td>
            ';
        }else if($idc['DIAS_CURSO']=='S??b'){
            echo'
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$idc['HORA_INICIAL'].' a '.$idc['HORA_FINAL'].'</td>
            ';
        }
    echo '</tr>';  */                   
?>
<tr>
    <td colspan=9> Total de horas de labores lectivas</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>

<!-- <tr>
    <td colspan=10>1.2 PREPARACION DE CLASES Y EVALUACION DE COMPETENCIAS(30% de hoiras laborales lectivas)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10>1.3 TUTORIA DE ESTUDIANTES(10% de horas de Labores Lectivas)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10>1.4 SUPERVISI??N Y/O ASESORIA DE PR??CTICAS PRE PROFESIONALES(Res. de Decano)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10>1.5 REVISOR DE TESIS(Una hora semanal)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10>1.5 JURADO DE TESIS(Una hora semanal)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10>1.6 REVISOR DE TESIS(Una hora semanal)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=2>1.7 INVESTIGACI??N</td>
    <td colspan=8>NOMBRE Y RESOLUCION DEL PROYECTO</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td><b>Inicio</b></td>
    <td></td>
    <td colspan=8></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td><b>Termino</b></td>
    <td></td>
    <td colspan=8></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10>1.8 REVISOR O LECTOR DE PROYECTO DE INVESTIGACI??N PARA PUBLICACI??N</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10>1.9 REDACTOR DE REVISTA CIENT??FICA(Con Resoluci??n de Rector o de decano)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7>a) Director o jefe</td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7>b) Miembre</td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10>1.10 ELABORACI??N DE GU??AS Y/O SEPARATAS (Resoluci??n de Decano y por un semestre acad??mico)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7>1.11 INVESTIGACI??N FORMATIVA</td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7>1.12 EXTENCI??N Y RESPONSABILIDAD SOCIAL</td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10><b>TOTAL DE HORAS ACADEMICAS</b></td>
    <td></td>
    <td></td>
   
</tr>
<tr>
    <td colspan=10><b>II. ACTIVIDADES ADMINISTRATIVAS</b></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7></td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7></td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7></td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7></td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10><b>TOTAL DE HORAS ACADEMICAS</b></td>
    <td></td>
    <td></td>
  
</tr>
<tr>
    <td colspan=10><b>III. CAPACITACION OFICIALIZADA</b></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7>3.1 Estudios de Diplomados y de Especializaci??n</td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=7>3.2 Estudio de Maestr??a y/o Doctorado</td>
    <td>Resol. N??</td>
    <td colspan= 2></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan=10><b>TOTAL GENERAL DE HORAS (I+II+III)</b></td>
    <td></td>
    <td></td>
    
</tr> -->
</table>

</body>
</html>