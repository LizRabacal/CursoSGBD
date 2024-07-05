<div class="row">
    <div class="form-group col-md-12 mb-14">
        <label for="name">Nome</label>
        <input type="text" required name="name" class="form-control" value="<?php echo old('name', $category['name'] ?? null); ?>">
        <?php echo validation_show_error('name'); ?>
    </div>


    <div class="col-md-6">
        <div class="alert alert-info text-dark">

            <strong>Preencha o campo dos valores: </strong>

            <ul>
                <li>Para R$ 8,00 informe 8</li>
                <li>Para R$ 18,99 informe 1899</li>
                <li>Para R$ 100,00 informe 10000</li>
            </ul>



        </div>
    </div>
    <div class="form-group col-md-6 mb-14">

        <label for="price_hour">Preço por Hora</label>
        <input type="number" required name="price_hour" class="form-control" value="<?php echo old('price_hour', $category['price_hour'] ?? null); ?>">
        <?php echo validation_show_error('price_hour'); ?>
    </div>

    <div class="form-group col-md-6 mb-14">

        <label for="price_day">Preço por Dia</label>
        <input type="number" required name="price_day" class="form-control" value="<?php echo old('price_day', $category['price_day'] ?? null); ?>">
        <?php echo validation_show_error('price_day'); ?>
    </div>
    <div class="form-group col-md-6 mb-14">

        <label for="price_month">Preço por Mês</label>
        <input type="number" required name="price_month" class="form-control" value="<?php echo old('price_month', $category['price_month'] ?? null); ?>">
        <?php echo validation_show_error('price_month'); ?>
    </div>
    <div class="form-group col-md-6 mb-14">

        <label for="spots">Número de Lugares</label>
        <input type="number" required name="spots" class="form-control" value="<?php echo old('spots', $category['spots'] ?? null); ?>">
        <?php echo validation_show_error('spots'); ?>
    </div>


</div>

<button class="btn btn-primary" type="submit">Salvar</button>
<button class="btn btn-secondary" type="submit">Voltar</button>