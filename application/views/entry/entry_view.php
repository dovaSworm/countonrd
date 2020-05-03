<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<script>
function showItem() {
    var itemId = document.getElementById('item').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('priceIn').value = JSON.parse(this.responseText).buying_price;
            document.getElementById('priceOut').value = JSON.parse(this.responseText).selling_price;
        }
    }
    xmlhttp.open("GET", "<?php echo base_url(); ?>items/get_items_for_entry?id=" + itemId, true);
    xmlhttp.send();

}

function findItems() {
    var itemName = document.getElementById('item-hint').value;
    var html =
        '<label for="item2">Dodaj artikal</label><select name="item2" id="item2" class="form-control" onchange="showItem();" onfocus="this.selectedIndex = -1;">';
    console.log(itemName);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var hintItems = JSON.parse(this.responseText);
            // document.getElementById('hints').html = JSON.parse(this.responseText);
            document.getElementById('item').parentElement.style.display = "none";
            document.getElementById('hints').style.display = "flex";
            // console.log(JSON.parse(this.responseText)[0]['id']);
            for (var i = 0; i < hintItems.length; i++) {
                console.log(hintItems[0].id);
                html += '<option value="' + hintItems[i].id + '">' + hintItems[i].code + '</option>';
            }
            html += '</select>';
            document.getElementById('hints').innerHTML = html;

        }
    }
    xmlhttp.open("GET", "<?php echo base_url(); ?>items/get_items_by_code?hint=" + itemName, true);
    xmlhttp.send();
}
</script>

<div class="create-header">
    <h4>ULAZ I KALKULACIJA CENA</h4>
</div>
<div class="container entry">
    <?php if ($this->session->flashdata('info')): ?>
    <?php echo '<p class="alert alert-warning">' . $this->session->flashdata('info') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
    <?php endif;?>
    <div id="entry-data" class="row no-gutters">
        <?php echo form_open('entry/credit/'.$entry['id']); ?>
        <div class="d-flex flex-wrap">
            <div class="px-3 col-12">
                <h6>Unesi novi ili izmeni postojeći ulaz</h6>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4  my-2">
                <?php if (form_error('date')) {
        echo '<div class="alert alert-warning">' . form_error('date') . '</div>';
        }
        ?>
                <label for="date">Datum</label>
                <input type="text" id="date" name="date" class="form-control" value="<?php echo $entry['date']; ?>"
                    placeholder="Datum">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4  my-2">
                <?php if (form_error('date')) {
        echo '<div class="alert alert-warning">' . form_error('date') . '</div>';
        }
        ?><label for="name">Naziv</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $entry['name']; ?>"
                    placeholder="Naziv">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 align-self-end text-center my-2">
                <button id="create-entry-btn" class="mybutton btn" type="submit">Kreiraj/Izmeni</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="entry-item-box">
        <?php echo form_open('entry/update_item/' . $entry['id']); ?>
        <div class="row align-items-center no-gutters">
            <div class="input-wrapper col-sm-12 col-md-6 pr-md-5 my-3">
                <label>Nađi artikal</label>
                <input type="text" class="form-control" id="item-hint" name="item-hint" oninput="findItems();">
            </div>
            <div class="input-wrapper col-sm-12 col-md-6 pl-md-2">
                <label class="mr-md-3">Pripremi artikal</label>
                <?php if (form_error('item')) {
            echo '<div class="alert alert-warning">' . form_error('item') . '</div>';
        }
        ?>
                <select name="item" id="item" class="form-control" onchange="showItem();"
                    onfocus="this.selectedIndex = -1;">
                    <?php foreach ($items as $key => $value): ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['code']; ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="input-wrapper col-sm-12 col-md-6" id="hints">

            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap">
        <div class="col-sm-12 col-md-4 col-lg-3 mb-4">
            <label>Količina</label>
            <input type="text" name="quantity" class="form-control" value="<?php echo set_value('quantity', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 mb-4">
            <label>Valuta</label>
            <?php if (form_error('currency')) {
                echo '<div class="alert alert-warning">' . form_error('currency') . '</div>';
            }
            ?>
            <input type="text" name="currency" class="form-control" value="<?php echo set_value('currency', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 mb-4">
            <label>Vrednost devize u dinarima</label>
            <?php if (form_error('exch-rate')) {
                echo '<div class="alert alert-warning">' . form_error('exch-rate') . '</div>';
            }
            ?>
            <input type="text" name="exch-rate" class="form-control" value="<?php echo set_value('exch-rate', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 mb-4">
            <label>Ulazna cena u devizama</label>
            <?php if (form_error('buying-for')) {
                echo '<div class="alert alert-warning">' . form_error('buying-for') . '</div>';
            }
            ?>
            <input type="text" name="buying-for" class="form-control"
                value="<?php echo set_value('buying-for', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 mb-4">
            <label>Ulazna cena u dinarima</label>
            <?php if (form_error('buying-home')) {
                echo '<div class="alert alert-warning">' . form_error('buying-home') . '</div>';
            }
            ?>
            <input id="priceIn" type="text" name="buying-home" class="form-control"
                value="<?php echo set_value('buying-home', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 mb-4">
            <label>Prodajna cena u dinarima</label>
            <?php if (form_error('selling-home')) {
                echo '<div class="alert alert-warning">' . form_error('selling-home') . '</div>';
            }
            ?>
            <input id="priceOut" type="text" name="selling-home" class="form-control"
                value="<?php echo set_value('selling-home', ''); ?>">
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 mb-4">
            <label>Prodajna cena u evrima</label>
            <?php if (form_error('selling-for')) {
                echo '<div class="alert alert-warning">' . form_error('selling-for') . '</div>';
            }
            ?>
            <input type="text" name="selling-for" class="form-control"
                value="<?php echo set_value('selling-for', ''); ?>">
        </div>
    </div>
    <div class="col-sm-12 w-100 my-3 text-center">
        <button id="" class="add-item" type="submit">Dodaj artikal</button>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="entry-table" class="container-fluid p-1 w-100 mb-5">
    <div class="table-responsive table-striped table-borderless my-3">
        <table class="table">
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
        <a class="my-2 btn-sec text-uppercase"
            href="<?php echo base_url() . 'entry/make_pdf/' . $entry['id']; ?>">Napravi pdf ulaz</a>
    </div>
</div>