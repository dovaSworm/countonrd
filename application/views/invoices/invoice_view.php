<?php $user = $this->session->userdata('user_id');
if (!is_numeric($user)) {
    redirect(base_url() . 'users/login');
}
?>
<script>
function findItems() {
    var itemName = document.getElementById('item-hint').value;
    var html =
        '<select name="item2" id="item2" class="form-control" onchange="showItem();" onfocus="this.selectedIndex = -1;">';
    console.log(itemName);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var hintItems = JSON.parse(this.responseText);
            // document.getElementById('hints').html = JSON.parse(this.responseText);
            document.getElementById('item').parentElement.style.display = "none";
            document.getElementById('item').parentElement.classList.remove("d-flex");
            document.getElementById('hints').style.display = "flex";
            // console.log(JSON.parse(this.responseText)[0]['id']);
            for (var i = 0; i < hintItems.length; i++) {
                console.log(hintItems[0].id);
                html += '<option value="' + hintItems[i].id + '">' + hintItems[i].name + '</option>';
            }
            html += '</select>';
            document.getElementById('hints').innerHTML = html;

        }
    }
    xmlhttp.open("GET", "<?php echo base_url(); ?>items/get_items_by_hint?hint=" + itemName, true);
    xmlhttp.send();
}
</script>
<?php if ($this->session->flashdata('invoice_created')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('invoice_created') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
<!-- <img src="https://github.com/dovaSworm/front-end/blob/master/Pipboy/img/angry.jpg?raw=true" alt=""> -->

    <div class="container create-wrapper myshadow">
        <div class="create-header">
            <h4>Izrada i modifikacija fakture</h4>
        </div>
        <div class="m-auto pl-4">
            <label>Vrsta dokumenta:</label>
            <?php if ($invoice['avans'] == 1): ?>
            <span class="text-uppercase">Avansni račun</span>
            <?php elseif ($invoice['profaktura'] == 1): ?>
            <span class="text-uppercase">Profaktura</span>
            <?php else: ?>
            <span class="text-uppercase">Faktura</span>
            <?php endif;?>
        </div>
        <?php echo form_open('invoices/update/' . $invoice['id']); ?>
        <div class="row no-gutters p-3">
            <div class="col-sm-12 col-md-4 col-lg-3 p-2">

                <label>Prodavac</label>
                <select name="seller" id="seller" class="form-control">
                    <?php foreach ($companies as $key => $value): ?>
                    <option value="<?= $value['id'] ?>" <?= $value['name']==$invoice['sellername']? "selected":""?>>
                        <?= $value['name'] ?> </option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                <label>Kupac</label>
                <select name="buyer" id="buyer" class="form-control">
                    <?php foreach ($companies as $key => $value): ?>
                    <option value="<?= $value['id'] ?>" <?= $value['name']==$invoice['buyername']? "selected":""?>>
                        <?= $value['name'] ?> </option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-3 p-2">
                <label>Broj fakture:</label><input class="form-control" type="text" name="inv-num" id="inv-num"
                    size="10" value="<?php echo $invoice['inv_num']; ?>">
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2"><label>Datum:</label><input class="form-control" type="text"
                    size="10" name="date" id="date" value="<?php echo $invoice['date']; ?>"></div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2"><label>Rok plaćanja:</label><input class="form-control"
                    type="text" size="10" name="pay-deadline" id="pay-deadline"
                    value="<?php echo $invoice['pay_deadline']; ?>">
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2"><label>Popust:</label><input class="form-control" type="text"
                    name="discount" id="discount" size="10" value="<?php echo $invoice['discount']; ?>"></div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2"><label class="text-uppercase font-weight-bold">Za uplatu:
                </label>
                <div class="form-control"><?php echo $invoice['total']; ?></div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2"><label class="text-uppercase font-weight-bold">Plaćeno:</label>
                <div class="form-control"><?php echo $invoice['payed']; ?></div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2"><label class="text-uppercase font-weight-bold">Plati
                    sad:</label><input class="form-control" type="text" name="payed" size="10" value=""></div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2"><label class="text-uppercase font-weight-bold">Duguje:</label>
                <div class="form-control"><?php echo $invoice['due']; ?></div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2"><label>Slovima:</label><input class="form-control" type="text"
                    name="letters" value="<?php echo $invoice['letters']; ?>"></div>
            <div class="col-sm-12 col-md-4 col-lg-3 p-2"><label>Napomena:</label><textarea class="form-control"
                    type="text" name="notes" value=""><?php echo $invoice['notes']; ?></textarea></div>
            <div class="text-center col-sm-12"><button id="edit-invoice" class="add-item" type="submit">Snimi
                    izmene</button></div>
            <?php echo form_close(); ?>
        </div>
        <!--row -->
        <div class="inv-item-box">
            <?php echo form_open('invoice_items/create/' . $invoice['id']); ?>
            <div class="row align-items-center no-gutters">
                <div class="input-wrapper col-sm-12 col-md-6 text-center my-3">
                    <label>Nađi artikal</label>
                    <input type="text" class="form-control" id="item-hint" name="item-hint" oninput="findItems();">
                </div>
                <div class="input-wrapper col-sm-12 text-center col-md-6 " id="hints">
                </div>
                <div class="input-wrapper text-center col-sm-12 col-md-6">
                    <label>Dodaj artikal</label>
                    <?php if (form_error('item')) {
        echo '<div class="alert alert-warning">' . form_error('item') . '</div>';
    }?>
                    <div class="d-flex">
                        <select name="item" id="item" class="form-control">
                            <?php foreach ($items as $key => $value): ?>
                            <option value="<?php echo $item = $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php endforeach;?>
                        </select>
                        <button title="Add article" id="add-item-btn"
                            class="ml-2 btn bnt-primary text-primary text-uppercase" type="submit"><i
                                class="fas fa-plus"></i></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<div id="entry-table" class="container-fluid p-1 p-md-3 mb-5">
    <div class="table-responsive table-striped table-borderless w-auto my-3">
        <table class="table">
            <thead>
                <tr>
                    <th>rb</th>
                    <th>Naziv</th>
                    <th>Cena</th>
                    <th>Količina</th>
                    <th>Jed. mere</th>
                    <th>Popust(%)</th>
                    <th>Ukupna cena</th>
                    <th>Poreska osnovica</th>
                    <th>Iznos PDV-a</th>
                    <th>Ukupan iznos</th>
                </tr>
            </thead>
            <?php if ($this->session->flashdata('invoiceitem_created')): ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('invoiceitem_created') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
            <?php endif;?>
            <tbody>
                <?php $rb = 1;foreach ($invoice_items as $key => $value): ;?>
                <?php echo form_open('invoice_items/update/' . $value['id']); ?>
                <tr>
                    <td> <?php echo $rb; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><input type="text" name="price" class="price" size="7" value="<?php echo $value['price']; ?>">
                    </td>
                    <td><input type="text" name="quantity" class="quantity" size="3"
                            value="<?php echo $value['quantity']; ?>"></td>
                    <td><?php echo $value['mes_unit']; ?></td>
                    <td><input type="text" name="it-disc" class="it_disc" size="7"
                            value="<?php echo $value['it_disc']; ?>"></td>
                    <?php
    $widhout_tax = $value['quantity'] * $value['price'] - ($value['quantity'] * $value['price'] * ($value['it_disc'] / 100));
    $tax_total = $widhout_tax * ($value['tax'] / 100);
    $with_tax = ($value['price'] + ($value['price'] * ($value['tax'] / 100))) * $value['quantity'];
    ?>
                    <td><?php echo number_format($widhout_tax,2); ?></td>
                    <td><input type="text" name="tax" class="tax" size="3" value="<?php echo $value['tax']; ?>">
                    </td>
                    <td><?php echo number_format($tax_total,2); ?></td>
                    <td><?php echo number_format($value['total'],2); ?></td>
                    <td><button title="Izmeni" class="edit-item" type="submit"><i
                                class="fas fa-pen"></i></button><?php echo form_close(); ?><input type="hidden"
                            class="form-control" value="'<?php echo $value['id']; ?>'"></td>
                    <?php echo form_open('invoice_items/delete/' . $value['id'] . '/' . $invoice['id']); ?><td>
                        <button title="Obriši" class="delete-item" type="submit"><i
                                class="fas fa-trash-alt"></i></button></td><?php echo form_close(); ?>
                </tr>

                <?php $rb++;endforeach;?>

                <tr class="font-weight-bold"><strong><?php echo $html_total; ?></strong></tr>
            </tbody>
        </table>
    </div>
    <div class="text-center">
        <a class="my-3 btn-sec" href="<?php echo base_url() . 'invoices/make_pdf/' . $invoice['id']; ?>">Napravi pdf
            fakturu</a>
    </div>
</div><!-- faktura -->