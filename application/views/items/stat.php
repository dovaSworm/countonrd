<?php $user = $this->session->userdata('user_id');
if (!is_numeric($user)) {
    redirect('users/login');
}
?>
<div class="create-header">
    <h4>Statistika artikli</h4>
</div>
<div class="container cont-stat">
    <div class="row no-gutters">
    <div class="col-sm-12 col-md-6 p-1">
            <table class="table">
                <caption>Prodaja ukupno</caption>
                <tbody>
                    <tr>
                        <th>Naziv</th>
                        <th>Komada</th>
                        <th>Vrednost</th>
                    </tr>
                    <?php foreach ($items_total as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['quantity']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table">
                <caption>Ovaj mesec</caption>
                <tbody>
                    <tr>
                        <th>Najprodavaniji artikal</th>
                        <th>komada</th>
                    </tr>
                    <?php foreach ($best_q_this as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
                
                <tbody>
                    <tr>
                        <th>Najslabije prodavan artikal</th>
                        <th>komada</th>
                    </tr>
                    <?php foreach ($worst_q_this as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>

                <tbody>
                    <tr>
                        <th>Najveći promet jednog artikla</th>
                        <th>total</th>
                    </tr>
                    <?php foreach ($best_p_this as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>

                <tbody>
                    <tr>
                        <th>Najmanji promet artikla</th>
                        <th>total</th>
                    </tr>
                    <?php foreach ($worst_p_this as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table">
                <caption>Prošli mesec</caption>
                <tbody>
                    <tr>
                        <th>Najprodavaniji artikal</th>
                        <th>komada</th>
                    </tr>
                    <?php foreach ($best_q_last as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
                
                <tbody>
                    <tr>
                        <th>Najslabije prodavan artikal</th>
                        <th>komada</th>
                    </tr>
                    <?php foreach ($worst_q_last as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>

                <tbody>
                    <tr>
                        <th>Najveći promet jednog artikla</th>
                        <th>total</th>
                    </tr>
                    <?php foreach ($best_p_last as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>

                <tbody>
                    <tr>
                        <th>Najmanji promet artikla</th>
                        <th>total</th>
                    </tr>
                    <?php foreach ($worst_p_last as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table">
                <caption>Artikli na profakturi</caption>
                <tbody>
                    <?php foreach ($profaktura as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table">
                <caption>Artikli na avansnom računu</caption>
                <tbody>
                    <?php foreach ($avans as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['total']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table">
                <caption>Artikli ispod 5 kom količine</caption>
                <tbody>
                    <?php foreach ($under_5 as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['quantity']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table">
                <caption>Nema na stanju</caption>
                <tbody>
                    <?php foreach ($under_0 as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['quantity']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>