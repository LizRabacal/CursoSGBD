<div class="row">
    <div class="form-group col-md-12 mb-14">
        <label for="plate">Placa</label>
        <input type="text" required name="plate" class="form-control" value="<?php echo old('plate', $car['plate'] ?? null); ?>">
        <?php echo validation_show_error('plate'); ?>
    </div>

    <div class="form-group col-md-12 mb-14">
        <label for="vehicle">Descrição do veículo</label>
        <input type="text" required name="vehicle" class="form-control" value="<?php echo old('vehicle', $car['vehicle'] ?? null); ?>">
        <?php echo validation_show_error('vehicle'); ?>
    </div>

    <?php echo form_hidden('customer_id', (string) $customer['_id']) ?>
    <?php echo validation_show_error('customer_id'); ?>







</div>

<button class="btn btn-primary" type="submit">Salvar</button>
<a class="btn btn-dark" href="<?= site_url('customers/cars/all/' . (string) $customer['_id']) ?>">Voltar</a>