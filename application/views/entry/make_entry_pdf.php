<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

<style>
    body {
    -webkit-font-smoothing: antialiased;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    /* font-family: 'Montserrat', sans-serif; */
    /* font-weight: bolder; */
    font-size: 14px;
    box-sizing: border-box;
    margin: 0!important;
    width: 100%;
}
@page{
    margin:20px 10px 10px 10px!important;
}
    h3{
        margin-top: 100px;
    }
    thead{
        background: #d2e9fa;
        border-bottom: 1px dotted black;
    }
  
</style>
<div class="m-0">
<div class="text-center">
    <h6>Datum ulaza: <?php echo $entry['date']; ?></h6>
    <p><?php echo $entry['name']; ?></p>
</div>
<div class="w-auto my-3">
            <table class="table table-borderless" id="mydata">
                <thead>
                    <tr style="padding:0px 0px 0px 3px">
                        <td style="width:12%;padding:0px 0px 0px 3px">Šifra dobavljača</td>
                        <td style="width:12%;padding:0px 0px 0px 3px">Šifra artikla</td>
                        <td style="width:20%;padding:0px 0px 0px 3px">Naziv artikla</td>
                        <td style="padding:0px 0px 0px 3px">Ulazna cena deviza</td>
                        <td style="width:5%;padding:0px 0px 0px 3px">Deviza</td>
                        <td style="padding:0px 0px 0px 3px">Kurs devize</td>
                        <td style="padding:0px 0px 0px 3px">Ulazna cena dinari</td>
                        <td style="padding:0px 0px 0px 3px">Izlazna cena dinari</td>
                        <td style="padding:0px 0px 0px 3px">Izlazna cena (evro)</td>
                        <td style="width:5%;padding:0px 0px 0px 3px">Količina</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($entry_items as $key => $value): ;?>
                    <tr style="padding:0px 0px 0px 3px">
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['sellers_code'];?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['code'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['name'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['buying_for'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['currency'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['exch_rate'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['buying_home'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['selling_home'] ;?></td>
                        <td style="padding:0px 0px 0px 3px"><?php echo $value['selling_for'] ;?></td>
                        <td style="padding:0px 0px 0px 3px;text-align:center"><?php echo $value['quantity'] ;?></td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>
            </table>
        </div>
        </div>