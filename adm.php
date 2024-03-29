<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="pag.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <title>Adm</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <!--NAVBAR-->
  <nav class="navbar navbar-custom navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Freddy Fazbear's Pizza</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse navbar" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <?php
          session_start();

          if (isset($_SESSION['email'])) {
            if ($_SESSION['email'] == 'yuzuvulpes@gmail.com') {
          ?>
              <li class="nav-item">
                <a class="nav-link active" href="adm.php">Administrador</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admorder.php">Pedidos</a>
              </li>

            <?php
            }
            ?>
            <li class="nav-item" style="float: right;">
              <a class="nav-link" href="order.php">Fazer Pedido</a>
            </li>
            <li class="nav-item" style="float: right;">
              <a class="nav-link" href="Uupdate.php">Muda a conta</a>
            </li>
            <li class="nav-item" style="float: right;">
              <a class="nav-link" href="logout.php">Log out</a>
            </li>
          <?php
          } else {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <!--END NAVBAR-->

  <!--Central Container-->
  <div class="container" style="opacity: 92%">
    <div class="card card-custom my-4 border-dark" style="width: 100%;height: fit-content; display: inline-flex;">
      <div class="card-body">
        <h5 class="card-title">
          <h3>Lista de funcionários</h3>
          <hr>
          <div>
            <!-- Table -->
            <?php
            require_once("./assets/config/connect.php");

            $sql = "SELECT * FROM cadastros ORDER BY id ASC";
            $res = $conn->query($sql);

            ?>
            <table class="table" style="color: white">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Senha</th>
                  <th scope="col">Update</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($user = $res->fetch(PDO::FETCH_ASSOC)) {
                  echo "<tr>";
                  echo "<td>" . $user['id'] . "</td>";
                  echo "<td>" . $user['username'] . "</td>";
                  echo "<td>" . $user['email'] . "</td>";
                  echo "<td>" . $user['senha'] . "</td>";
                  echo "<td><a type='button' class='btn btn-info' href='update.php?id=" . $user['id'] . "'>UPDATE</a></td>";
                  echo "<td><a type='button' class='btn btn-danger' href='adm.php?id=" . $user['id'] . "'>DELETE</a></td>";
                  echo "</tr>";
                }
                ?>
                <?php
                require_once('./assets/config/connect.php');

                if (isset($_GET['id'])) {
                  $id = $_GET['id'];
                  $stmt = $conn->prepare("DELETE FROM cadastros WHERE id = $id");
                  if ($stmt->execute()) {
                    header("Location: adm.php");
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
  <!--END Central Container-->
</body>

</html>