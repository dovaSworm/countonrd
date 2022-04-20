<script>
    function confirmAction(id, object) {
        if (confirm("Da li želite obrisati kompaniju!")) {
            window.location = '<?php echo base_url(); ?>companies/delete/' + id;
        } else {}
    }
</script>
<div class="create-header">
    <h2>Kompanije</h2>
</div>
<div class="container d-flex justify-content-center">
    <div class="table-responsive">
        <table class="table table-striped m-auto">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Adresa</th>
                    <th>PIB</th>
                    <th>MB</th>
                    <th colspan="3" class="text-center">Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($companies as $key => $value) :; ?>
                    <tr>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['adress'] ?></td>
                        <td><?php echo $value['pib'] ?></td>
                        <td><?php echo $value['mb'] ?></td>
                        <td><input type="hidden" name="zabrisanje" value="<?php echo $value['id']; ?>"></td>
                        <td><button class="edit-item" type="submit" title="Izmeni"><a href="<?php echo base_url(); ?>companies/edit/<?php echo $value['id']; ?>"><i class="fas fa-pen"></i></a></button></td>
                        <td><button onclick="confirmAction(<?php echo $value['id']; ?>, this);" class="delete-item" title="Obriši" type="submit"><a><i class="fas fa-trash-alt"></i></a></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination-links d-flex justify-content-center">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>