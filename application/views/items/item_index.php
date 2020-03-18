<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>

<div class="mytitle">
    <img src="<?php echo base_url().'/assets/img/logo.png' ;?>" alt="">
    <h2 class="text-center my-1">COUNTONRD</h2>
</div>
<div class="container d-flex justify-content-center">
    <table class="table table-striped w-auto m-auto">
        <caption style="caption-side: top;" class="text-uppercase text-center text-bold">Artikli</caption>
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Šifra</th>
                <th>Vrsta</th>
                <th>Jedinica mere</th>
                <th>Količina</th>
                <th>Prodajna cena</th>
                <th>Kupovna cena</th>
                <th>Šifra prodavca</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $key => $value): ;?>
            <tr>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['code'] ?></td>
                <td><?php echo $value['groupname'] ?></td>
                <td><?php echo $value['mes_unit'] ?></td>
                <td><?php echo $value['quantity'] ?></td>
                <td><?php echo $value['selling_price'] ?></td>
                <td><?php echo $value['buying_price'] ?></td>
                <td><?php echo $value['sellers_code'] ?></td>
                <td><input type="hidden" name="zabrisanje" value="<?php echo $value['id']; ?>"></td>
                <td><button class="edit-item" type="submit" title="Izmeni"><a href="<?php echo base_url(); ?>items/edit/<?php echo $value['id']; ?>"
                            class="btn-default"><i class="fas fa-pen"></i></a></button></td><td><button class="delete-item" type="submit" title="Obriši"><a href="<?php echo base_url(); ?>items/delete/<?php echo $value['id']; ?>"
                            ><i class="fas fa-trash-alt"></i></a></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<br>

<?php if ($this->session->flashdata('item_edited')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('item_edited') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
<?php if ($this->session->flashdata('item_deleted')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('item_deleted') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
</div>
