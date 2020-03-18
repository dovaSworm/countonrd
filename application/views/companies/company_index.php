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
<caption style="caption-side: top; font-weight: bold;" class="text-uppercase text-center">Kompanije</caption>
        <thead>
            <tr>
                <th >Naziv</th>
                <th  >Adresa</th>
                <th  >PIB</th>
                <th  >MB</th>
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
                <td><button class="edit-item" type="submit" title="Izmeni"><a href="<?php echo base_url(); ?>companies/edit/<?php echo $value['id']; ?>"
                            ><i class="fas fa-pen"></i></a></button></td><td><button class="delete-item" title="Obriši" type="submit"><a href="<?php echo base_url(); ?>companies/delete/<?php echo $value['id']; ?>"
                            ><i class="fas fa-trash-alt"></i></a></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
