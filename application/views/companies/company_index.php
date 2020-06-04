<div class="create-header">
    <h2>Kompanije</h2>
</div>
<div class="container d-flex justify-content-center">
    <div class="table-responsive">
    <table class="table table-striped w-auto m-auto">
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
            <?php foreach ($companies as $key => $value): ;?>
            <tr>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['adress'] ?></td>
                <td><?php echo $value['pib'] ?></td>
                <td><?php echo $value['mb'] ?></td>
                <td><input type="hidden" name="zabrisanje" value="<?php echo $value['id']; ?>"></td>
                <td><button class="edit-item" type="submit" title="Izmeni"><a
                            href="<?php echo base_url(); ?>companies/edit/<?php echo $value['id']; ?>"><i
                                class="fas fa-pen"></i></a></button></td>
                <td><button class="delete-item" title="Obriši" type="submit"><a
                            href="<?php echo base_url(); ?>companies/delete/<?php echo $value['id']; ?>"><i
                                class="fas fa-trash-alt"></i></a></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>