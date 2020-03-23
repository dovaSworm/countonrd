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
    margin: 0;
    width: 100%;
}
    h3{
        margin-top: 100px;
    }
    thead{
        background: #d2e9fa;
        border-bottom: 1px dotted black;
    }
</style>
<div class="text-center">
    <h6>Datum ulaza: <?php echo $entry['date']; ?></h6>
    <p><?php echo $entry['name']; ?></p>
</div>
<div class="w-auto my-3">
            <table class="table table-borderless" id="mydata">
                <thead>
                    <tr>
                        <td style="width:10%">Šifra dobavljača</td>
                        <td style="width:10%">Šifra artikla</td>
                        <td style="width:17%">Naziv artikla</td>
                        <td>Ulazna cena deviza</td>
                        <td>Deviza</td>
                        <td>Kurs devize</td>
                        <td>Ulazna cena dinari</td>
                        <td>Izlazna cena dinari</td>
                        <td>Izlazna cena (evro)</td>
                        <td>Količina</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($entry_items as $key => $value): ;?>
                    <tr>
                        <td><?php echo $value['sellers_code'];?></td>
                        <td><?php echo $value['code'] ;?></td>
                        <td><?php echo $value['name'] ;?></td>
                        <td><?php echo $value['buying_for'] ;?></td>
                        <td><?php echo $value['currency'] ;?></td>
                        <td><?php echo $value['exch_rate'] ;?></td>
                        <td><?php echo $value['buying_home'] ;?></td>
                        <td><?php echo $value['selling_home'] ;?></td>
                        <td><?php echo $value['selling_for'] ;?></td>
                        <td><?php echo $value['quantity'] ;?></td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>
            </table>
        </div>