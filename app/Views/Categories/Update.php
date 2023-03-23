<h3 class="text-uppercase text-center text-white text-dark">EDIÇÃO DE CATEGORIA</h3>
<div class="row">
    <div class="col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2 mr-auto">
        <form action="../storeupdatecategories" id="form" method="post">
            <input type="hidden" name="id" value="<?php echo $category['id']; ?>" />
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" value="<?php echo $category['name']; ?>" maxlength="50" required class="form-control form-control-lg" id="name" />
            </div>            
            <div class="form-group">
                <input type="checkbox" name="active" <?php
                if ($category['active'] == "1") {
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