<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="container-fluid">
    <div class="mytitle">
        <h6 class="text-center my-1">CountOn<img src="<?php echo base_url().'/assets/img/sivibek.svg' ;?>" alt=""></h6>
    </div>
    <h5>Datum ulaza: <?php echo $entry['date']; ?></h5>
    <h5><?php echo $entry['name']; ?></h5>

    <div class="row justify-content-around">
        <div class="entry-item-box">
            <?php echo form_open('entry/update_item/' . $entry['id']); ?>
            <div class="d-flex">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="my-2">
                        <label>Artikl</label>
                        <?php if (form_error('item')) {
            echo '<div class="alert alert-warning">' . form_error('item') . '</div>';
        }
        ?>
                        <select name="item"  id="item" class="form-control">
                            <?php foreach ($items as $key => $value): ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="my-2">
                        <label>Količina</label>
                        <input type="text" name="quantity" class="form-control"
                        value="<?php echo $value['quantity']; ?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="my-2">
                        <label>Valuta</label>
                        <?php if (form_error('currency')) {
                echo '<div class="alert alert-warning">' . form_error('currency') . '</div>';
            }
            ?>
                        <input type="text" name="currency" class="form-control" value="<?php echo set_value('currency', ''); ?>">
                    </div>
                    <div class="my-2">
                        <label>Vrednost devize u dinarima</label>
                        <?php if (form_error('exch-rate')) {
                echo '<div class="alert alert-warning">' . form_error('exch-rate') . '</div>';
            }
            ?>
                        <input type="text" name="exch-rate" class="form-control" value="<?php echo set_value('exch-rate', ''); ?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="my-2">
                        <label>Ulazna cena u devizama</label>
                        <?php if (form_error('buying-for')) {
                echo '<div class="alert alert-warning">' . form_error('buying-for') . '</div>';
            }
            ?>
                        <input type="text" name="buying-for" class="form-control" value="<?php echo set_value('buying-for', ''); ?>">
                    </div>
                    <div class="my-2">
                        <label>Ulazna cena u dinarima</label>
                        <?php if (form_error('buying-home')) {
                echo '<div class="alert alert-warning">' . form_error('buying-home') . '</div>';
            }
            ?>
                        <input type="text" name="buying-home" class="form-control" value="<?php echo set_value('buying-home', ''); ?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="my-2">
                        <label>Prodajna cena u dinarima</label>
                        <?php if (form_error('selling-home')) {
                echo '<div class="alert alert-warning">' . form_error('selling-home') . '</div>';
            }
            ?>
                        <input type="text" name="selling-home" class="form-control" value="<?php echo set_value('selling-home', ''); ?>">
                    </div>
                    <div class="my-2">
                        <label>Prodajna cena u evrima</label>
                        <?php if (form_error('selling-for')) {
                echo '<div class="alert alert-warning">' . form_error('selling-for') . '</div>';
            }
            ?>
                        <input type="text" name="selling-for" class="form-control" value="<?php echo set_value('selling-for', ''); ?>">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button id="add-entry-item" class="btn-sec" type="submit">Dodaj artikal za ulaz</button>
                    <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="col-sm-12 table-responsive table-striped table-borderless w-auto my-3">
        <table class="table" id="mydata">
            <thead>
                <tr>
                    <th>Šifra dobavljača</th>
                    <th>Šifra artikla</th>
                    <th>Naziv artikla</th>
                    <th>Ulazna cena deviza</th>
                    <th>Deviza</th>
                    <th>Kurs devize</th>
                    <th>Ulazna cena dinari</th>
                    <th>Izlazna cena dinari</th>
                    <th>Izlazna cena (evro)</th>
                    <th>Količina</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($entry_items as $key => $value): ;?>
                    <tr>
                        <td><?php echo $value['sellers_code']; ?></td>
                        <td><?php echo $value['code']; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['buying_for']; ?></td>
                        <td><?php echo $value['currency']; ?></td>
                        <td><?php echo $value['exch_rate']; ?></td>
                        <td><?php echo $value['buying_home']; ?></td>
                        <td><?php echo $value['selling_home']; ?></td>
                        <td><?php echo $value['selling_for']; ?></td>
                        <td><?php echo $value['quantity']; ?></td>
                        <?php echo form_open('entry/delete_item/' . $value['id'] . '/' . $entry['id']); ?><td>
                            <button title="Obriši" class="delete-item" type="submit"><i
                                    class="fas fa-trash-alt"></i></button></td><?php echo form_close(); ?>
                    </tr>

                    <?php endforeach;?>
                </tbody>
        </table>
    </div>
    <div class="text-center">
        <button class="my-2 btn-sec text-uppercase"><a href="<?php echo base_url() . 'entry/make_pdf/' . $entry['id']; ?>">Napravi pdf ulaz</a></button>
    </div>
</div>