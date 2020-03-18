<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="mytitle">
    <img src="<?php echo base_url().'/assets/img/logo.png' ;?>" alt="">
    <h2 class="text-center my-1">COUNTONRD</h2>
</div>
<h4 class="text-center my-1">Unesi novi artikal</h4>
<div class="container d-flex justify-content-center mb-5">
    <div class="row">
        <?php echo form_open('items/create'); ?>

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
            <input type="text" name="name" class="form-control" value="<?php echo set_value('name', ''); ?>" placeholder="Unesit naziv proizvoda">
        </div>
        <div class="form-inline my-2">
            <label>Kod proizvoda</label>
            <?php  if(form_error('code')) echo '<div class="alert alert-warning">' . form_error('code'). '</div>'; ?>
            <input type="text" name="code" class="form-control" placeholder="Unesit kod proizvoda" value="<?php echo set_value('code', ''); ?>">
        </div>
        <div class="form-inline my-2">
            <label>PDV</label>
            <?php  if(form_error('tax')) echo '<div class="alert alert-warning">' . form_error('tax'). '</div>'; ?>
            <input type="text" name="tax" class="form-control" placeholder="Unesite pdv za proizvod" value="<?php echo set_value('tax', '20'); ?>">
        </div>
        <div class="form-inline my-2">
            <label>Količina</label>
            <?php  if(form_error('quantity')) echo '<div class="alert alert-warning">' . form_error('quantity'). '</div>'; ?>
            <input type="text" name="quantity" class="form-control" placeholder="Unesite količinu proizvoda" value="<?php echo set_value('quantity', ''); ?>">
        </div>
        <div class="form-inline my-2">
            <label>Opis</label>
            <?php  if(form_error('description')) echo '<div class="alert alert-warning">' . form_error('description'). '</div>'; ?> 
            <textarea rows="4" cols="21" type="text" name="description" class="form-control" placeholder="Unesite opis za proizvod" value="<?php echo set_value('description', ''); ?>"></textarea>
        </div>
        <div class="form-inline my-2">
            <label>Kupovna cena</label>
            <?php  if(form_error('buying-price')) echo '<div class="alert alert-warning">' . form_error('buying-price'). '</div>'; ?>
            <input type="text" name="buying-price" class="form-control" placeholder="Unesite kupovnu cenu za proizvod" value="<?php echo set_value('buying-price', ''); ?>">
        </div>
        <div class="form-inline my-2">
            <label>Prodajna cena</label>
            <?php  if(form_error('selling-price')) echo '<div class="alert alert-warning">' . form_error('selling-price'). '</div>'; ?>
            <input type="text" name="selling-price" class="form-control" placeholder="Unesite prodajnu cenu za proizvod" value="<?php echo set_value('selling-price', ''); ?>">
        </div>
        <div class="form-inline my-2">
            <label>Kod prodavca</label>
            <?php  if(form_error('sellers-code')) echo '<div class="alert alert-warning">' . form_error('sellers-code'). '</div>'; ?>
            <input type="text" name="sellers-code" class="form-control" placeholder="Unesite kod prodavca za proizvod" value="<?php echo set_value('sellers-code', ''); ?>">
        </div>
        <div class="form-inline my-2">
            <label>Naziv kod prodavca</label>
            <?php  if(form_error('sellers-name')) echo '<div class="alert alert-warning">' . form_error('sellers-name'). '</div>'; ?>
            <input type="text" name="sellers-name" class="form-control" placeholder="Unesite naziv kod prodavza za proizvod" value="<?php echo set_value('sellers-name', ''); ?>">
        </div>
        <button class="btn mybutton" type="submit">Unesi proizvod</button>

        <?php echo form_close(); ?>
    </div>
</div>
