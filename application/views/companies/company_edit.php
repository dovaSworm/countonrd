<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="mytitle">
    <img src="<?php echo base_url().'/assets/img/logo.png' ;?>" alt="">
    <h2 class="text-center my-1">COUNTONRD</h2>
</div>
<h4 class="text-center my-3">Izmeni kompanije</h4>
<div class="container d-flex justify-content-center">
<?php echo form_open('companies/update'); ?>
<input type="hidden" name="id" value="<?php echo $company['id']; ?>">
<div class="form-group">
    <label>Naziv</label>
    <?php  if(form_error('name')) echo '<div class="alert alert-warning">' . form_error('name'). '</div>'; ?> 
    <input type="text" name="name" class="form-control" value="<?php echo $company['name']; ?>" placeholder="Unesit naziv kompanije">
</div>
<div class="form-group">
    <label>PIB</label>
    <?php  if(form_error('pib')) echo '<div class="alert alert-warning">' . form_error('pib'). '</div>'; ?>
    <input type="text" name="pib" class="form-control" placeholder="Unesit PIB broj kompanije" value="<?php echo $company['pib']; ?>">
</div>
<div class="form-group">
    <label>MB</label>
    <?php  if(form_error('mb')) echo '<div class="alert alert-warning">' . form_error('mb'). '</div>'; ?>
    <input type="text" name="mb" class="form-control" default="dova" placeholder="Unesit matični broj kompanije" value="<?php echo $company['mb']; ?>">
</div>
<div class="form-group">
    <label>Adresa</label>
    <?php  if(form_error('adress')) echo '<div class="alert alert-warning">' . form_error('adress'). '</div>'; ?>
    <input type="text" name="adress" class="form-control" placeholder="Adresa kompanije" value="<?php echo $company['adress']; ?>">
</div>
<div class="form-group">
    <label>Email</label>
    <?php  if(form_error('email')) echo '<div class="alert alert-warning">' . form_error('email'). '</div>'; ?>
    <input type="email" name="email" class="form-control" placeholder="Unesite email kompanije" value="<?php echo $company['email']; ?>">
</div>
<div class="form-group">
    <label>Bankovni račun</label>
    <?php  if(form_error('account-num')) echo '<div class="alert alert-warning">' . form_error('account-num'). '</div>'; ?>
    <input type="text" name="account-num" class="form-control" placeholder="Unesite račun kompanije" value="<?php echo $company['account_num']; ?>">
</div>
<button class="btn mybutton" type="submit">Snimi izmene</button>

<?php echo form_close(); ?>
</div>