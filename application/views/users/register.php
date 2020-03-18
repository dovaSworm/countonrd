<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<h3 class="text-center my-5">Registracija novog korisnika</h3>
<div class="container">
    <?php echo validation_errors(); ?>


    <?php echo form_open('users/register'); ?>
    <div class="col-12 col-md-8 col-lg-6 m-auto">
        <div class="form-group">
            <label>Ime</label>
            <input type="text" name="name" class="form-control" placeholder="Unesit ime">
        </div>

        <div class="form-group">
            <label>Lozinka</label>
            <input type="password" name="password" class="form-control" placeholder="Unesit lozinku">
        </div>
        <div class="form-group">
            <label>Ponovljena lozinka</label>
            <input type="password" name="password2" class="form-control" placeholder="Ponovite lozinku">
        </div>
        <button class="btn mybutton" type="submit">Unesi korisnika</button>
    <?php echo form_close(); ?>
    </div>
</div>