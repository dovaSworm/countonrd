<div class="container create-wrapper myshadow">
    <div class="create-header">
        <h4>Unesi novu kompaniju</h4>
    </div>
    <?php echo form_open('companies/create'); ?>
    <div class="row no-gutters p-3">
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Naziv</label>
            <input type="text" name="name" class="form-control" value="<?php echo set_value('name', ''); ?>"
                placeholder="Kompanije">

            <?php  if(form_error('name')) echo '<div class="alert alert-warning">' . form_error('name'). '</div>'; ?>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>PIB</label>
            <input type="text" name="pib" class="form-control" placeholder="PIB broj kompanije"
                value="<?php echo set_value('pib', ''); ?>">
            <?php  if(form_error('pib')) echo '<div class="alert alert-warning">' . form_error('pib'). '</div>'; ?>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>MB</label>
            <?php  if(form_error('mb')) echo '<div class="alert alert-warning">' . form_error('mb'). '</div>'; ?>
            <input type="text" name="mb" class="form-control" default="dova" placeholder="Matični broj kompanije"
                value="<?php echo set_value('mb', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Adresa</label>
            <?php  if(form_error('adress')) echo '<div class="alert alert-warning">' . form_error('adress'). '</div>'; ?>
            <input type="text" name="adress" class="form-control" placeholder="Adresa"
                value="<?php echo set_value('adress', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Poštanski broj</label>
            <?php  if(form_error('zip-code')) echo '<div class="alert alert-warning">' . form_error('zip-code'). '</div>'; ?>
            <input type="text" name="zip-code" class="form-control" value="<?php echo set_value('zip_code', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Grad</label>
            <?php  if(form_error('city')) echo '<div class="alert alert-warning">' . form_error('city'). '</div>'; ?>
            <input type="text" name="city" class="form-control" value="<?php echo set_value('city', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Email</label>
            <?php  if(form_error('email')) echo '<div class="alert alert-warning">' . form_error('email'). '</div>'; ?>
            <input type="email" name="email" class="form-control" value="<?php echo set_value('email', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Telefon</label>
            <?php  if(form_error('phone')) echo '<div class="alert alert-warning">' . form_error('phone'). '</div>'; ?>
            <input type="text" name="phone" class="form-control" value="<?php echo set_value('phone', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Banka</label>
            <?php  if(form_error('bank')) echo '<div class="alert alert-warning">' . form_error('bank'). '</div>'; ?>
            <input type="text" name="bank" class="form-control" placeholder="Naziv banke"
                value="<?php echo set_value('bank', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Bankovni račun</label>
            <?php  if(form_error('account-num')) echo '<div class="alert alert-warning">' . form_error('account-num'). '</div>'; ?>
            <input type="text" name="account-num" class="form-control" placeholder="Kompanije"
                value="<?php echo set_value('account_num', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Kontakt osoba</label>
            <?php  if(form_error('contact')) echo '<div class="alert alert-warning">' . form_error('contact'). '</div>'; ?>
            <input type="text" name="contact" class="form-control" placeholder="Ime i prezime"
                value="<?php echo set_value('contact', ''); ?>">
        </div>
    </div>
    <div class="text-center">
        <button class="btn mybutton" type="submit">Unesi kompaniju</button>
    </div>
        <?php echo form_close(); ?>
</div>