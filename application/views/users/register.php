<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="mytitle">
    <h6 class="text-center my-1">CountOn<img src="<?php echo base_url().'/assets/img/sivibek.svg' ;?>" alt=""></h6>
</div>
<h3 class="text-center my-5">Registracija novog korisnika</h3>
<div class="container">
    <?php echo validation_errors(); ?>

    <?php echo form_open('users/register'); ?>
    <div class="col-sm-12 col-md-7 m-auto">
        <div class="form-inline my-2">
            <label>Ime</label>
            <input type="text" name="name" class="form-control" placeholder="Unesite ime">
        </div>
        <div class="form-inline my-2">
            <label>Lozinka</label>
            <input type="password" name="password" class="form-control" placeholder="Unesite lozinku">
        </div>
        <div class="form-inline my-2">
            <label>Ponovljena lozinka</label>
            <input type="password" name="password2" class="form-control" placeholder="Ponovite lozinku">
        </div>
        <div class="text-center">
            <button class="btn mybutton" type="submit">Unesi korisnika</button>
        </div>
    <?php echo form_close(); ?>
    </div>
</div>