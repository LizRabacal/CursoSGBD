<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <a href="<?php echo route_to('customers') ?>"><button class="btn btn-dark">Listar Mensalistas</button></a>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?php echo $title ?></h4>
                <?php echo form_open(route_to('CustomersController::update', $customers['_id']), attributes: ['class' => 'form-sample'],hidden: ['_method' => 'PUT']) ?>
                <?php echo $this->include('customers\_form.php') ?>

                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>