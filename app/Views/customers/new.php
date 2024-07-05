<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <a href="<?php echo route_to('customers') ?>"><button class="btn btn-dark">Listar categorias</button></a>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?php echo $title ?></h4>
                <?php echo form_open(route_to('customers/create'), attributes: ['class' => 'form-sample']) ?>
                <?php echo $this->include('customers\_form.php') ?>

                <?php echo form_close() ?>

            </div>
        </div>
    </div>
    <script>
        <?php echo $this->include("customers\_scripts.js")?>

    </script>
</div>

<?= $this->endSection() ?>