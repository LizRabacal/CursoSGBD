<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>


<?= $this->section('css') ?>


<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="row">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title"><?php echo $title ?></h4>

                <p>
                    <strong>Categoria:&nbsp;</strong> <?php echo $category->name ?>
                </p>
                <p>
                    <strong>Vaga: </strong> <?php echo (string) $hidden['spot'] ?>
                </p>

                <hr>

                <?php
                echo form_open(
                    action: route_to('parking/single/create/ticket'),
                    attributes: [
                        'onsubmit' => 'return confirm("Os dados estão corretos? \n\n Não será possível editar as informações")',
                        'class' => 'form-sample'
                    ],
                    hidden: array_map('strval', $hidden) // Convertendo todos os valores do array para string

                );
                ?>


                <div class="form-group mb-4">
                    <label for="choice">Ecolha um tipo: </label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="choice" id="choice_hour" value="hour" checked>
                        <label for="form-check-label">
                            Valor hora <?php echo format_money_brl($category->price_hour) ?>

                        </label>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="choice" value="day" id="choice_day">
                        <label for="form-check-label">
                            Valor dia <?php echo format_money_brl($category->price_day) ?>

                        </label>
                    </div>
                </div>

                <hr>

                <div class="form-group mb-4">
                    <label for="vehicle">Veículo</label>
                    <input type="text" name="vehicle" class="form-control" required id="vehicle" value="<?php echo old('vehicle') ?>">
                    <?php echo validation_show_error('vehicle') ?>
                </div>

                <div class="form-group mb-4">
                    <label for="plate">Placa do veículo</label>
                    <input type="text" name="plate" class="form-control" required id="plate" value="<?php echo old('plate') ?>">
                    <?php echo validation_show_error('plate') ?>
                </div>

                <div class="form-group mb-4">
                    <label for="observations">Observações</label>
                    <textarea type="text" name="observations" class="form-control"  style="min-height: 200px"  id="observations" value="<?php echo old('observations') ?>"> </textarea>
                    <?php echo validation_show_error('observations') ?>
                </div>

                <hr>

                <button type="submit" class="btn btn-primary me-2">Criar ticket avulso</button>
                <a class="btn btn-info" href="<?= route_to('parking')?>">Cancelar abertura</a>
            </div>
    </div>
</div>






<?= $this->endSection() ?>

<?= $this->section('js') ?>



<?= $this->endSection() ?>