<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-info btn-sm float-start" href=" <?= site_url('customers/show/' . (string) $customer['_id']) ?>">Voltar</a>
            <a class="btn btn-primary btn-sm float-end" href=" <?= site_url('customers/cars/new/' . (string) $customer['_id']) ?>">Novo</a>
        </div>
        <div class="card-body">
            <h4 class="card-title">Carros do mensalista <?php echo $customer['name'] ?></h4>

            <?php if (count($cars) === 0) : ?>
                <div class="alert alert-info">
                    Aqui serão exibidos os veículos do mensalista <?php echo $customer['name'] ?> </div>
            <?php else : ?>
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ações</th>
                                <th>Placa</th>
                                <th>Veículo</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cars as $c) : ?>
                                <tr>
                                    <td>
                                        <a class="btn btn-primary btn-sm me-2m" href=" <?= site_url('customers/cars/edit/' . (string) $c['_id']) ?>">Editar</a>
                                        <?php echo form_open(route_to('CarsController::delete', $c['_id']), attributes: ['onSubmit' => 'return("Tem certeza da remoção")', 'class' => 'd-inline'], hidden: ['_method' => 'DELETE']) ?>

                                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                        <?php echo form_close() ?>
                                    </td>
                                    <td><?php echo $c['plate'] ?></td>
                                    <td><?php echo $c['vehicle'] ?></td>


                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection() ?>