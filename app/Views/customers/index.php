<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <a href="<?php echo route_to('customers/new') ?>"><button class="btn btn-dark float-start">Novo mensalista</button></a>
        </div>
        <div class="card-body">
            <h4 class="card-title">Gerenciar mensalistas</h4>

            <?php if (count($customers) === 0) : ?>
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
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Email</th>
                                <th>Total de veículos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $c) : ?>
                                <tr>
                                    <td>
                                     <a class="btn btn-primary btn-sm me-2m" href=" <?= site_url('customers/show/' . (string) $c['_id']) ?>">Detalhes</a>

                                    </td>
                                    <td><?php echo $c['name'] ?></td>
                                    <td><?php echo $c['cpf'] ?></td>
                                    <td><?php echo $c['tel'] ?></td>
                                    <td><?php echo $c['email'] ?></td>
                                    <td><?php echo count($c['cars'] ?? []) ?></td>

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