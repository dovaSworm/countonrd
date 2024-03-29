<script>
    function confirmAction(id, object) {
        if (confirm("Da li želite obrisati ulaz!")) {
            window.location = '<?php echo base_url(); ?>entry/delete/' + id;
        } else {}
    }
</script>
<div class="create-header">
    <h2>Ulazi</h2>
</div>
<div id="entry-table" class="container">
    <div class="table-responsive">
        <table class="table table-striped m-auto">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Datum</th>
                    <th colspan="4" class="text-center">Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entries as $key => $value) :; ?>
                    <?php $id = $value['id']; ?>
                    <tr>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['date'] ?></td>
                        <td><input type="hidden" name="zabrisanje" value="<?php echo $value['id']; ?>"></td>
                        <td><button class="view-item" type="submit" title="Pogledaj"><a href="<?php echo base_url() . 'entry/view/' .  $value['id']; ?>"><i class="far fa-eye"></a></i></button></td>
                        <td><button class="edit-item" type="submit" title="Izmeni"><a href="<?php echo base_url() . 'entry/view/' .  $value['id']; ?>"><i class="fas fa-pen"></a></i></button></td>
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