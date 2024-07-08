<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>

<?php

use App\Cells\ShowTicketCell;

echo $title ?? ''; ?>

<?= $this->endSection() ?>





<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title"><?php echo $title ?></h4>


                <?php echo view_cell(library: ShowTicketCell::class, params: ['ticket' => $ticket]); ?>
                <div class="mt-5">

                    <?php if (!$ticket->isClosed()) : ?>

                        <a class="btn btn-success btn-sm me-2 mb-2" href="<?= site_url('parking/close/ticket/'. $ticket->id()) ?>">Encerrar ticket</a>
                    <?php endif; ?>

                    <a class="btn btn-dark btn-sm me-2 mb-2" href="<?= route_to('parking/pdf/ticket', $ticket->id()) ?>">Gerar pdf</a>
                    <a class="btn btn-info btn-sm me-2 mb-2" href="<?= route_to('parking')?>">Criar novo ticket</a>

                </div>
            </div>
        </div>
    </div>
</div>









<?= $this->endSection() ?>