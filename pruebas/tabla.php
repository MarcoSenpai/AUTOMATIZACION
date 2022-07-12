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
$sqlProfesor = $conn->query("SELECT ID_DOCENTE FROM DOCENTES WHERE APELLIDOS_NOMBRES='CASAZOLA CRUZ OSWALDO DANIEL'");
$idp = $sqlProfesor->fetch_array();
$idProfesor = $idp['ID_DOCENTE'];
$sql = $conn->query("SELECT ID_CURSO, ID_TIPO FROM DETALLE_CURSOS WHERE ID_DOCENTE = '$idProfesor'");
while ($data = $sql->fetch_array()) {
echo '
<tr>
    <td> '.$data['ID_CURSO'].'</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
                                    ';
                                    }
                                
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
<tr>
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
    <td colspan=10>1.4 SUPERVISIÓN Y/O ASESORIA DE PRÁCTICAS PRE PROFESIONALES(Res. de Decano)</td>
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
    <td colspan=2>1.7 INVESTIGACIÓN</td>
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
    <td colspan=10>1.8 REVISOR O LECTOR DE PROYECTO DE INVESTIGACIÓN PARA PUBLICACIÓN</td>
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
    <td colspan=10>1.9 REDACTOR DE REVISTA CIENTÍFICA(Con Resolución de Rector o de decano)</td>
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
    <td>Resol. N°</td>
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
    <td>Resol. N°</td>
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
    <td colspan=10>1.10 ELABORACIÓN DE GUÍAS Y/O SEPARATAS (Resolución de Decano y por un semestre académico)</td>
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
    <td colspan=7>1.11 INVESTIGACIÓN FORMATIVA</td>
    <td>Resol. N°</td>
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
    <td colspan=7>1.12 EXTENCIÓN Y RESPONSABILIDAD SOCIAL</td>
    <td>Resol. N°</td>
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
    <td>Resol. N°</td>
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
    <td>Resol. N°</td>
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
    <td>Resol. N°</td>
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
    <td>Resol. N°</td>
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
    <td colspan=7>3.1 Estudios de Diplomados y de Especialización</td>
    <td>Resol. N°</td>
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
    <td colspan=7>3.2 Estudio de Maestría y/o Doctorado</td>
    <td>Resol. N°</td>
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
    
</tr>
</table>

</body>
</html>