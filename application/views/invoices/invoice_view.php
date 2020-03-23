<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect(base_url().'users/login');
    }    
?>

<!-- <img src="https://github.com/dovaSworm/front-end/blob/master/Pipboy/img/angry.jpg?raw=true" alt=""> -->
<div class="container-fluid">
<div class="mytitle">
    <h6 class="text-center my-1">CountOn<img src="<?php echo base_url().'/assets/img/sivibek.svg' ;?>" alt=""></h6>
</div>
    <div class="my-table">
        <div class="row no-gutters">
            <div class="col-sm-12 col-md-4 bg-light p-4">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-center text-bold p-4">Prodavac</th>
                        </tr>
                    </thead>
                    <tbody id="byerId">
                        <tr>
                            <td><?php echo $invoice['sellername']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $invoice['sellerpib']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $invoice['selleradress']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $invoice['sellercity']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $invoice['sellerzip']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $invoice['selleraccount']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12 col-md-4 bg-light p-4">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-center text-bold p-4">Kupac</th>
                        </tr>
                    </thead>
                    <tbody id="byerId">
                        <tr>
                            <td><?php echo $invoice['buyername']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $invoice['buyerpib']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $invoice['buyeradress']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $invoice['buyercity']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $invoice['buyerzip']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-12 col-md-4">
                <?php echo form_open('invoices/update/' . $invoice['id']); ?>
                <table class="table table-borderless m-4">
                    <thead>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>Tip</td>
                                    <?php if ($invoice['avans'] == 1): ?>
        
                                    <td class="text-uppercase">Avansni račun</td>
        
                                    <?php elseif ($invoice['profaktura'] == 1): ?>
                                    <td class="text-uppercase">Profaktura</td>
                                    <?php else: ?>
                                    <td class="text-uppercase">Faktura</td>
                                    <?php endif;?>
                                </tr>
                        <tr>
                            <td>Datum: </td>
                            <td><input type="text" name="date" id="date" 
                                    value="<?php echo $invoice['date']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Broj fakture: </td>
                            <td><?php echo $invoice['inv_num']; ?> </td>
                        </tr>
                        <tr>
                            <td>Popust </td>
                            <td><input type="text" name="discount" id="discount" size="5"
                                    value="<?php echo $invoice['discount']; ?>"></td>
                        <tr>
                            <td class="text-uppercase">Ukupno za uplatu</td>
                            <td><?php echo $invoice['total']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-uppercase">Plaćeno</td>
                            <td><?php echo $invoice['payed']; ?></td>
                        </tr>
                        <tr>
                            <td>Plati sad</td>
                            <td><input type="text" name="payed" value=""></td>
                        </tr>
                        <tr>
                            <td class="text-uppercase">Duguje</td>
                            <td><?php echo $invoice['due']; ?></td>
                        </tr>
                        <?php if (($invoice['avans'] == 1) or ($invoice['profaktura'] == 1)): ?>
                        <tr>
                            <td>Rok plaćanja: </td>
                            <td><input type="text" name="pay-deadline" id="pay-deadline" size="10"
                                    value="<?php echo $invoice['pay_deadline']; ?>"></td>
                        </tr>

                        <?php endif;?>
                        <tr>
                            <td></td>
                            <td class="text-center"><button id="edit-invoice"
                                    class="btn-sec text-uppercase" type="submit">Snimi izmene</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!--row -->

        <?php if ($invoice['avans'] == 0): ?>
        <div class="col-sm-12 my-2 py-1 bg-light">
            <?php echo form_open('invoice_items/create/' . $invoice['id']); ?>
            <div class="form-inline p-2">
                <label>Dodaj artikal na fakturu</label>
                <?php if (form_error('item')) {
                echo '<div class="alert alert-warning">' . form_error('item') . '</div>';
                }?>
                <div class="row no-gutters d-inline-flex">
                    <select name="item" id="item">
                        <?php foreach ($items as $key => $value): ?>
                        <option value="<?php echo $item = $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php endforeach;?>
                    </select>
                    <button title="Add article" id="add-item-btn" class="ml-2 btn-default text-primary text-uppercase"
                        type="submit"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>

        <div class="col-sm-12 table-responsive table-striped table-borderless w-auto my-3">
            <table class="table" id="mydata">
                <thead>
                    <tr>
                        <th>Kod</th>
                        <th>Naziv</th>
                        <th>Jedinica mere</th>
                        <th>Količina</th>
                        <th>Poreska osnova</th>
                        <th>Cena</th>
                        <th>Ukupno poreza</th>
                        <th>Bez poreza</th>
                        <th>Ukupno sa porezom</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($invoice_items as $key => $value): ;?>
                    <?php echo form_open('invoice_items/update/' . $value['id']); ?>
                    <tr>
                        <td> <?php echo $value['sellers_code'];?></td>
                        <td><?php echo $value['name'] ;?></td>
                        <td><?php echo $value['mes_unit'] ;?></td>
                        <td><input type="text" name="quantity" class="quantity" size="3"
                                value="<?php echo $value['quantity'] ;?>"></td>
                        <td><input type="text" name="tax" class="tax" size="3" value="<?php echo$value['tax'] ;?>"></td>
                        <td><input type="text" name="price" class="price" size="7"
                                value="<?php echo $value['price'] ;?>"></td>
                        <?php $tax_total  = $value['quantity']* $value['price']*($value['tax']/100); 
                                 $widhout_tax = $value['quantity']*$value['price'];
                                 $with_tax = ($value['price'] + ($value['price']*($value['tax']/100)))*$value['quantity'];
                           ?>
                        <td><?php echo $tax_total ;?></td>
                        <td><?php echo $widhout_tax ;?></td>
                        <td><?php echo $with_tax ;?></td>
                        <td><button title="Izmeni" class="edit-item" type="submit"><i
                                    class="fas fa-pen"></i></button><?php echo form_close(); ?><input type="hidden"
                                class="form-control" value="'<?php echo $value['id'] ;?>'"></td>
                        <?php echo form_open('invoice_items/delete/' . $value['id'] . '/' . $invoice['id']); ?><td>
                            <button title="Obriši" class="delete-item" type="submit"><i
                                    class="fas fa-trash-alt"></i></button></td><?php echo form_close(); ?>
                    </tr>

                    <?php endforeach; ?>

                    <?php echo $html_total; ?>

                    
                </tbody>
            </table>
        </div>
        <?php endif;?>
        <div class="bg-light p-2 my-3"><strong>Napomena:</strong> <?php echo $invoice['notes'];?></div>
        <div class="text-center">
            <button class="my-3 btn-sec text-uppercase"><a href="<?php echo base_url() . 'invoices/make_pdf/' . $invoice['id']; ?>">Napravi pdf fakturu</a></button>                
        </div>
    </div><!-- faktura -->
</div><!-- container -->
<?php if ($this->session->flashdata('invoiceitem_created')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('invoiceitem_created') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
