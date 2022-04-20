<script>
    function showHint(str) {
        if (str.length == 0) {
            window.location.href = "<?php echo base_url(); ?>items/index";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                    document.getElementById("items").style.display = "none";
                }
            }
            xmlhttp.open("GET", "<?php echo base_url(); ?>items/get_items_like?q=" + str, true);
            xmlhttp.send();
        }
    }

    function confirmAction(id, object) {
        if (confirm("Da li želite obrisati artikal!")) {
            window.location = '<?php echo base_url(); ?>items/delete/' + id;
        } else {}
    }
</script>
<div class="create-header">
    <h2>Artikli</h2>
</div>
<?php if ($this->session->flashdata('item_deleted')) : ?>
    <?php echo '<p class="alert alert-success">' . $this->session->flashdata('item_deleted') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif; ?>
<div class="article container">
    <div class="table-responsive">
        <div class="search">
            <h6 class="text-left">Pretraži artikle</h6>
            <form><label for="hint-inp">Unesi naziv</label> <input id="hint-inp" type="text" onkeyup="showHint(this.value)"></form>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Šifra</th>
                    <th>Vrsta</th>
                    <th>Jedinica mere</th>
                    <th>Količina</th>
                    <th class="number">Ulazna cena</th>
                    <th class="number">Prodajna cena</th>
                    <th>Šifra Dobavljača</th>
                    <th colspan="3" class="text-center">Akcije</th>
                </tr>
            </thead>
            <tbody id="txtHint"></tbody>
            <tbody id="items">
                <?php foreach ($items as $key => $value) :; ?>
                    <tr>
                        <?php if ($value['group_id'] == 1) {
                            $group = "Artikal";
                        } else {
                            $group = "Usluga";
                        }; ?>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['code'] ?></td>
                        <td><?php echo  $group ?></td>
                        <td><?php echo $value['mes_unit'] ?></td>
                        <td class="number"><?php echo $value['quantity'] ?></td>
                        <td class="number"><?php echo $value['buying_price'] ?></td>
                        <td class="number"><?php echo $value['selling_price'] ?></td>
                        <td><?php echo $value['sellers_code'] ?></td>
                        <td><input type="hidden" name="zabrisanje" value="<?php echo $value['id']; ?>"></td>
                        <td><button class="edit-item" type="submit" title="Izmeni"><a href="<?php echo base_url(); ?>items/edit/<?php echo $value['id']; ?>" class="btn-default"><i class="fas fa-pen"></i></a></button></td>
                        <td><button onclick="confirmAction(<?php echo $value['id']; ?>, this);" class="delete-item" type="submit" title="Obriši"><a ><i class="fas fa-trash-alt"></i></a></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination-links d-flex justify-content-center">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
    <br>
</div>