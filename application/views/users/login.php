<br><br><br><br>

<?php echo validation_errors(); ?>
<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        echo '<h4 class="text-center">Niste ulogovani! Morate se ulogovati da bi koristili program.</h4>';
    }else{
        echo '<h4 class="text-center">Već ste ulogovani.</h4>';
    }
   
?>

<?php echo form_open('users/login'); ?>
<div class="row no-gutters">
    <div class="col-md-4 offset-md-4">
        <br>
        <p>Ovu stranicu koriste samo ovlašćena lica firme Pro-technology!!! Novog korisnika može da registruje samo već postojeći ulogovani korisnik.</p>
        <br>
        <h2 class="text-center">Login</h2>
        <div class="form-group">
            <input type="text" name="name" placeholder="Korisničko ime" class="form-control" required autofocus>
            <input type="password" name="password" placeholder="Šifra" class="form-control" required autofocus>
            <button class="btn mybutton w-100" type="submit">Uloguj se</button>
        </div>
    </div>
</div>


<?php echo form_close(); ?>