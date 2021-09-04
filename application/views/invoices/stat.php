<div class="create-header">
    <h4>Statistika fakture</h4>
</div>
<div class="container create-wrapper">
    <?php echo form_open('invoices/get_stat'); ?>
    <div class="row no-gutters">
        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Datum od</label>
            <input type="text" id="date-from" name="date-from" class="form-control"
                value="<?php echo set_value('date-from', ''); ?>" placeholder="Fakture izdane od ovog datum">
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Datum do</label>
            <input type="text" id="date-to" name="date-to" class="form-control"
                value="<?php echo set_value('date-to', ''); ?>" placeholder="Fakture izdane do ovog datuma">
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Rok za plaćanje</label>
            <input type="text" id="pay-deadline" name="pay-deadline" class="form-control" placeholder="Do ovog datuma"
                value="<?php echo set_value('pay-deadline', ''); ?>">
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Kompanija</label>
            <select name="company" id="company" class="form-control">
                <?php foreach ($companies as $key => $value): ?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Uloga</label>
            <select name="bors" id="bors" class="form-control">
                <option value="buyer">Kupac</option>
                <option value="seller">Prodavac</option>
            </select>
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 p-2">
            <label>Valuta</label>
            <select name="currency" id="currency" class="form-control" value="1">
                <option value="RSD">RSD</option>
                <option value="EU">EUR</option>
                <option value="USD">USD</option>
            </select>
        </div>

        <div style="justify-content:space-around" class="col-sm-12 col-md-4 col-lg-4 p-2 d-flex">
            <div class="d-flex align-items-center">
                <label>Pred račun</label>
                <input type="checkbox" name="profaktura" class="form-control" value="accept">
            </div>
            <div class="d-flex align-items-center">
                <label class="mr-2">Avansni račun</label>
                <input type="checkbox" name="avans" class="form-control" value="accept">
            </div>
            <div class="d-flex align-items-center">
                <label class="mr-2">Konačni račun</label>
                <input type="checkbox" name="konacni" class="form-control" value="accept">
            </div>
        </div>

        <div class="col-sm-12 text-center">
            <button id="create-inv-btn" class="btn mybutton" type="submit">Traži</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="container cont-stat">
    <div class="row no-gutters">
        <div class="w-100  bg-light p-3">
            <div class="col-sm-12 col-md-6 m-auto text-center d-md-flex w-100 justify-content-around">
                <div class="d-md-flex ">
                    <?php if (!empty($company)): ;?>
                    <p class="mr-md-3">Kompanija: </p>
                    <h5><?php echo $company['name']; ?></h5>
                </div>
                <div class="d-md-flex ">
                    <p class="mr-md-3"> Uloga: </p>
                    <h5><?php echo $bors == 'buyer' ? 'kupac' : 'prodavac'; ?></h5>
                </div>
                <?php endif;?>
            </div>
        </div>
        <?php if (!empty($total)): ;?>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table m-auto">
                <tr>
                    <th colspan="2">Ukupna vrednost faktura</th>
                </tr>
                <?php foreach ($total as $key => $value): ?>
                <tr>
                    <td><?php echo $value['currency']; ?></td>
                    <td class="number"><?php echo $value['total']; ?></td>
                <tr>
                    <?php endforeach;?>
                    </tbody>
                    <tbody>
                        <tr>
                            <th colspan="2">Potrazuje/duguje</th>
                        </tr>
                        <?php foreach ($total as $key => $value): ?>
                        <tr>
                            <td><?php echo $value['currency']; ?></td>
                            <td class="number"><?php echo $value['due']; ?></td>
                        <tr>
                            <?php endforeach;?>
                    </tbody>
            </table>
        </div>
        <?php endif;?>
        <?php if (!empty($invoices)): ;?>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table m-auto">
                <tr>
                    <th>Broj fakture</th>
                    <th class="number">Vrednost</th>
                    <th class="number">Neplaćeno</th>
                </tr>
                <?php foreach ($invoices as $key => $value): ?>
                <tr>
                    <td><a href="<?php echo base_url() . 'invoices/view/' . $value['id']; ?>"><?php echo $value['inv_num']; ?></a></td>
                    <td class="number"><?php echo $value['total']; ?> <?php echo $value['currency']; ?></td>
                    <td class="number"><?php echo $value['due']; ?></td>
                <tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php endif;?>
    </div>
</div>
<div class="container cont-stat">
    <div class="row no-gutters">
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table">
                <caption>Prihodi</caption>
                <tbody>
                    <tr>
                        <th>Valuta</th><th class="number">Total</th>
                    </tr>
                    <?php foreach ($income_total as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['currency']; ?></td>
                        <td class="number"><?php echo $value['total_in']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
                <tbody>
                    <tr>
                        <th colspan="2" style="text-align: center;">Ovaj mesec</th>
                    </tr>
                    <?php foreach ($this_in as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['currency']; ?></td>
                        <td class="number"><?php echo $value['total_in']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
                <tbody>
                    <tr>
                        <th colspan="2" style="text-align: center;">Prošli mesec</th>
                    </tr>
                    <?php foreach ($last_in as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['currency']; ?></td>
                        <td class="number"><?php echo $value['total_in']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table">
                <caption>Rashodi</caption>
                <tr>
                <th>Valuta</th><th class="number">Total</th>
                </tr>
                <?php foreach ($outcome_total as $key => $value): ?>
                <tr>
                    <td><?php echo $value['currency']; ?></td>
                    <td class="number"><?php echo $value['total_out']; ?></td>
                <tr>
                    <?php endforeach;?>
                    </tbody>
                    <tbody>
                        <tr>
                            <th colspan="2" style="text-align: center;">Ovaj mesec</th>
                        </tr>
                        <?php foreach ($this_out as $key => $value): ?>
                        <tr>
                            <td><?php echo $value['currency']; ?></td>
                            <td class="number"><?php echo $value['total_out']; ?></td>
                        <tr>
                            <?php endforeach;?>
                    </tbody>
                    <tbody>
                        <tr>
                            <th colspan="2" style="text-align: center;">Prošli mesec</th>
                        </tr>
                        <?php foreach ($last_out as $key => $value): ?>
                        <tr>
                            <td><?php echo $value['currency']; ?></td>
                            <td class="number"><?php echo $value['total_out']; ?></td>
                        <tr>
                            <?php endforeach;?>
                    </tbody>
            </table>
        </div>
    </div>
</div>