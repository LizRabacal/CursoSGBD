<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title"><?php echo $title ?></h4>
                <?php echo form_open(route_to('company/process'), attributes: ['class' => 'form-sample']) ?>


                <div class="row">
                    <div class="form-group col-md-6 mb-14">
                        <label for="name">Nome</label>
                        <input type="text" required name="name" class="form-control" value="<?php echo old('name', $company->name ?? null); ?>">
                        <?php echo validation_show_error('name'); ?>
                    </div>


                    <div class="form-group col-md-6 mb-14">
                        <label for="phone">Telefone</label>
                        <input type="tel" required name="phone" class="form-control" value="<?php echo old('phone', $company->phone ?? null); ?>">
                        <?php echo validation_show_error('phone'); ?>
                    </div>

                    <div class="form-group col-md-12 mb-14">
                        <label for="address">Endereço</label>
                        <input type="text" required name="address" class="form-control" value="<?php echo old('address', $company->address ?? null); ?>">
                        <?php echo validation_show_error('address'); ?>
                    </div>

                    <div class="form-group col-md-12 mb-14">
                        <label for="message">Mensagem</label>
                        <textarea style="min-height: 200px;" type="text" required name="message" class="form-control" value="<?php echo old('message', $company->message ?? null); ?>"> </textarea>
                        <?php echo validation_show_error('message'); ?>
                    </div>






                </div>

                <?php if ($company->id !== null) : ?>
                    <?php echo form_hidden('_method', 'PUT') ?>

                <?php endif; ?>

                <button class="btn btn-primary" type="submit">Salvar</button>








                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>