
<div class="container create-wrapper myshadow">
    <div class="create-header">
        <h4>Unesi novu fakturu</h4>
    </div>
    <?php echo form_open('invoices/create'); ?>
    <div class="row no-gutters p-3">
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Datum</label>
            <?php if (form_error('date')) {
        echo '<div class="alert alert-warning">' . form_error('date') . '</div>';
    }
    ?>
            <input type="text" id="date" name="date" class="form-control" value="<?php echo set_value('date', ''); ?>"
                placeholder="Izdavanja fakture">
        </div>
        <div class="col-sm-12 col-md-2 col-lg-2 p-2 d-flex align-items-center">
            <label>Predračun</label>
            <?php if (form_error('profaktura')) {
        echo '<div class="alert alert-warning">' . form_error('profaktura') . '</div>';
    }
    ?>
            <input type="checkbox" name="profaktura" class="form-control" value="accept">
        </div>
        <div class="col-sm-12 col-md-2 col-lg-2 p-2 d-flex align-items-center">
            <label>Avansni račun</label>
            <?php if (form_error('avans')) {
        echo '<div class="alert alert-warning">' . form_error('avans') . '</div>';
    }
    ?>
            <input type="checkbox" name="avans" class="form-control" value="accept">
        </div>
        <div class="col-sm-12 col-md-2 col-lg-2 p-2 d-flex align-items-center">
            <label>Konačni račun</label>
            <?php if (form_error('konacni')) {
        echo '<div class="alert alert-warning">' . form_error('konacni') . '</div>';
    }
    ?>
            <input type="checkbox" name="konacni" class="form-control" value="accept">
        </div>
        <div class="col-sm-12 col-md-2 col-lg-2 p-2 d-flex align-items-center">
            <label>Gotovinski račun</label>
            <?php if (form_error('gotovinski')) {
        echo '<div class="alert alert-warning">' . form_error('gotovinski') . '</div>';
    }
    ?>
            <input type="checkbox" name="gotovinski" class="form-control" value="accept">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Broj fakture</label>
            <?php if (form_error('inv-num')) {
        echo '<div class="alert alert-warning">' . form_error('inv-num') . '</div>';
    }
    ?>
            <input type="text" name="inv-num" id="inv-num" class="form-control"
                value="<?php echo set_value('inv-num', ''); ?>">
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Prodavac</label>
            <?php if (form_error('seller')) {
        echo '<div class="alert alert-warning">' . form_error('seller') . '</div>';
    }
    ?>
            <select name="seller" id="seller" class="form-control">
                <?php foreach ($companies as $key => $value): ?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Kupac</label>
            <?php if (form_error('buyer')) {
        echo '<div class="alert alert-warning">' . form_error('buyer') . '</div>';
    }
    ?>
            <select name="buyer" id="buyer" class="form-control">
                <?php foreach ($companies as $key => $value): ?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Valuta</label>
            <?php if (form_error('currency')) {
        echo '<div class="alert alert-warning">' . form_error('currency') . '</div>';
    }
    ?>
            <input type="text" name="currency" class="form-control" placeholder="Tri-slovna šifra"
                value="<?php echo set_value('currency', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Total</label>
            <?php if (form_error('total')) {
        echo '<div class="alert alert-warning">' . form_error('total') . '</div>';
    }
    ?>
            <input type="text" id="total" name="total" class="form-control"
                value="<?php echo set_value('total', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Rok za plaćanje</label>
            <?php if (form_error('pay-deadline')) {
        echo '<div class="alert alert-warning">' . form_error('pay-deadline') . '</div>';
    }
    ?>
            <input type="text" id="pay-deadline" name="pay-deadline" class="form-control" placeholder="Dana"
                value="<?php echo set_value('pay-deadline', ''); ?>">
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Popust</label>
            <?php if (form_error('discount')) {
        echo '<div class="alert alert-warning">' . form_error('discount') . '</div>';
    }
    ?>
            <input type="text" name="discount" class="form-control" placeholder="Popust(%)"
                value="<?php echo set_value('discount', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Napomena</label>
            <?php if (form_error('notes')) {
        echo '<div class="alert alert-warning">' . form_error('notes') . '</div>';
    }
    ?>
            <textarea type="text" name="notes" class="form-control" value=""></textarea>
        </div>
        <div class="col-sm-12 text-center">
            <button id="create-inv-btn" class="btn mybutton" type="submit">Kreiraj</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php if ($this->session->flashdata('invoice_created')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('invoice_created') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
<?php if ($this->session->flashdata('invoice_not_created')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('invoice_not_created') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
<?php if ($this->session->flashdata('invoice')) : ?>
<?php echo '<p>date</p>'; ?>

<p><?php echo $this->session->flashdata('invoice')['inv_num']; ?></p>
<?php endif;?>
<?php if ($this->session->flashdata('prenos')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('prenos') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>