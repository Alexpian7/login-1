<?php
session_start();

require '../Controler/database.php';

if (isset($_SESSION['usuario_id'])) {
  $records = $conn->prepare('SELECT id, email, password FROM usuario WHERE id = :id');
  $records->bindParam(':id', $_SESSION['usuario_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}
?>
<!DOCTYPE html>
<html lang="Es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
</head>
<link rel="stylesheet" href="../CSS2/style.css">
<link rel="stylesheet" href="../CSS/calc.css">
<link rel="stylesheet" href="../CSS/resultados.css">
<link rel="stylesheet" href="../CSS2/estilosModal.css">
<link rel="stylesheet" href="../CSS2/modalDos.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<body>
  <!--INICIO NAVBAR-->
  <div class="nav" id="main-nav">
    <input type="checkbox" id="nav-check">
    <div class="nav-btn">
      <label for="nav-check">
        <span></span>
        <span></span>
        <span></span>
      </label>
    </div>

    <div class="nav-links">
      <a href="#" target="_blank">Centro de ayuda</a>
      <a href="#" target="_blank"><i class="fas fa-cog"></i></a>
      <a href="#" target="_blank"><i class="fa-solid fa-volume-off"></i></a>
      <a href="#" target="_blank"><i class="fa-regular fa-bell"></i></a>
      <div class="user-profile" id="myProfile">
      </div>
    </div>
  </div>
  <!--FIN NAVBAR-->

  <center> <?php if (!empty($user)) : ?>
      <br style=""><?= $user['email']; ?>
  </center>

  <!--INICIO CALCULADORA-->
  <div id="contenido1" style="display: none;">
    <nav class="calc">
      <div id="formulario">
        <i class="calk fas fa-sack-dollar">
          <span>Liquidar</span>
        </i>
        <label for="fechaInicio">Fecha de Inicio:</label>
        <input type="date" id="fechaInicio">

        <label for="fechaFinal">Fecha Final:</label>
        <input type="date" id="fechaFinal">

        <label for="auxilioTransporte">Auxilio de Transporte:</label>
        <input type="number" id="auxilioTransporte" placeholder="Ingrese el Aux de Transporte">

        <label for="pagosExtras">Pagos extras:</label>
        <input type="number" id="pagosExtras" placeholder="Ingrese sus pagos extras">

        <label for="salarioMensual">Salario Mensual:</label>
        <input type="number" id="salarioMensual" placeholder="Ingrese el salario mensual">

        <button class="btn-cal" id="open" onclick="calcularNomina(); manejarModal();">Calcular Nómina</button>
      </div>


      <div class="modal-container" id="resultados">
        <div class="modal">
          <h2>Resultados</h2>
          <table id="tablaResultados">
            <thead>
              <tr>
                <th>Cesantías</th>
                <th>Intereses sobre Cesantías</th>
                <th>Prima de Servicios</th>
                <th>Vacaciones</th>
                <th>Total a Pagar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="cesantiasTotalResult"></td>
                <td id="interesesCesantiasTotalResult"></td>
                <td id="primaServiciosTotalResult"></td>
                <td id="vacacionesTotalResult"></td>
                <td id="salarioTotalResult"></td>
              </tr>
            </tbody>
          </table>
          <button class="cerrar-modal" id="btn-close">cerrar</button>
        </div>
      </div>
  </div>
  </nav>


  <div id="contenido2" style="display: none;">
    <nav class="calc">
      <div id="formulario">
        <i class="calk fa-solid fa-money-bill-wave">
          <span>Calcular</span>
        </i>
        <h4 class="name">Datos del Empleado</h4>
        <br>
        <label for="fechaInicio">Fecha de Inicio:</label>
        <input type="date" id="fechaInicio" required>

        <label for="fechaFinal">Fecha Final:</label>
        <input type="date" id="fechaFinal" required>
        <label for="salarioMensual">Salario Mensual:</label>
        <input type="number" id="salarioMensual" placeholder="Ingrese el salario mensual" required>

        <label for="auxilioTransporte">Auxilio de Transporte:</label>
        <input type="number" id="auxilioTransporte" placeholder="Ingrese el auxilio de transporte" required>

        <label for="pagosExtras">Pagos Extras:</label>
        <input type="number" id="pagosExtras" placeholder="Ingrese los pagos extras">

        <label for="otrasDeducciones">Otras Deducciones:</label>
        <input type="number" id="otrasDeducciones" placeholder="Ingrese sus otras deducciones">

        <button class="btn-cal" id="openModalDos" onclick="calcularMiNomina(); manejarModalDos();">Calcular Nómina</button>
      </div>
      
      <div class="modalDos-container" id="resultadosDos">
        <div class="modalDos">
          <h2>Resultado</h2>
          <div id="salarioNetoResult"></div>
          <button class="cerrar-modalDos" id="btn-cerrar">cerrar</button>
        </div>
      </div>
  </div>
  </nav>

  <br>
  <br>
<?php else : ?>
<?php endif; ?>



<script src="../menu.js"></script>
<script src="../JS/calcular.js"></script>
<script src="../JS/calcular2.js"></script>
<script src="../JS/nomina.js"></script>
<script src="../JS/modal.js"></script>
<script src="../JS/modalDos.js"></script>

</body>

</html>