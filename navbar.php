<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perulangan NAVBAR</title>
      <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand fs-3 me-5" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-5">
        <a class="nav-link fs-4 text-lights ms-5" aria-current="page" href="index.php">Home</a>
        <a class="nav-link fs-4 text-lights ms-5" href="">Features</a>
        <a class="nav-link fs-4 text-lights ms-5" href="#">Pricing</a>
        <a class="nav-link fs-4 text-lights ms-5" href="tambah/tambah.php" tabindex="-1" aria-disabled="true">Tambah Data</a>
      </div>
    </div>
  </div>
  <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary me-3" type="submit">Search</button>
      </form>
</nav>
</body>
</html>
