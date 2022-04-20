<div class="container entry myshadow">
    <div class="create-header">
        <h4>ULAZ I KALKULACIJA CENA</h4>
    </div>
    <?php if ($this->session->flashdata('info')) : ?>
        <?php echo '<p class="alert alert-warning">' . $this->session->flashdata('info') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
    <?php endif; ?>
    <div class="row no-gutters">
        <?php echo form_open('entry/create_new_entry/'); ?>
        <div class="d-flex flex-wrap">
            <div class="px-3 col-12 font-italic">
                <h6>Unesi novi ulaz</h6>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4  my-2">
                <?php if (form_error('date')) {
                    echo '<div class="alert alert-warning">' . form_error('date') . '</div>';
                }
                ?>
                <label for="date">Datum</label>
                <input type="text" id="date" name="date" class="form-control" value="" placeholder="Datum">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4  my-2">
                <?php if (form_error('date')) {
                    echo '<div class="alert alert-warning">' . form_error('date') . '</div>';
                }
                ?><label for="name">Naziv</label>
                <input type="text" id="name" name="name" class="form-control" value="" placeholder="Naziv">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 align-self-end text-center my-2">
                <button id="create-entry-btn" class="mybutton btn" type="submit">Kreiraj</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>