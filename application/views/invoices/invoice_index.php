<div class="create-header">
    <h2>FAKTURE</h2>
</div>

<div class="container">
    <div class="table-responsive p-1 p-md-0">
        <table class="table table-striped" id="mydata">
            <thead>
                <tr>
                    <th>Vrsta</th>
                    <th>Broj fakture</th>
                    <th style="width: 15%;">Prodavac</th>
                    <th style="width: 15%;">Kupac</th>
                    <th>Datum fakture</th>
                    <th>Datum dospeća</th>
                    <th class="number">Ukupno za uplatu</th>
                    <th class="number">Plaćeno</th>
                    <th class="number">Duguje</th>
                    <th  colspan="3" class="text-center">Akcije</th>
                    
                </tr>
            </thead>
            <tbody >
                <?php foreach ($invoices as $key => $value): ?>
                <input type="hidden"  class="form-control discount" value="'.$value['id'].'">
                <tr>
                    <td><?php 
                    if($value['profaktura'] == 1) {
                        echo "Predračun";
                    }elseif($value['avans'] == 1){
                        echo "Avansni račun";
                    }elseif($value['konacni'] == 1){
                        echo "Konačni račun";
                    }elseif($value['gotovinski'] == 1){
                        echo "Gotovinski račun";
                    }else{
                        echo "Račun";
                    }; ?></td>
                    <td><?php echo $value['inv_num']; ?></td>
                    <td><?php echo $value['sellername']; ?></td>
                    <td><?php echo $value['buyername']; ?></td>
                    <?php $date = date_create($value['date']); $dateformat = date_format($date, "d.m.Y.");?>
                    <td><?php echo $dateformat; ?></td>
                    <?php $date = date_create($value['pay_deadline']); $dateformat = date_format($date, "d.m.Y.");?>
                    <td><?php echo $dateformat; ?></td>
                    <td class="number"><?php echo $value['total']; ?></td>
                    <td class="number"><?php echo $value['payed']; ?></td>
                    <td class="number"><?php echo $value['due']; ?></td>
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