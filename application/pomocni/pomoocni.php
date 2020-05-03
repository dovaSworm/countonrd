/* background: url("<?php echo base_url()."/assets/img/prologobek.png"; ?>") no-repeat; */
 
<td><button class="edit-item" type="submit" title="Izmeni"><ahref="<?php echo base_url(); ?>items/edit/<?php echo $value["id"]; ?>"class="btn-default"><i class="fas fa-pen"></i></a></button></td> <td><button class="delete-item" type="submit" title="Obriši"><ahref="<?php echo base_url(); ?>items/delete/<?php echo $value["id"]; ?>"><iclass="fas fa-trash-alt"></i></a></button></td>
   
<div class="bg-light p-2 my-3"><strong>Napomena:</strong> <?php echo $invoice['notes']; ?></div>
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
    <

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

        <div class="bg-light p-2 my-3"><strong>Napomena:</strong> <?php echo $invoice['notes'];?></div>
        <div class="row no-gutters d-flex justify-content-around">
             <div class="col-sm-12 col-md-4">Za prodavca:</div>
             <div class="col-sm-12 col-md-4">Za kupca:</div>                 
        </div>


        //////////////////////////////////

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

<style>

/* @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
@import url('https://fonts.googleapis.com/css?family=Montserrat&display=swap');
@import url('https://fonts.googleapis.com/css?family=Audiowide&display=swap');
@import url('https://fonts.googleapis.com/css?family=Anton|Orbitron|Play|Squada+One|Ubuntu&display=swap');
@import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap'); */

@page{
    margin:20px 10px 10px 10px!important;
}
 
        
body {
    -webkit-font-smoothing: antialiased;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    /* font-family: 'Montserrat', sans-serif; */
    /* font-weight: bolder; */
    font-size: 13px;
    box-sizing: border-box;
    margin: 0;

    
    width: 100%;
}
div{
    padding: 0;
    margin: 0;
}
div.forbuyer{
    background: url("<?php echo base_url()."/assets/img/prologobek.png"; ?>") cover no-repeat;
}
.info-company{
    margin-top: 5px;
    margin-left: 30px;
    display: inline-block;
}
.info-company>div{
    line-height: 1;
}
.info-byer{
    margin-left: 70px;
    display: inline-block;
}

table.table.table-borderless td {
    padding:0px 0px 0px 3px;
    /* min-width: 2%; */
}
table.table.table-borderless tr td:first-of-type{
    width: 3%!important;
}

.seller img{
    max-width: 120px;
    /* margin-top: 10px; */
    vertical-align: top;
}

.seller{
    color: #0288d1;
    border-bottom: 1px solid black;
}
.buyer{
    padding-left: 20px;
    display: inline-block;
}
.invoice{
    
    margin-left: 300px;
    margin-top: 23px;
    display: inline-block;
}
.forbuyer{
    display: inline-flex!important;
    border-bottom: 1px solid black;
}
.forbuyer>*{
z-index: 5
}
.my-table > img{
    width:100%;
    height: 202px;
    z-index: 2!important;
    opacity: .12;
    position: fixed;
    top: 73px;
    left: 0px;
}
.ccc{
    margin-top: 80px;
}

.tabela{
    font-size: 11px;
    border-top:1px solid black;
}
thead{
    background: #d2e9fa;
    border-bottom: 1px dotted black;
}

.hhh{
    margin-top: 10px;
    font-style: italic;
    margin-bottom: 10px;
    font-weight: bold;
}
.nnn{
    
    border-top: 1px solid black;
    font-weight: bold;
}
.notes{
    width: -webkit-fill-available;
    display: inline-block;
    margin-top: 50px;
}
.signature{
    width: 150px;
    display: inline-block;
    border-bottom: 1px solid black;
    padding: 30px;
    margin-left: 97px;
}
/* .signature2{
    margin-left: 110px;
    display: inline-block;
} */

