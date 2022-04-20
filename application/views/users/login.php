<div class="container create-wrapper">
    <div class="create-header">
        <h2 class="text-center my-1">Login</h2>
    </div>
    <h4 id="hom-welc">Dobrodošli</h4>
    <div class="hom-wrapper row no-gutters">
        <div class="col-sm-12 col-lg-4 text-center">
            <p id="hom-parag">program za izradu faktura i vođenje stanja magacina</p>
        </div>
        <div class="col-sm-12 col-lg-8 text-center">
            <h2 id="hom-title" class="">CountOn<b>rd</b></h2>
        </div>
    </div>
    <div class="row no-gutters">
        <?php echo form_open('users/login'); ?>
        <div class="col-sm-12 col-md-4 m-auto">
            <br>
            <p>Ovu stranicu koriste samo ovlašćena lica firme Pro-technology!!! Novog korisnika može da registruje samo već
                postojeći ulogovani korisnik.</p>
            <br>
            <?php if ($this->session->flashdata('info')) : ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('info') . $this->session->userdata('name') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
            <?php endif; ?>

            <div class="form-inline my-1">

                <input type="text" name="name" placeholder="Korisničko ime" class="form-control" required autofocus oninvalid="this.setCustomValidity('Obavezno polje')" oninput="this.setCustomValidity('')">
            </div>
            <div class="form-inline my-1">

                <input type="password" name="password" placeholder="Šifra" class="form-control" required autofocus oninvalid="this.setCustomValidity('Obavezno polje')" oninput="this.setCustomValidity('')">
            </div>
            <div class="text-center">
                <button class="btn mybutton" type="submit">Uloguj se</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>