<?php
include_once 'templates\header.php';

?>
</br>
<div class="p-5 mb-4 bg-light rounded-3 text-center " style="background-image: url('./img/fondo_2.png'); background-size: cover;">
  <div class="container-fluid">
    <h1 class="display-5 fw-bold">Bienvenido al Sistema ETERSAC</h1>
    <p class="col-md-8 fs-4 fw-bold">Usuario: <?php echo $_SESSION['usuario']; ?></p>
    <img width="600" src="./img/coffe-login.svg" class="img-fluid rounded" alt="">
  </div>
</div>



<?php
include_once 'templates\footer.php';

?>