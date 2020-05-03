<?php $user = $this->session->userdata('user_id');
if (!is_numeric($user)) {
    redirect('users/login');
}
?>
<div class="create-header">
    <h2>FAKTURE</h2>
</div>

<div class="container">
    <!-- <div class="row">
        <div class="col-sm-12 col-md-3"></div>
    </div> -->
    <div class="col-sm-12 table-responsive">
        <table class="table table-striped w-auto m-auto" id="mydata">
            <thead>
                <tr>
                    <th style="border: none;">Vrsta</th>
                    <th style="border: none;">Broj fakture</th>
                    <th style="width: 15%;">Prodavac</th>
                    <th style="width: 15%;">Kupac</th>
                    <th style="border: none;">Datum fakture</th>
                    <th style="border: none;">Datum dospeća</th>
                    <th style="border: none;">Ukupno za uplatu</th>
                    <th style="border: none;">Plaćeno</th>
                    <th style="border: none;">Duguje</th>
                    <th style="border: none;"  colspan="3" class="text-center">Akcije</th>
                    
                </tr>
            </thead>
            <tbody >
                <?php foreach ($invoices as $key => $value): ?>
                <input type="hidden"  class="form-control discount" value="'.$value['id'].'">
                <tr>
                    <td><?php 
                    if($value['profaktura'] == 1) {
                        echo "Profaktura";
                    }elseif($value['avans'] == 1){
                        echo "Avansni račun";
                    }else{
                        echo "Faktura";
                    }; ?></td>
                    <td><?php echo $value['inv_num']; ?></td>
                    <td><?php echo $value['sellername']; ?></td>
                    <td><?php echo $value['buyername']; ?></td>
                    <?php $date = date_create($value['date']); $dateformat = date_format($date, "d.m.Y.");?>
                    <td><?php echo $dateformat; ?></td>
                    <?php $date = date_create($value['pay_deadline']); $dateformat = date_format($date, "d.m.Y.");?>
                    <td><?php echo $dateformat; ?></td>
                    <td><?php echo $value['total']; ?></td>
                    <td><?php echo $value['payed']; ?></td>
                    <td><?php echo $value['due']; ?></td>
                    <td><button class="edit-item" type="submit" title="Izmeni"><a href="<?php echo base_url(); ?>invoices/view/<?php echo $value['id']; ?>"
                        class="btn-default"><i class="fas fa-pen"></i></a></button></td><td><button class="delete-item" title="Obriši" type="submit"><a href="<?php echo base_url(); ?>invoices/delete/<?php echo $value['id']; ?>"
                        ><i class="fas fa-trash-alt"></i></a></button>
                </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div class="pagination-links">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>