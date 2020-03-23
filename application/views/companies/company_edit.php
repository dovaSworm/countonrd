<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="mytitle">
    <h6 class="text-center my-1">CountOn<img src="<?php echo base_url().'/assets/img/sivibek.svg' ;?>" alt=""></h6>
</div>
<h4 class="text-center my-3">Izmeni kompanije</h4>
<div class="container d-flex justify-content-center">
<?php echo form_open('companies/update'); ?>
    <input type="hidden" name="id" value="<?php echo $company['id']; ?>">
    <div class="form-inline my-2">
        <label>Naziv</label>
        <?php  if(form_error('name')) echo '<div class="alert alert-warning">' . form_error('name'). '</div>'; ?> 
        <input type="text" name="name" class="form-control" value="<?php echo $company['name']; ?>" placeholder="Unesit naziv kompanije">
    </div>
    <div class="form-inline my-2">
        <label>PIB</label>
        <?php  if(form_error('pib')) echo '<div class="alert alert-warning">' . form_error('pib'). '</div>'; ?>
        <input type="text" name="pib" class="form-control" placeholder="Unesit PIB broj kompanije" value="<?php echo $company['pib']; ?>">
    </div>
    <div class="form-inline my-2">
        <label>MB</label>
        <?php  if(form_error('mb')) echo '<div class="alert alert-warning">' . form_error('mb'). '</div>'; ?>
        <input type="text" name="mb" class="form-control" default="dova" placeholder="Unesit matični broj kompanije" value="<?php echo $company['mb']; ?>">
    </div>
    <div class="form-inline my-2">
        <label>Adresa</label>
        <?php  if(form_error('adress')) echo '<div class="alert alert-warning">' . form_error('adress'). '</div>'; ?>
        <input type="text" name="adress" class="form-control" placeholder="Adresa kompanije" value="<?php echo $company['adress']; ?>">
    </div>
    <div class="form-inline my-2">
        <label>Poštanski broj</label>
        <?php  if(form_error('zip-code')) echo '<div class="alert alert-warning">' . form_error('zip-code'). '</div>'; ?>
        <input type="text" name="zip-code" class="form-control" value="<?php echo set_value('zip_code', ''); ?>">
    </div>
    <div class="form-inline my-2">
        <label>Grad</label>
        <?php  if(form_error('city')) echo '<div class="alert alert-warning">' . form_error('city'). '</div>'; ?>
        <input type="text" name="city" class="form-control" value="<?php echo set_value('city', ''); ?>">
    </div>
    <div class="form-inline my-2">
        <label>Email</label>
        <?php  if(form_error('email')) echo '<div class="alert alert-warning">' . form_error('email'). '</div>'; ?>
        <input type="email" name="email" class="form-control" placeholder="Unesite email kompanije" value="<?php echo $company['email']; ?>">
    </div>
    <div class="form-inline my-2">
        <label>Banka</label>
        <?php  if(form_error('bank')) echo '<div class="alert alert-warning">' . form_error('bank'). '</div>'; ?>
        <input type="text" name="bank" class="form-control" placeholder="Unesite banku" value="<?php echo $company['bank']; ?>">
    </div>
    <div class="form-inline my-2">
        <label>Bankovni račun</label>
        <?php  if(form_error('account-num')) echo '<div class="alert alert-warning">' . form_error('account-num'). '</div>'; ?>
        <input type="text" name="account-num" class="form-control" placeholder="Unesite račun kompanije" value="<?php echo $company['account_num']; ?>">
    </div>
    <div class="form-inline my-2">
        <label>Kontakt osoba</label>
        <?php  if(form_error('contact')) echo '<div class="alert alert-warning">' . form_error('contact'). '</div>'; ?>
        <input type="text" name="contact" class="form-control" placeholder="kontakt osoba" value="<?php echo $company['contact']; ?>">
    </div>
    <div class="text-center">
        <button class="btn mybutton" type="submit">Snimi izmene</button>
    </div>
<?php echo form_close(); ?>
</div>