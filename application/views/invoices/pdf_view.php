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

/* @page { margin: 0px; } */
 
        
body {
    -webkit-font-smoothing: antialiased;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    /* font-family: 'Montserrat', sans-serif; */
    /* font-weight: bolder; */
    font-size: 14px;
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
    /* max-width: 300px; */
    margin-top: 5px;
    margin-left: 30px;
    /* padding: 5px; */
    display: inline-block;
}
.info-byer{
    margin-left: 70px;
    /* padding: 5px; */
    /* margin-top: 5px; */
    display: inline-block;
}

table.table.table-borderless td {
    padding: 5px;
}

.seller img{
    /* display: inline-block; */
    max-width: 120px;
    margin-top: 10px;
    vertical-align: top;
}

.seller{
    color: #0288d1;
    border-bottom: 1px solid black;
}
.buyer{
    margin-top: -70px;
    display: inline-block;
}
.invoice{
    
    margin-left: 300px;
    margin-top: -13px;
    display: inline-block;
}
.forbuyer{
    padding: 20px;
    display: inline-flex!important;
    border-bottom: 1px solid black;
}
.forbuyer>*{
z-index: 5
}
.my-table > img{
    width:100%;
    height: 219px;
    z-index: 2!important;
    /* font-size: 6rem; */
    opacity: .12;
    /* color: blue; */
    position: fixed;
    /* background-color: #d2e9fa; */
    top: 114px;
    /* right: 0px; */
    left: 0px;
    /* display: inline-flex; */
    /* margin-bottom: auto; */
}
.ccc{
    margin-top: 80px;
}
/* .black-line{
    margin-top: -80px;
    background-color: black;
    width: -webkit-fill-available;
} */
.tabela{
    
    margin-top: -80px;
    background-size: cover;
    /* height: 20px; */
    border-top:1px solid black;
    /* border-bottom:1px solid black; */
    /* width: -webkit-fill-available; */
}
thead{

    border-bottom: 1px dotted black;
    /* border-top: 1px solid gray; */
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
thead{
    background: #d2e9fa;
}
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
                <!-- </div> -->
            </div>
            <div class="invoice">
            <div class="ccc"> <?php if ($invoice['avans'] == 1): ?>
                
                <div class="text-uppercase">Avansni račun</div>

                <?php elseif ($invoice['profaktura'] == 1): ?>
                <div class="text-uppercase">Profaktura</div>
                <?php else: ?>
                <div class="text-uppercase">Faktura</div>
                <?php endif;?>
                <div>Br fakture: <?php echo $invoice['inv_num']; ?></div>
                <div>Datum: <?php echo $invoice['date']; ?></div>
                <?php if (($invoice['avans'] == 1) or ($invoice['profaktura'] == 1)): ?>
                    <div>Rok plaćanja: <?php echo $invoice['pay_deadline']; ?></div>
                <?php endif;?></div>
                <div>Total: <?php echo $invoice['total']; ?></div>
                <div>Plaćeno: <?php echo $invoice['payed']; ?></div>
                <div>Duguje: <?php echo $invoice['due']; ?></div>
                <div>Rok plaćanja: <?php echo $invoice['pay_deadline']; ?></div>
            </div>
        </div>
        <!-- <div class="black-line"></div> -->
        <div class="tabela">
               <div class="hhh">Artikli i usluge</div>
                
            <table class="table table-borderless" id="mydata">
                <thead>
                    <tr>
                        <td>Kod</td>
                        <td>Naziv</td>
                        <td>Jedinica mere</td>
                        <td>Količina</td>
                        <td>Poreska osnova</td>
                        <td>Cena</td>
                        <td>Ukupno poreza</td>
                        <td>Bez poreza</td>
                        <td>Ukupno sa porezom</td>
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
        <div class="notes">
            <b>Napomena: </b><?php echo $invoice['notes'] ;?>
        </div>
        <div class="bigsign">

        
            <div class="signature">
                Za prodavca
            </div>
            <div class="signature signature2">
                Za kupca
            </div>
        </div>
    </div><!-- faktura -->
