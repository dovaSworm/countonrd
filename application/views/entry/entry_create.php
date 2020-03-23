<?php $user = $this->session->userdata('user_id');
if (!is_numeric($user)) {
    redirect('users/login');
}
?>
<div class="mytitle">
    <h6 class="text-center my-1">CountOn<img src="<?php echo base_url().'/assets/img/sivibek.svg' ;?>" alt=""></h6>
</div>
<h4 class="text-center my-2">Kalkulacija cena</h4>
<div class="container d-flex justify-content-center">
    <div class="row">
        <?php echo form_open('entry/create'); ?>
        <div class="form-inline my-2">
            <?php if (form_error('date')) {
        echo '<div class="alert alert-warning">' . form_error('date') . '</div>';
        }
        ?>
            <input type="text" id="date" name="date" class="form-control" value="<?php echo set_value('date', ''); ?>" placeholder="Datum">
        </div>
        <small class="form-text text-muted">
        Datumn u formatu GGGG-MM-DD (2000-02-22)
        </small>
        <div class="form-inline my-2">
            <?php if (form_error('name')) {
        echo '<div class="alert alert-warning">' . form_error('name') . '</div>';
        }
        ?>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo set_value('name', ''); ?>" placeholder="Naziv">
        </div>
        <div class="text-center">
            <button id="create-entry-btn" class="btn mybutton" type="submit">Kreiraj kalkulaciju cena</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>