<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <a href="<?php echo route_to('categories/new') ?>"><button class="btn btn-dark float-start">Novo</button></a>
            </div>
            <div class="card-body">
                <h4 class="card-title">Gerenciar Categorias</h4>

                <?php if (count($categories) === 0) : ?>
                    <div class="alert alert-info">
                        Não há dados para exibir
                    </div>
                <?php else : ?>
                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ações</th>
                                    <th>Nome</th>
                                    <th>Preço por hora</th>
                                    <th>Preço por dia</th>
                                    <th>Preço por mês</th>
                                    <th>Lugares</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $c) : ?>
                                    <tr>
                                        <td> <a class="btn btn-primary btn-sm me-2m" href="<?= site_url('categories/edit/' . (string) $c['_id']) ?>">Editar</a>

                                            <?php echo form_open(route_to('CategoriesController::delete', $c['_id']), attributes: ['onsubmit' => 'return("Tem certeza da remoção")', 'class' => 'd-inline'], hidden: ['_method' => 'DELETE']) ?>

                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                            <?php echo form_close() ?>


                                        </td>
                                        <td><?php echo $c['name'] ?></td>
                                        <td><?php echo format_money_brl($c['price_hour']) ?></td>
                                        <td><?php echo format_money_brl($c['price_day']) ?></td>
                                        <td><?php echo format_money_brl($c['price_month']) ?></td>
                                        <td><?php echo $c['spots'] ?></td>

                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>