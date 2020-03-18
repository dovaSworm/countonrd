<div class="mytitle">
    <img src="<?php echo base_url().'/assets/img/logo.png' ;?>" alt="">
    <h2 class="text-center my-1">COUNTONRD</h2>
</div>
<?php $user = $this->session->userdata('user_id');
if (!is_numeric($user)) {
    redirect('users/login');
}
?>
<div class="container">
    <div class="col-sm-12 table-responsive">
        <table class="table table-striped w-auto m-auto" id="mydata">
            <caption style="caption-side: top;" class="text-center my-3 text-uppercase">Fakture</caption>
            <thead>
                <tr>
                    <th style="border: none;">ID</th>
                    <th style="border: none;">Broj fakture</th>
                    <th style="border: none;">Prodavac</th>
                    <th style="border: none;">Kupac</th>
                    <th style="border: none;">Datum fakture</th>
                    <th style="border: none;">Ukupno za uplatu</th>
                    <th style="border: none;">Plaćeno</th>
                    <th style="border: none;">Duguje</th>
                </tr>
            </thead>
            <tbody >
                <?php foreach ($invoices as $key => $value): ?>
                    <input type="hidden"  class="form-control discount" value="'.$value['id'].'">
                    <tr><td><?php echo $value['id']; ?></td><td><?php echo $value['inv_num']; ?></td><td><?php echo $value['seller']; ?></td><td><?php echo $value['buyer']; ?></td>
                    <td><?php echo $value['date']; ?></td><td><?php echo $value['total']; ?></td><td><?php echo $value['payed']; ?></td>
                    <td><?php echo $value['due']; ?></td>
                    <td><button class="edit-item" type="submit" title="Izmeni"><a href="<?php echo base_url(); ?>invoices/view/<?php echo $value['id']; ?>"
                            class="btn-default"><i class="fas fa-pen"></i></a></button></td><td><button class="delete-item" title="Obriši" type="submit"><a href="<?php echo base_url(); ?>invoices/delete/<?php echo $value['id']; ?>"
                            ><i class="fas fa-trash-alt"></i></a></button>
                    </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="pagination-links">
                <?php echo $this->pagination->create_links(); ?>
            </div>

            </div>