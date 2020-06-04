<div class="container create-wrapper myshadow">
    <div class="create-header">
        <h4>Unesi novi artikal</h4>
    </div>
    <?php echo form_open('items/create'); ?>
<div class="row no-gutters p-3">
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>Groupa proizvoda</label>
        <?php  if(form_error('group-id')) echo '<div class="alert alert-warning">' . form_error('group-id'). '</div>'; ?> 
        <select name="group-id" id="" class="form-control">
            <?php foreach($groups as $group): ?>
            <option value="<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>Naziv</label>
        <?php  if(form_error('name')) echo '<div class="alert alert-warning">' . form_error('name'). '</div>'; ?> 
        <input type="text" name="name" class="form-control" value="<?php echo set_value('name', ''); ?>" placeholder="Proizvoda">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>Kod proizvoda</label>
        <?php  if(form_error('code')) echo '<div class="alert alert-warning">' . form_error('code'). '</div>'; ?>
        <input type="text" name="code" class="form-control" placeholder="Šifra" value="<?php echo set_value('code', ''); ?>">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>Jedinica mere</label>
        <?php  if(form_error('mes-unit')) echo '<div class="alert alert-warning">' . form_error('mes-unit'). '</div>'; ?>
        <input type="text" name="mes-unit" class="form-control" placeholder="kom ili rs" value="<?php echo set_value('mes-unit', ''); ?>">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>PDV</label>
        <?php  if(form_error('tax')) echo '<div class="alert alert-warning">' . form_error('tax'). '</div>'; ?>
        <input type="text" name="tax" class="form-control" placeholder="Poreska osnova" value="<?php echo set_value('tax', '20'); ?>">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>Kupovna cena</label>
        <?php  if(form_error('buying-price')) echo '<div class="alert alert-warning">' . form_error('buying-price'). '</div>'; ?>
        <input type="text" name="buying-price" class="form-control" value="<?php echo set_value('buying-price', ''); ?>">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>Prodajna cena</label>
        <?php  if(form_error('selling-price')) echo '<div class="alert alert-warning">' . form_error('selling-price'). '</div>'; ?>
        <input type="text" name="selling-price" class="form-control" value="<?php echo set_value('selling-price', ''); ?>">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>Kod prodavca</label>
        <?php  if(form_error('sellers-code')) echo '<div class="alert alert-warning">' . form_error('sellers-code'). '</div>'; ?>
        <input type="text" name="sellers-code" class="form-control" placeholder="Šifra za poručivanje" value="<?php echo set_value('sellers-code', ''); ?>">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>Naziv kod prodavca</label>
        <?php  if(form_error('sellers-name')) echo '<div class="alert alert-warning">' . form_error('sellers-name'). '</div>'; ?>
        <input type="text" name="sellers-name" class="form-control" placeholder="Naziv artikla za poručivanje" value="<?php echo set_value('sellers-name', ''); ?>">
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <label>Opis proizvod</label>
        <?php  if(form_error('description')) echo '<div class="alert alert-warning">' . form_error('description'). '</div>'; ?> 
        <textarea rows="4" cols="21" type="text" name="description" class="form-control" value="<?php echo set_value('description', ''); ?>"></textarea>
    </div>
    <div class="col-sm-12 text-center">
        <button class="btn mybutton" type="submit">Unesi proizvod</button>
    </div>
    <?php echo form_close(); ?>
</div>
</div>