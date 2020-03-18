<br><br><br><br>
<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<?php echo form_open('invoiceitems/create'); ?>

<div class="form-inline">
    <label>Naziv</label>
    <?php  if(form_error('name')) echo '<div class="alert alert-warning">' . form_error('name'). '</div>'; ?> 
    <input type="text" name="name" class="form-control" value="<?php echo set_value('name', ''); ?>" placeholder="Unesit naziv proizvoda">
</div>
<div class="form-inline">
    <label>Kod proizvoda</label>
    <?php  if(form_error('code')) echo '<div class="alert alert-warning">' . form_error('code'). '</div>'; ?>
    <input type="text" name="code" class="form-control" placeholder="Unesit kod proizvoda" value="<?php echo set_value('code', ''); ?>">
</div>
<div class="form-inline">
    <label>Rabat</label>
    <?php  if(form_error('rate')) echo '<div class="alert alert-warning">' . form_error('rate'). '</div>'; ?>
    <input type="text" name="rate" class="form-control" default="dova" placeholder="Unesite rabat za proizvod" value="<?php echo set_value('rate', ''); ?>">
</div>
<div class="form-inline">
    <label>PDV</label>
    <?php  if(form_error('tax')) echo '<div class="alert alert-warning">' . form_error('tax'). '</div>'; ?>
    <input type="text" name="tax" class="form-control" placeholder="Unesite pdv za proizvod" value="<?php echo set_value('tax', ''); ?>">
</div>
<div class="form-inline">
    <label>Količina</label>
    <?php  if(form_error('quantity')) echo '<div class="alert alert-warning">' . form_error('quantity'). '</div>'; ?>
    <input type="text" name="quantity" class="form-control" placeholder="Unesite količinu proizvoda" value="<?php echo set_value('quantity', ''); ?>">
</div>

<div class="form-inline">
    <label>Popust</label>
    <?php  if(form_error('discount')) echo '<div class="alert alert-warning">' . form_error('discount'). '</div>'; ?>
    <input type="text" name="discount" class="form-control" placeholder="Unesite popust za proizvod" value="<?php echo set_value('discount', ''); ?>">
</div>
    <label>Cena</label>
    <?php  if(form_error('selling-price')) echo '<div class="alert alert-warning">' . form_error('selling-price'). '</div>'; ?>
    <input type="text" name="selling-price" class="form-control" placeholder="Unesite prodajnu cenu za proizvod" value="<?php echo set_value('selling-price', ''); ?>">
</div>
</div>
    <label>Total</label>
    <?php  if(form_error('total')) echo '<div class="alert alert-warning">' . form_error('total'). '</div>'; ?>
    <input type="text" name="total" class="form-control" placeholder="Unesite prodajnu cenu za proizvod" value="<?php echo set_value('total', ''); ?>">
</div>
<button class="btn btn-primary" type="submit">Submit</button>

<?php echo form_close(); ?>