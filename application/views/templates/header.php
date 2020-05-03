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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css"
        rel="stylesheet" />

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/nav.css">
    <title><?php echo isset($title) ? $title : 'CountOnRd'; ?></title>

</head>

<body>

    <nav>
        <div class="logo-holder">
        <img  src="<?php echo base_url().'/assets/img/logo5.png' ;?>" alt="logo"> 
        </div>
        <div class="container">
            <div id="loging" class="d-flex" style="color:white">
                <?php if (is_numeric($this->session->userdata('user_id'))): ;?>
                <a title="samo za admina" class="nav-link" href="<?php echo base_url(); ?>users/register"><i
                        class="fas fa-user-plus fa-sm"></i> Registracija</a>
                <a title="samo za admina" class="nav-link" href="<?php echo base_url(); ?>users/logout"><i
                        class="fas fa-user fa-sm"></i> Logout</a>
                        <a title="samo za admina" class="nav-link" href="<?php echo base_url(); ?>"><i class="fas fa-home home-btn"></i></a>
                <?php endif;?>
                <?php if (!is_numeric($this->session->userdata('user_id'))): ;?>
                <a title="samo za admina" class="nav-link" href="<?php echo base_url(); ?>users/login"><i
                        class="fas fa-user fa-sm"></i> Login</a>
                <?php endif;?>
                <?php if (is_numeric($this->session->userdata('user_id'))): ;?>
            </div>
            <div class="hamburger">
                <div class="wrapper">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                </div>
            </div>
            <ul class="nav-links">
                <li ><a class="nav-btn" href="#">Artikli</a>
                    <ul class="sub-menu first-sub">
                        <li>
                            <a href="<?php echo base_url(); ?>items/index">Pogledaj sve</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>items/create">Unesi novi</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>items/stat">Statistika</a>
                        </li>
                    </ul>
                </li>
                <li ><a class="nav-btn" href="#">Fakture</a>
                    <ul class="sub-menu sec-sub">
                        <li>
                            <a href="<?php echo base_url(); ?>invoices/view_all">Pogledaj sve</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>invoices/index">Unesi novu</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>invoices/stat">Statistika</a>
                        </li>
                    </ul>
                </li>
                <li ><a class="nav-btn" href="#">Kompanije</a>
                    <ul class="sub-menu thr-sub">
                        <li>
                            <a href="<?php echo base_url(); ?>companies/index">Pogledaj sve</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>companies/create">Unesi novu</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>companies/stat">Statistika</a>
                        </li>
                    </ul>
                </li>
                <li ><a class="nav-btn" href="#">Ulazi</a>
                    <ul class="sub-menu last-sub">
                        <li>
                            <a href="<?php echo base_url(); ?>entry/view_all">Pogledaj sve</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>entry/view">Novi ulaz</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php endif;?>
        </div>
    </nav>
    <main>