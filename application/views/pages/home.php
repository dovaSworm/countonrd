
<?php $user = $this->session->userdata('user_id'); 
    if(!is_numeric($user)){
        redirect('users/login');
    }    
?>
<div class="mytitle">
    <img src="<?php echo base_url().'/assets/img/logo.png' ;?>" alt="">
    <h2 class="text-center my-3">COUNTONRD</h2>
    <h4 class="text-center mb-3">Dobrodošli</h4>
</div>

<div class="container justify-contetn-center mt-4">
    <div class="row no-gutters">
        <div class="col-sm-12 col-md-3">
            <h3>Artikli</h3>
            <div><a href="<?php echo base_url(); ?>items/index">Pogledaj sve</a></div>
            <div><a href="<?php echo base_url(); ?>items/create">Napravi artikal</a></div>
        </div>
        <div class="col-sm-12 col-md-3">
            <h3>Kompanije</h3>
            <div><a href="<?php echo base_url(); ?>companies/index">Pogledaj sve</a></div>
            <div><a href="<?php echo base_url(); ?>companies/create">Napravi kompaniju</a></div>
        </div>
        <div class="col-sm-12 col-md-3">
            <h3>Fakture</h3>
            <div><a href="<?php echo base_url(); ?>invoices/view_all">Pogledaj sve</a></div>
            <div><a href="<?php echo base_url(); ?>invoices/index">Napravi fakturu</a></div>
        </div>
        <div class="col-sm-12 col-md-3">
            <h3>Ulazi</h3>
            <div><a href="<?php echo base_url(); ?>entry/view_all">Pogledaj sve</a></div>
            <div><a href="<?php echo base_url(); ?>entry/index">Napravi fakturu</a></div>
        </div>
    </div>
</div>
<?php if ($this->session->flashdata('company_edited')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('company_edited') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
<?php if ($this->session->flashdata('company_deleted')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('company_deleted') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
<?php if ($this->session->flashdata('company_created')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('company_created') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
<?php if ($this->session->flashdata('item_created')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('item_created') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
<?php if ($this->session->flashdata('user_registered')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
<?php endif;?>
<?php if ($this->session->flashdata('user_loged_in')): ?>
<?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loged_in'). $this->session->userdata('name') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>

<?php endif;?>