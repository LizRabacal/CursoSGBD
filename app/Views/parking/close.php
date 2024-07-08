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
                    <?php echo form_open(site_url('parking/close/ticket/process/' . $ticket->id()), attributes: ['class' => 'd-inline'], hidden: ['_method' => 'PUT']) ?>

                    <div class="form-group">

                    <label for="payment_method">Método de pagamento</label>
                    <?php echo $paymentMethods ?>
                    <?php echo validation_show_error('payment_method') ?>
                    <button type="submit" class="btn btn-danger btn-sm me-2 mt-2">Finalizar ticket</button>
                    </div>

                    <?php echo form_close() ?>
                    <a class="btn btn-dark btn-sm me-2 mb-2" href="<?= route_to('parking/pdf/ticket', $ticket->id()) ?>">Gerar pdf</a>
                    <a class="btn btn-info btn-sm me-2 mb-2" href="<?= route_to('parking') ?>">Criar novo ticket</a>

                </div>
            </div>
        </div>
    </div>
</div>









<?= $this->endSection() ?>