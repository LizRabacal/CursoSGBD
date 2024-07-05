<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <h4 class="card-title">Listar mensalistas</h4>

            <hr class="list-group list-group-flush">



            <li class="list-group-item"><strong>Nome: </strong><?php echo $customer['name'] ?></li>
            <li class="list-group-item"><strong>CPF: </strong><?php echo $customer['cpf'] ?></li>
            <li class="list-group-item"><strong>Telefone: </strong><?php echo $customer['tel'] ?></li>
            <li class="list-group-item"><strong>Email: </strong><?php echo $customer['email'] ?></li>
            <li class="list-group-item"><strong>Total de veículos: </strong><?php echo count($c['cars'] ?? []) ?></li>



            </ul>

            <hr>

            <a class="btn btn-primary btn-sm me-2m" href="<?= site_url('customers/edit/' . (string) $customer['_id']) ?>">Editar</a>

            <?php echo form_open(route_to('CustomersController::delete', $customer['_id']), attributes: ['onsubmit' => 'return("Tem certeza da remoção")', 'class' => 'd-inline'], hidden: ['_method' => 'DELETE']) ?>

            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
            <?php echo form_close() ?>
            <a class="btn btn-dark btn-sm me-2m" href="<?= site_url('customers/cars/all/' . (string) $customer['_id']) ?>">Carros</a>



        </div>
    </div>
</div>

<?= $this->endSection() ?>