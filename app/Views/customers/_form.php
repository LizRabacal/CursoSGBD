<div class="row">
    <div class="form-group col-md-12 mb-14">
        <label for="name">Nome</label>
        <input type="text" required name="name" class="form-control" value="<?php echo old('name', $customers['name'] ?? null); ?>">
        <?php echo validation_show_error('name'); ?>
    </div>

    <div class="form-group col-md-4 mb-14">

        <label for="cpf">CPF válido</label>
        <input type="text" required name="cpf" id="cpf" maxlength="14" class="form-control" value="<?php echo old('cpf', $customers['cpf'] ?? null); ?>">
        <?php echo validation_show_error('cpf'); ?>
    </div>

    <div class="form-group col-md-4 mb-14">

        <label for="telefone">Telefone</label>
        <input type="tel" required name="tel" class="form-control" value="<?php echo old('tel', $customers['tel'] ?? null); ?>">
        <?php echo validation_show_error('tel'); ?>
    </div>
    <div class="form-group col-md-4 mb-14">

        <label for="email">Email</label>
        <input type="email" required name="email" class="form-control" value="<?php echo old('email', $customers['email'] ?? null); ?>">
        <?php echo validation_show_error('email'); ?>
    </div>
   


</div>

<button class="btn btn-primary" type="submit">Salvar</button>
<button class="btn btn-secondary" type="submit">Voltar</button>