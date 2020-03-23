
<div class="mytitle">
    <h6 class="text-center my-1">CountOn<img src="<?php echo base_url().'/assets/img/sivibek.svg' ;?>" alt=""></h6>
</div>
<?php echo validation_errors(); ?>
<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        echo '<h4 class="text-center">Niste ulogovani! Morate se ulogovati da bi koristili program.</h4>';
    }else{
        echo '<h4 class="text-center">Već ste ulogovani.</h4>';
    }  
?>

<div class="row no-gutters">
    <?php echo form_open('users/login'); ?>
    <div class="col-sm-12 col-md-4 m-auto">
        <br>
        <p>Ovu stranicu koriste samo ovlašćena lica firme Pro-technology!!! Novog korisnika može da registruje samo već postojeći ulogovani korisnik.</p>
        <br>
        <h2 class="text-center my-1">Login</h2>
        <div class="form-inline my-1">
            <input type="text" name="name" placeholder="Korisničko ime" class="form-control" required autofocus>
        </div>
        <div class="form-inline my-1">
            <input type="password" name="password" placeholder="Šifra" class="form-control" required autofocus>
        </div>
        <div class="text-center">
            <button class="btn mybutton" type="submit">Uloguj se</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>