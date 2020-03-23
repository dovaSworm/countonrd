<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="mytitle">
    <h6 class="text-center my-1">CountOn<img src="<?php echo base_url().'/assets/img/sivibek.svg' ;?>" alt=""></h6>
</div>
<div class="container d-flex justify-content-center">
    <table class="table table-striped w-auto m-auto">
        <caption style="caption-side: top; font-weight: bold;" class="text-uppercase text-center">Ulazi</caption>
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Datum</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($entries as $key => $value): ;?>
            <tr>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['date'] ?></td>
                <td><input type="hidden" name="zabrisanje" value="<?php echo $value['id']; ?>"></td>
                <td><button class="view-item" type="submit"  title="Pogledaj"><a href="<?php echo base_url() . 'entry/view/'.  $value['id'];?>"><i class="far fa-eye"></a></i></button></td><td><button class="edit-item" type="submit" data-toggle="modal" data-target="#exampleModalCenter" title="Izmeni"><i class="fas fa-pen"></i></button></td><td><button class="delete-item" title="Obriši" type="submit"><a href="<?php echo base_url(); ?>entry/delete_item/<?php echo $value['id']; ?>"
                            ><i class="fas fa-trash-alt"></i></a></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Izmeni ulaz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container d-flex justify-content-center">
                        <?php echo form_open('entry/update'); ?>
                        <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                        <div class="form-group">
                            <label>Naziv</label>
                            <?php  if(form_error('name')) echo '<div class="alert alert-warning">' . form_error('name'). '</div>'; ?> 
                            <input type="text" name="name" class="form-control" value="<?php echo $value['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Datum</label>
                            <?php  if(form_error('date')) echo '<div class="alert alert-warning">' . form_error('pib'). '</div>'; ?>
                            <input type="text" name="date" class="form-control"  value="<?php echo $value['date']; ?>">
                        </div>
                        <small class="form-text text-muted mb-2">
                                Datumn u formatu GGGG-MM-DD (2000-02-22)
                                </small>
                        <button class="btn mybutton" type="submit">Snimi izmene</button>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
