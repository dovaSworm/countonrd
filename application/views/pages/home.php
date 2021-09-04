<section class="hom-sec">
    <div class="mytitle container">
        <h4 id="hom-welc">Dobrodošli, RD design predstavlja</h4>
        <?php if ($this->session->flashdata('company_created')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('company_created') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
        <?php endif;?>
        <?php if ($this->session->flashdata('user_registered')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
        <?php endif;?>
        <?php if ($this->session->flashdata('info')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('info'). $this->session->userdata('name') . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'; ?>
        <?php endif;?>
        <div class="hom-wrapper row">
            <div class="col-sm-12 col-lg-4 text-center">
                <p id="hom-parag">program za izradu faktura i vođenje stanja magacina</p>
            </div>
            <div class="col-sm-12 col-lg-8 text-center">
                <h2 id="hom-title" class="">CountOn<b>rd</b></h2>
            </div>
        </div>
    </div>
    <div class="container hom-why">
        <div class="row no-gutters">
            <div class="col-sm-12 col-md-6 mb-5">
                <h4 class="text-center">Zašto mi treba ovaj program?</h4>
                <ul>
                    <li>Izrada faktura u elektornskom i PDF-formatu</li>
                    <li>Ažuriranje stanja magacina</li>
                    <li>Podaci o firmama na jednom mestu</li>
                    <li>Statistika ulaza i izlaza</li>
                    <li>Prosto i intuitivno za rukovanje</li>
                    <li>Zamenjuje više programa i alata</li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-6 mb-5">
                <h4 class="text-center">Šta mogu da radim?</h4>
                <ul>
                    <li>Samostalno pravim fakture</li>
                    <li>Pravim artikle i usluge prema svojim potrebama</li>
                    <li>Menjam podatke o firmi ili artiklima</li>
                    <li>Vodim statistiku ulaza i izlaza</li>
                    <li>Vodim evidenciju o nenaplaćenim fakturama</li>
                    <li>Čuvam podatke za naručivanje robe</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container justify-contetn-center mt-4">
        <div class="row no-gutters">
            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                <h5 class="mb-3 text-center">Artikli</h5>
                <div class="home-menu open"><a class="m-auto" href="<?php echo base_url(); ?>items/index">Pogledaj sve</a><a
                        class="m-auto" href="<?php echo base_url(); ?>items/create">Napravi artikal</a></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                <h5 class="mb-3 text-center">Kompanije</h5>
                <div class="home-menu"><a class="m-auto" href="<?php echo base_url(); ?>companies/index">Pogledaj sve</a><a
                        class="m-auto" href="<?php echo base_url(); ?>companies/create">Napravi kompaniju</a></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                <h5 class="mb-3 text-center">Fakture</h5>
                <div class="home-menu"><a class="m-auto" href="<?php echo base_url(); ?>invoices/view_all">Pogledaj
                        sve</a><a class="m-auto" href="<?php echo base_url(); ?>invoices/index">Napravi fakturu</a>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                <h5 class="mb-3 text-center">Ulazi</h5>
                <div class="home-menu"><a class="m-auto" href="<?php echo base_url(); ?>entry/view_all">Pogledaj sve</a><a
                        class="m-auto" href="<?php echo base_url(); ?>entry/index">Napravi fakturu</a></div>
            </div>
        </div>
    </div>
</section>
<div class="foo-logo">
    <div class="d-flex flex-column align-items-center">
        <p class="text-right"><small>Developed and designed by</small>
        </p>
        <a href="#"><img src="<?php echo base_url().'/assets/img/logon.png'; ?>" alt="logo footer"></a>
        <p class="text-center w-100"><small>Copyright © RDdesign. All Rights Reserved</small></p>
    </div>
</div>