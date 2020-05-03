<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="mytitle">
    <h6 class="text-center my-1">CountOn<img src="<?php echo base_url().'/assets/img/sivibek.svg' ;?>" alt=""></h6>
</div>
<h4 class="text-center my-3">Izmeni ulaz</h4>
<div class="container d-flex justify-content-center">
<?php echo form_open('entry/update/' . $entry['id']); ?>
    <input type="hidden" name="id" value="<?php echo $entry['id']; ?>">
    <div class="form-inline my-2">
        <label>Naziv</label>
        <?php  if(form_error('name')) echo '<div class="alert alert-warning">' . form_error('name'). '</div>'; ?> 
        <input type="text" name="name" class="form-control" value="<?php echo $entry['name']; ?>" placeholder="Unesit naziv ulaza">
    </div>
    <div class="form-inline my-2">
        <label>Datum</label>
        <?php if (form_error('date')) {
        echo '<div class="alert alert-warning">' . form_error('date') . '</div>';
    }
    ?>
        <input type="text" id="date" name="date" class="form-control" value="<?php echo $entry['date']; ?>" placeholder="ulaza">
    </div>
    <div class="text-center">
        <button class="btn mybutton" type="submit">Snimi izmene</button>
    </div>
<?php echo form_close(); ?>
</div>