.bigsign{
    margin-top: 40px;
}
</style>

    <div class="my-table">
        <div class="seller">
            <img src="<?php echo base_url().'/assets/img/prologo.png'; ?>" alt="">
            <div class="info-company">
                <div ><?php echo $invoice['sellername']; ?></div>
                <div ><?php echo $invoice['selleradress']; ?></div>
                <div ><?php echo $invoice['sellerzip']; ?> <?php echo $invoice['sellercity']; ?></div>
                <div ><b>Pib: </b><?php echo $invoice['sellerpib']; ?> <b>MB: </b> <?php echo $invoice['sellermb']; ?></div>
            </div>
            <div class="info-company">
                <div >Banka: <?php echo $invoice['sellerbank']; ?></div>
                <div >Račun: <?php echo $invoice['selleracc_num']; ?></div>
                <div ><?php echo $invoice['sellerphone']; ?></div>
                <div ><?php echo $invoice['selleremail']; ?></div>
            </div>
        </div>
        <img src="<?php echo base_url().'/assets/img/prologobek.png'; ?>" alt="">
        <div class="forbuyer">
            <div class="buyer">
                <b>Faktura za: </b><div><?php echo $invoice['buyername']; ?></div>
                <!-- <div class="info-byer"> -->
                <div><?php echo $invoice['buyeradress']; ?></div>
                <div><?php echo $invoice['buyerzip']; ?> <?php echo $invoice['buyercity']; ?></div>
                <div><b>Pib: </b><?php echo $invoice['buyerpib']; ?></div>
                <div><b>MB: </b><?php echo $invoice['buyermb']; ?></div>
                <!-- </div> -->
            </div>
            <div class="invoice">
                <div class="text-uppercase"><?php echo $type; ?></div>
                <div>Br fakture: <?php echo $invoice['inv_num']; ?></div>
                <div>Datum: <?php echo $invoice['date']; ?></div>
                <div>Ukupno za uplatu: <?php echo $invoice['total']; ?></div>
                <div>Plaćeno: <?php echo $invoice['payed']; ?></div>
                <div>Duguje: <?php echo $invoice['due']; ?></div>
                <div>Rok plaćanja: <?php echo $invoice['pay_deadline']; ?></div>
            </div>
        </div>
        <!-- <div class="black-line"></div> -->
        <div class="w-auto tabela">
               <div class="hhh">Artikli i usluge</div>
               <div class="w-auto">
            <table style="width:100%" class="table table-borderless" id="mydata">
                <thead>
                    <tr style="padding:0px 0px 0px 3px">
                        <td style="width:5%;padding:0px 0px 0px 3px">rb</td>
                        <td style="width:12%;margin-left:-15px;padding:0px 0px 0px 3px">Kod</td>
                        <td style="width:22%;padding:0px 0px 0px 3px">Naziv</td>
                        <td style="padding:0px 0px 0px 3px">Cena</td>
                        <td style="padding:0px 0px 0px 3px">Količina</td>
                        <td style="padding:0px 0px 0px 3px">Jedinica mere</td>
                        <td style="padding:0px 0px 0px 3px">Popust(%)</td>
                        <td style="padding:0px 0px 0px 3px">Ukupna cena</td>
                        <td style="padding:0px 0px 0px 3px">Poreska osnovica</td>
                        <td style="padding:0px 0px 0px 3px">Iznos PDV-a</td>
                        <td style="padding:0px 0px 0px 3px">Ukupan iznos</td>
                    </tr>
                </thead>

                <tbody>
                    <?php $rb = 1; foreach($invoice_items as $key => $value): ;?>
                    <tr style="padding:0px 0px 0px 3px">
                        <td style="width:5%"><?php echo $rb;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['sellers_code'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['name'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['price'] ;?></td>
                        <td style="padding:0px 0px 0px 3px;text-align:center"><?php echo $value['quantity'] ;?></td>
                        <td style="padding:0px 0px 0px 3px;text-align:center"><?php echo $value['mes_unit'] ;?></td>
                        <td style="padding:0px 0px 0px 3px;text-align:center"><?php echo $value['it_disc'] ;?></td>
                            <?php 
                            $widhout_tax = $value['quantity']*$value['price'] - ($value['quantity']*$value['price']*($value['it_disc']/100));
                            $tax_total  = $widhout_tax*($value['tax']/100); 
                            ?>
                        <td style="padding:0px 0px 0px 3px"><?php echo $widhout_tax ;?></td>
                        <td style="padding:0px 0px 0px 3px;text-align:center"><?php echo$value['tax'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $tax_total ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['total'] ;?></td>
                    </tr>
                    <?php $rb++; endforeach; ?>
                    <?php echo $html_total; ?>
                </tbody>
            </table>
            </div>
            <div>
                Iznos za uplatu slovima: <?php echo $invoice['letters'] ;?>
            </div>
        </div>
        <div class="notes">
            <b>Napomene: </b><?php echo $invoice['notes'] ;?>
        </div>
        <div class="bigsign">
            <div class="signature">
                Za prodavca
            </div>
            <div class="signature signature2">
                Za kupca
            </div>
        </div>
        <div class="notes text-center">
            <b>Napomena o PDV-u: nema.</b>
        </div>
    </div><!-- faktura -->
