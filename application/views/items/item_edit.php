<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="mytitle">
    <h6 class="text-center my-1">CountOn<img src="<?php echo base_url().'/assets/img/sivibek.svg' ;?>" alt=""></h6>
</div>
<h4 class="text-center my-2">Izmeni proizvod</h4>

<div class="container d-flex justify-content-center mb-5">
<?php echo form_open('items/update'); ?>
<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
<div class="form-inline my-2">
    <label>Groupa proizvoda</label>
    <?php  if(form_error('group-id')) echo '<div class="alert alert-warning">' . form_error('group-id'). '</div>'; ?> 
    <select name="group-id" id="" class="form-control">
        <?php foreach($groups as $group): ?>
        <option value="<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-inline my-2">
    <label>Naziv</label>
    <?php  if(form_error('name')) echo '<div class="alert alert-warning">' . form_error('name'). '</div>'; ?> 
    <input type="text" name="name" class="form-control" value="<?php echo $item['name']; ?>" placeholder="Unesit naziv proizvoda">
</div>
<div class="form-inline my-2">
    <label>Kod proizvoda</label>
    <?php  if(form_error('code')) echo '<div class="alert alert-warning">' . form_error('code'). '</div>'; ?>
    <input type="text" name="code" class="form-control" placeholder="Unesit kod proizvoda" value="<?php echo $item['code']; ?>">
</div>
<div class="form-inline my-2">
    <label>Jedinica mere</label>
    <?php  if(form_error('mes-unit')) echo '<div class="alert alert-warning">' . form_error('mes-unit'). '</div>'; ?>
    <input type="text" name="mes-unit" class="form-control" default="dova" placeholder="Unesite mernu jedinicu" value="<?php echo $item['mes_unit']; ?>">
</div>
<div class="form-inline my-2">
    <label>PDV</label>
    <?php  if(form_error('tax')) echo '<div class="alert alert-warning">' . form_error('tax'). '</div>'; ?>
    <input type="text" name="tax" class="form-control" placeholder="Unesite pdv za proizvod" value="<?php echo $item['tax']; ?>">
</div>
<div class="form-inline my-2">
    <label>Količina</label>
    <?php  if(form_error('quantity')) echo '<div class="alert alert-warning">' . form_error('quantity'). '</div>'; ?>
    <input type="text" name="quantity" class="form-control" placeholder="Unesite količinu proizvoda" value="<?php echo $item['quantity']; ?>">
</div>
<div class="form-inline my-2">
    <label>Opis</label>
    <?php  if(form_error('description')) echo '<div class="alert alert-warning">' . form_error('description'). '</div>'; ?> 
    <textarea rows="4" cols="20" type="text" name="description" class="form-control" placeholder="Unesite opis za proizvod" value=""><?php echo $item['description']; ?></textarea>
</div>
<div class="form-inline my-2">
    <label>Kupovna cena</label>
    <?php  if(form_error('buying-price')) echo '<div class="alert alert-warning">' . form_error('buying-price'). '</div>'; ?>
    <input type="text" name="buying-price" class="form-control" placeholder="Unesite kupovnu cenu za proizvod" value="<?php echo $item['buying_price']; ?>">
</div>
<div class="form-inline my-2">
    <label>Prodajna cena</label>
    <?php  if(form_error('selling-price')) echo '<div class="alert alert-warning">' . form_error('selling-price'). '</div>'; ?>
    <input type="text" name="selling-price" class="form-control" placeholder="Unesite prodajnu cenu za proizvod" value="<?php echo $item['selling_price']; ?>">
</div>
<div class="form-inline my-2">
    <label>Kod prodavca</label>
    <?php  if(form_error('sellers-code')) echo '<div class="alert alert-warning">' . form_error('sellers-code'). '</div>'; ?>
    <input type="text" name="sellers-code" class="form-control" placeholder="Unesite kod prodavca za proizvod" value="<?php echo $item['sellers_code']; ?>">
</div>
<div class="form-inline my-2">
    <label>Naziv kod prodavca</label>
    <?php  if(form_error('sellers-name')) echo '<div class="alert alert-warning">' . form_error('sellers-name'). '</div>'; ?>
    <input type="text" name="sellers-name" class="form-control" placeholder="Unesite naziv kod prodavza za proizvod" value="<?php echo $item['sellers_name']; ?>">
</div>
<div class="text-center">
    <button class="btn mybutton" type="submit">Snimi izmene</button>
</div>
<?php echo form_close(); ?>
</div>