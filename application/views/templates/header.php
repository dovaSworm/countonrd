<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="robots" content="index,follow">
    <meta name="author" content="rdDesign">
    <meta name="keywords" content="">
    <!-- <meta name="google-site-verification" content="pMiLlWc0tbntvS3Ky6VZVY9rHKxaVqnqZHD8daTZEus" /> -->
    <link rel="canonical" href="" />
    <!-- <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/ptefavicon.png"> -->
    <!-- <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/img/ptefavicon.png"/> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <title><?php echo isset($title) ? $title : ''; ?></title>

</head>

<body>

<nav class="navbar nav bg-dark">
  <div class="container">
    <div class="d-flex">
    <?php if(is_numeric($this->session->userdata('user_id'))): ;?>
      <li class="nav-item">
          <a title="samo za admina" class="nav-link" href="<?php echo base_url(); ?>users/register"><i
                  class="far fa-user-circle"></i> Registracija</a>
      </li>
    <?php endif;?>
      <li class="nav-item">
          <a title="samo za admina" class="nav-link" href="<?php echo base_url(); ?>users/login"><i
                  class="far fa-user-circle"></i> Login</a>
      </li>
      <li class="nav-item">
          <a title="samo za admina" class="nav-link" href="<?php echo base_url(); ?>users/logout"><i
                  class="far fa-user-circle"></i> Logout</a>
      </li>
    </div>
    <li class="nav-item">
          <a title="samo za admina" class="nav-link" href="<?php echo base_url(); ?>">Početna</a>
      </li>
    <?php if(is_numeric($this->session->userdata('user_id'))): ;?>
    <div class="d-flex">
<div class="dropdown">
  <a class="btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Artikli
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="<?php echo base_url(); ?>items/index">Pogledaj sve</a>
    <a class="dropdown-item" href="<?php echo base_url(); ?>items/create">Unesi novi</a>
  </div>
</div>
<div class="dropdown">
  <a class="btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Kompanije
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="<?php echo base_url(); ?>companies/index">Pogledaj sve</a>
    <a class="dropdown-item" href="<?php echo base_url(); ?>companies/create">Unesi novu</a>
  </div>
</div>
<div class="dropdown">
  <a class="btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Fakture
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="<?php echo base_url(); ?>invoices/view_all">Pogledaj sve</a>
    <a class="dropdown-item" href="<?php echo base_url(); ?>invoices/index">Unesi novu</a>
  </div>
</div>
<?php endif;?>
</div>
</div>
</nav>