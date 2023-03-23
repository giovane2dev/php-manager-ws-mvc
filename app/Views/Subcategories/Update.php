<h3 class="text-uppercase text-center text-white text-dark">EDIÇÃO DE SUBCATEGORIA</h3>
<div class="row">
    <div class="col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2 mr-auto">
        <form action="../storeupdatesubcategories" id="form" method="post">
            <input type="hidden" name="id" value="<?php echo $subcategory['id']; ?>" />
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select name="category_id" class="form-control form-control-lg" id="category_id">
                <option value="0">Selecione</option>
                <?php if (count($categories) > 0): ?>
                    <?php foreach ($categories as $category): ?>
                        <option <?php if ($category['id'] == $subcategory['category_id']) { echo "selected"; } ?> value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" value="<?php echo $subcategory['name']; ?>" maxlength="50" required class="form-control form-control-lg" id="name" />
            </div>            
            <div class="form-group">
                <input type="checkbox" name="active" <?php
                if ($subcategory['active'] == "1") {
                    echo 'checked';
                }
                ?> id="active" /><label for="active">&nbsp;Ativa</label>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-xl" type="submit" id="sendButton">Salvar</button>
            </div>
            <div id="result"></div>
        </form>
    </div>
</div>