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

body {
    -webkit-font-smoothing: antialiased;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    font-size: 14px;
    box-sizing: border-box;
    margin: 0!important;
    width: 100%;
}
@page{
    margin:20px 10px 10px 10px!important;
}
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: normal;
  src: url(http://themes.googleusercontent.com/static/fonts/opensans/v8/cJZKeOuBrn4kERxqtaUH3aCWcynf_cDxXwCLxiixG1c.ttf) format('truetype');
}
div{
    padding: 0;
    margin: 0;
}

.info-company{
    margin-top: 5px;
    margin-left: 30px;
    display: inline-block;
}
.info-company>div{
    line-height: 1;
}
.seller img{
    max-height: 63px;
}

.seller{
    color: #0288d1;
    border-bottom: 1px solid black;
}
.buyer{
    margin-top: 40px;
    margin-left: 20px;
    display: inline-block;
}
.invoice{
    margin-top: 40px;
    display: inline-block;
}
.forbuyer{
    display: inline-block!important;
}
.forbuyer>*{
    z-index: 5
}
.my-table > img{
    width:100%;
    height: 170px;
    z-index: 2!important;
    opacity: .12;
    position: fixed;
    top: 78px;
    left: 0px;
}
.tabela{
    margin-top:-33px;
    font-size: 11px;
    border-top:1px solid black;
}
table.table.table-borderless td {
    padding:0px 0px 0px 3px;
    min-width: 2%;
}
thead{
    background: #d2e9fa;
}
.article{
    padding-left: 20px;
    margin-top: 10px;
    font-style: italic;
    margin-bottom: 10px;
    font-weight: bold;
}
.total{
    background: #d2e9fa;
    font-weight: bold;
    text-align:right;
}
.notes{
    padding-left: 20px;
    width: -webkit-fill-available;
    display: inline-block;
}
.signature{
    width: 150px;
    display: inline-block;
    border-bottom: 1px solid black;
    padding: 30px;
    margin-left: 114px;
}
.bigsign{
    margin-top: 40px;
}
</style>

    <div class="my-table">
        <div class="seller">
            <img src="assets/img/prologo.png" alt="">
            <div class="info-company">
                <div ><b><?php echo $invoice['sellername']; ?></b></div>
                <div ><?php echo $invoice['selleradress']; ?></div>
                <div ><?php echo $invoice['sellerzip']; ?> <?php echo $invoice['sellercity']; ?></div>
                <div >PIB: <?php echo $invoice['sellerpib']; ?> MB:  <?php echo $invoice['sellermb']; ?></div>
            </div>
            <div class="info-company">
                <div >Banka: <?php echo $invoice['sellerbank']; ?></div>
                <div >Račun: <?php echo $invoice['selleracc_num']; ?></div>
                <div ><?php echo $invoice['sellerphone']; ?></div>
                <div ><?php echo $invoice['selleremail']; ?></div>
            </div>
        </div>
        <img src="assets/img/prologobek.png" alt="">
        <div class="forbuyer">
            <div class="buyer w-50">
                <div>Klijent:</div>
                <div><?php echo $invoice['buyername']; ?></div>
                <div><?php echo $invoice['buyeradress']; ?></div>
                <div><?php echo $invoice['buyerzip']; ?> <?php echo $invoice['buyercity']; ?></div>
                <div>PIB: <?php echo $invoice['buyerpib']; ?></div>
                <div>MB: <?php echo $invoice['buyermb']; ?></div>
            </div>
            <div class="invoice">
                <div><?php echo $type; ?> br: <?php echo $invoice['inv_num']; ?></div>
                <?php $date = date_create($invoice['date']); $dateformat = date_format($date, "d.m.Y.");?>
                <div>Datum: <?php echo $dateformat; ?></div>
                <div>Ukupno za uplatu: <?php echo $invoice['total']; ?></div>
                <div>Plaćeno: <?php echo $invoice['payed']; ?></div>
                <div>Duguje: <?php echo $invoice['due']; ?></div>
                <?php $date = date_create($invoice['pay_deadline']); $dateformat = date_format($date, "d.m.Y.");?>
                <div>Rok plaćanja: <?php echo $dateformat; ?></div>
            </div>
        </div>
        <div class="tabela">
            <div class="article">Artikli i usluge</div>
            <table class="table table-borderless" id="mydata">
                <thead>
                    <tr style="padding:0px 0px 0px 3px">
                        <td style="width:5%">rb</td>
                        <td style="width:10%">Kod</td>
                        <td style="width:22%">Naziv</td>
                        <td style="width:9%">Cena</td>
                        <td>Količina</td>
                        <td>Jedinica mere</td>
                        <td>Popust</td>
                        <td style="width:9%;text-align:right">Ukupna cena</td>
                        <td style="text-align:center">Poreska osnovica</td>
                        <td style="width:9%;text-align:right">Iznos PDV-a</td>
                        <td style="width:9%">Ukupan iznos</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $rb = 1; foreach($invoice_items as $key => $value): ;?>
                    <tr>
                        <td><?php echo $rb;?></td>
                        <td><?php echo $value['code'] ;?></td>
                        <td><?php echo $value['name'] ;?></td>
                        <td><?php echo $value['price'] ;?></td>
                        <td><?php echo $value['quantity'] ;?></td>
                        <td><?php echo $value['mes_unit'] ;?></td>
                        <td><?php echo $value['it_disc'] ;?>%</td>
                            <?php 
                            $widhout_tax = $value['quantity']*$value['price'] - ($value['quantity']*$value['price']*($value['it_disc']/100));
                            $tax_total  = $widhout_tax*($value['tax']/100); 
                            ?>
                        <td style="text-align:right"><?php echo number_format($widhout_tax, 2) ;?></td>
                        <td style="text-align:center"><?php echo $value['tax'] ;?>%</td>
                        <td style="text-align:right"><?php echo number_format($tax_total, 2) ;?></td>
                        <td style="text-align:right"><?php echo number_format($value['total'], 2) ;?></td>
                    </tr>
                    <?php $rb++; endforeach; ?>
                    <?php echo $html_total; ?>
                </tbody>
            </table>
            <div class="notes">
                Iznos za uplatu slovima: <?php echo $invoice['letters'] ;?>
            </div>
        </div>
        <div class="notes">
            <b>Napomena: </b><?php echo $invoice['notes'] ;?>
        </div>
        <div class="bigsign">
            <div class="signature text-center">
                Za prodavca
            </div>
            <div class="signature text-center">
                Za kupca
            </div>
        </div>
        <div class="mt-3 text-center">
            <b>Napomena o PDV-u: nema.</b>
        </div>
    </div><!-- faktura -->
