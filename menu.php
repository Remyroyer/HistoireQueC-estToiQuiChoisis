<nav class="navbar navbar-expand-lg navbar-light bg-warning static-top mb-5 shadow">
  <div class="container">
  <a class="navbar-brand bg-secondary rounded-1" href="index.php">🍌🥸AdaM&DeV🥸🍌</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto">
      <li class="nav-item">
            <div class="row border-top border-dark m-2">
            <div class="col-1"></div>
            <div class="col-11 border-bottom border-dark">UTILISATEUR</div>
            </div>
        </li>
        <?php
if (isset($_SESSION['nomUser'])){
    ?>
    <li class="nav-item">
      <a class="nav-link" href="compte.php">Mon compte</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="histoire.php">Commencer une histoire</a>
    </li>
    <?php
}else{
    ?>
    <li class="nav-item">
    <a class="nav-link" href="index.php">Connectez-vous</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="forminscription.php">Créer un compte</a>
    </li>
    <?php
}

if(isset($_SESSION['ADMIN'])){
  echo "SESSION ADMIN";
    if($_SESSION['ADMIN']==true){
        ?>
        <li class="nav-item">
            <div class="row border-top border-dark m-2">
            <div class="col-1"></div>
            <div class="col-11 border-bottom border-dark">ADMIN</div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adminhistoire.php">Ajouter histoires</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="modifhistoire.php">Modifier histoires</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admincompte.php">Comptes utilisateurs</a>
        </li>
    <?php
    }
}
if (isset($_SESSION['nomUser'])){
        ?>
        <li class="nav-item">
          <form action="deconnexion.php" method="POST"><input class="bottom rounded-1 border border-none m-1" type="submit" value="Déconnexion"></form>
        </li>
        <?php
        if (isset($_SESSION['nomUser'])){
            ?>
            
            <?php
            }
        }
            ?>
      </ul>
    </div>
  </div>
</nav>