/* background: url("<?php echo base_url()."/assets/img/prologobek.png"; ?>") no-repeat; */
 

        $(document).on('click','.edit-item',function(){
        // var invoiceTotal = $("#inv-total").val() ;
        var itemId = $(this).next().val();
        var quantity = $(this).parents('tr').find("input.quantity").val();
        var tax = $(this).parents('tr').find("input.tax").val();
        $.post("<?php echo base_url(); ?>invoice_items/update/"+ itemId, { quantity: quantity, tax: tax}, function(data) {
            getInvoiceItems();
            location.reload(true);
        })
        .fail(function() {
            alert("error");
        });
    });





    /////////////////////


    getInvoiceItems();
            var  invoiceTotal = 0;
            var withoutTax = 0;
            var taxCount = 0;
            
    function getInvoiceItems(){
        $.get("<?php echo base_url(); ?>invoice_items/get_inv_items/"+ invId, function(data) {
            var html = '';
            var html2 = '';
            var returned = JSON.parse(data);
            var invoice = Object.values(returned)[0];
            var  items= Object.values(returned)[1];
            // alert(invoice['byername']);
            if(invoice){
                $("#invoiceDiscount").val(invoice['discount']);
                $("#byerId").html('<tr><td>' + invoice['buyername'] + '</td><td>' + invoice['buyerpib'] +'</td></tr>');
                $("#sellerId").html('<tr><td>' + invoice['sellername'] + '</td><td>' + invoice['sellerpib'] +'</td></tr>');
                $("#invoiceId").html('<tr><td>' +  invoice['date'] + '</td><td>' + invoice['inv_num'] +'</td></tr>');

                // html2 += '<tr>'+
                //         '<td>'+invoice['byername']+'</td>'+
                //         '<td>'+invoice['byerpib']+'</td>'+
                //         '<td>'+invoice['sellername']+'</td>'+
                //         '<td>'+invoice['sellerpib']+'</td>'+
                //         '<td>'+invoice['date']+'</td>'+
                //         '<td>'+invoice['inv_num']+'</td>'+
                //         '</tr>';
            }
            $("#show_invoice").html(html2);
            if(items.length === 0 || items == null || items === undefined){
                html="dodaj stavku";
            }
            var i;

            if(Array.isArray(items)){
                for(i=0; i<items.length; i++){
                    html += '<tr>'+
                            '<td>'+items[i].sellers_code+'</td>'+
                            '<td>'+items[i].name+'</td>'+
                            '<td><input type="text" name="quantity"  class="quantity" size="5" value="'+items[i].quantity+'"></td>'+
                            '<td><input type="text" name="tax"  class="tax" size="7" value="'+items[i].tax+'"></td>'+
                            '<td>'+items[i].price+'</td>'+
                            '<td>'+(items[i].quantity*items[i].price*(items[i].tax/100))+'</td>'+
                            '<td>'+(items[i].quantity*items[i].price)+'</td>'+
                            '<td>'+items[i].total+'</td>'+
                            '<td><button class="text-uppercase btn-default text-primary edit-item" type="submit">Edit</button><input type="hidden" class="form-control discount" value="'+items[i].id+'"></td><td><button class="text-uppercase text-danger btn-default delete-item" type="submit">delete</button></td></tr>';
                            invoiceTotal += parseFloat(items[i]['total']);
                            withoutTax += items[i].quantity*items[i].price;
                            taxCount += (items[i].quantity*items[i].price*(items[i].tax/100));
                }
                html+='<tr>'+
                            '<td>Ukupno</td>'+
                            '<td></td>'+
                            '<td></td>'+
                            '<td></td>'+
                            '<td></td>'+
                            '<td>'+taxCount.toFixed(2)+'</td>'+
                            '<td>'+withoutTax.toFixed(2)+'</td>'+
                            '<td>'+invoiceTotal.toFixed(2)+'</td></tr>';
                            ;
            }
            $("#show_items").prepend(html);
            $("#inv-total").html(invoiceTotal.toFixed(2) - (invoiceTotal.toFixed(2) * ($("#discount").val())));
        })
        .fail(function() {
            alert("error");
        });
    }


    <?php foreach($invoice_items as $key => $value): ;?>
                    <?php echo form_open('invoice_items/update/' . $value['id']); ?>
                    <tr>
                            <td> <?php echo $value['sellers_code'];?></td>
                            <td><?php echo $value['name'] ;?></td>
                            <td><?php echo $value['mes_unit'] ;?></td>
                            <td><input type="text" name="quantity"  class="quantity" size="3" value="<?php echo $value['quantity'] ;?>"></td>
                            <td><input type="text" name="tax"  class="tax" size="3" value="<?php echo$value['tax'] ;?>"></td>
                            <td><input type="text" name="price"  class="price" size="7" value="<?php echo $value['price'] ;?>"></td>
                           <?php $tax_total  = $value['quantity']* $value['price']*($value['tax']/100); 
                                 $widhout_tax = $value['quantity']*$value['price'];
                                 $with_tax = ($value['price'] + ($value['price']*($value['tax']/100)))*$value['quantity'];
                           ?>
                            <td><?php echo $tax_total ;?></td>
                            <td><?php echo $widhout_tax ;?></td>
                            <td><?php echo $with_tax ;?></td>
                            <td><button class="btn-default text-primary edit-item" type="submit"><i class="fas fa-pen"></i></button><?php echo form_close(); ?><input type="hidden" class="form-control discount" value="'<?php echo $value['id'] ;?>'"></td><?php echo form_open('invoice_items/delete/' . $value['id'] . '/' . $invoice['id']); ?><td><button class="bg-red text-danger btn-default delete-item" type="submit"><i class="fas fa-trash-alt"></i></button></td><?php echo form_close(); ?></tr>
                
                        <?php endforeach; ?>


                        <div class="glavni">
          
           
            <div>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th class="">Byer</th>
                        </tr>
                    </thead>
                    <tbody id="byerId">
                        <tr>
                            <!-- <td>Company</td> -->
                            <td><?php echo $invoice['buyername']; ?></td>
                        </tr>
                        <tr>
                            <!-- <td>Pib</td> -->
                            <td><?php echo $invoice['buyerpib']; ?></td>
                        </tr>
                        <tr>
                            <!-- <td>Adress</td> -->
                            <td><?php echo $invoice['buyeradress']; ?></td>
                        </tr>
                        <tr>
                            <!-- <td>City</td> -->
                            <td><?php echo $invoice['buyercity']; ?></td>
                        </tr>
                        <tr>
                            <!-- <td>Zip code</td> -->
                            <td><?php echo $invoice['buyerzip']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <table class="table table-borderless">
                    <thead>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>Type</td>
                                    <?php if ($invoice['avans'] == 1): ?>
        
                                    <td class="text-uppercase">Avansni racun</td>
        
                                    <?php elseif ($invoice['profaktura'] == 1): ?>
                                    <td class="text-uppercase">Profaktura</td>
                                    <?php else: ?>
                                    <td class="text-uppercase">Faktura</td>
                                    <?php endif;?>
                                    <!-- <th class="text-uppercase text-center">Faktura</th> -->
                                </tr>
                        <tr>
                            <td>Date: </td>
                            <td><input type="text" name="date" id="date" 
                                    value="<?php echo $invoice['date']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Num: </td>
                            <td><?php echo $invoice['inv_num']; ?> </td>
                        </tr>
                        <tr>
                            <td>Discount </td>
                            <td><input type="text" name="discount" id="discount" size="5"
                                    value="<?php echo $invoice['discount']; ?>"></td>
                        <tr>
                            <td class="text-uppercase">Total to pay</td>
                            <td><?php echo $invoice['total']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-uppercase">Payed</td>
                            <td><?php echo $invoice['payed']; ?></td>
                        </tr>
                        <tr>
                            <td>Pay now</td>
                            <td><input type="text" name="payed" value=""></td>
                        </tr>
                        <tr>
                            <td class="text-uppercase">Due</td>
                            <td><?php echo $invoice['due']; ?></td>
                        </tr>
                        <?php if (($invoice['avans'] == 1) or ($invoice['profaktura'] == 1)): ?>
                        <tr>
                            <td>Pay deadline: </td>
                            <td><input type="text" name="pay-deadline" id="pay-deadline" size="10"
                                    value="<?php echo $invoice['pay_deadline']; ?>"></td>
                        </tr>

                        <?php endif;?>
                        <tr>
                            <td></td>
                            
                        </tr>
                    </tbody>
                </table>
                <!-- <div class="mr-2 text-right"><button id="edit-invoice" class="btn-default text-success text-uppercase " type="submit">Save changes</button></div> -->
            
            </div>
        </div>
        <!--row -->

        

        <div  class="col-sm-12 table-responsive table-borderless my-3">
            <table  class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Mes.Unit</th>
                        <th>Quantity</th>
                        <th>Tax</th>
                        <th>Price</th>
                        <th>Tax total</th>
                        <th>Total without tax</th>
                        <th>Total with tax</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($invoice_items as $key => $value): ;?>
                    <tr>
                        <td> <?php echo $value['sellers_code'];?></td>
                        <td><?php echo $value['name'] ;?></td>
                        <td><?php echo $value['mes_unit'] ;?></td>
                        <td><?php echo $value['quantity'] ;?></td>
                        <td><?php echo$value['tax'] ;?></td>
                        <td><?php echo $value['price'] ;?></td>
                        <?php $tax_total  = $value['quantity']* $value['price']*($value['tax']/100); 
                                 $widhout_tax = $value['quantity']*$value['price'];
                                 $with_tax = ($value['price'] + ($value['price']*($value['tax']/100)))*$value['quantity'];
                           ?>
                        <td><?php echo $tax_total ;?></td>
                        <td><?php echo $widhout_tax ;?></td>
                        <td><?php echo $with_tax ;?></td>
                        
                    </tr>

                    <?php endforeach; ?>

                    <?php echo $html_total; ?>

                    
                </tbody>
            </table>
        </div>
        <div class="bg-light p-2 my-3"><strong>Napomena:</strong> <?php echo $invoice['notes'];?></div>
        <div class="row no-gutters d-flex justify-content-around">
             <div class="col-sm-12 col-md-4">Za prodavca:</div>
             <div class="col-sm-12 col-md-4">Za kupca:</div>                 
        </div>