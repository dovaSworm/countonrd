<?php $user = $this->session->userdata('user_id');
if (!is_numeric($user)) {
    redirect('users/login');
}
?>
<div class="create-header">
    <h4>Statistika kompanije</h4>
</div>
<div class="container cont-stat">
    <div class="row no-gutters">
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table table-responsive">
                <caption>Prihodi</caption>
                <tr>
                    <th>Kompanija</th>
                    <th>Promet</th>
                    <th>Neplaćeno</th>
                    <th>Br. faktura</th>
                </tr>
                <tbody>
                    <tr>
                        <th colspan="5">Total</th>
                    </tr>
                    <?php foreach ($total_in as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['buyer']; ?></td>
                        <td><?php echo $value['total_in']; ?></td>
                        <td><?php echo $value['due']; ?></td>
                        <td><?php echo $value['inv_num']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
                <tbody>
                    <tr>
                        <th colspan="5">Ovaj mesec</th>
                    </tr>
                    <?php foreach ($this_in as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['buyer']; ?></td>
                        <td><?php echo $value['total_in']; ?></td>
                        <td><?php echo $value['due']; ?></td>
                        <td><?php echo $value['inv_num']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
                <tbody>
                    <tr>
                        <th colspan="5">Prošli mesec</th>
                    </tr>
                    <?php foreach ($last_in as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['buyer']; ?></td>
                        <td><?php echo $value['total_in']; ?></td>
                        <td><?php echo $value['due']; ?></td>
                        <td><?php echo $value['inv_num']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6 p-1">
            <table class="table table-responsive">
                <caption>Rashodi</caption>
                <tr>
                    <th>Kompanija</th>
                    <th>Promet</th>
                    <th>Neplaćeno</th>
                    <th>Br. faktura</th>
                </tr>
                <tbody>
                    <tr>
                        <th colspan="5">Total</th>
                    </tr>
                    <?php foreach ($total_out as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['seller']; ?></td>
                        <td><?php echo $value['total_out']; ?></td>
                        <td><?php echo $value['due']; ?></td>
                        <td><?php echo $value['inv_num']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
                <tbody>
                    <tr>
                        <th colspan="5">Ovaj mesec</th>
                    </tr>
                    <?php foreach ($this_out as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['seller']; ?></td>
                        <td><?php echo $value['total_out']; ?></td>
                        <td><?php echo $value['due']; ?></td>
                        <td><?php echo $value['inv_num']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
                <tbody>
                    <tr>
                        <th colspan="5">Prošli mesec</th>
                    </tr>
                    <?php foreach ($last_out as $key => $value): ?>
                    <tr>
                        <td><?php echo $value['seller']; ?></td>
                        <td><?php echo $value['total_out']; ?></td>
                        <td><?php echo $value['due']; ?></td>
                        <td><?php echo $value['inv_num']; ?></td>
                    <tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>