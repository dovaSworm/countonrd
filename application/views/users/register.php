<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="container create-wrapper">
    <div class="create-header">
        <h4 class="text-center my-1">Registracija novog korisnika</h4>
    </div>
    <?php echo validation_errors(); ?>

    <?php echo form_open('users/register'); ?>
    <div class="row no-gutters flex-column align-items-center">
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Ime</label>
            <input type="text" name="name" class="form-control" placeholder="Unesite ime" required autofocus  oninvalid="this.setCustomValidity('Obavezno polje')"
    oninput="this.setCustomValidity('')">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Lozinka</label>
            <input type="password" name="password" class="form-control" placeholder="Unesite lozinku"required autofocus  oninvalid="this.setCustomValidity('Obavezno polje')"
    oninput="this.setCustomValidity('')">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Ponovljena lozinka</label>
            <input type="password" name="password2" class="form-control" placeholder="Ponovite lozinku"required autofocus  oninvalid="this.setCustomValidity('Obavezno polje')"
    oninput="this.setCustomValidity('')">
        </div>
        <div class="col-sm-12 text-center">
            <button class="btn mybutton" type="submit">Unesi korisnika</button>
        </div>
    </div>
        <?php echo form_close(); ?>
</div>