<h3 class="text-uppercase text-center text-white text-dark">Edição de Conteúdo</h3>
<div class="row">
    <div class="col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2 mr-auto">
        <form action="../../storeupdatenews" id="form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $new['id']; ?>" />
            <div class="form-group">
                <label for="subcategory_id">Subcategoria</label>
                <select name="subcategory_id" class="form-control form-control-lg" id="subcategory_id">
                    <option value="0">Selecione</option>
                    <?php if (count($subcategories) > 0) : ?>
                        <?php foreach ($subcategories as $subcategory) : ?>
                            <option <?php if ($subcategory['id'] == $new['subcategory_id']) {
                                        echo "selected";
                                    } ?> value="<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="icon">Ícone</label>
                <input type="text" name="icon" maxlength="150" value="<?php echo str_replace('"', "'", $new['icon']); ?>" class="form-control form-control-lg" id="icon" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary mr-2" type="button" role="button" data-toggle="modal" data-target="#listFontAwesome">Selecione um ícone</button><span class="icon"><?php if (stripos(str_replace('"', "'", $new['icon']), 'fa') === false) {
                                                                                                                                                                                        echo "";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo str_replace('"', "'", $new['icon']);
                                                                                                                                                                                    } ?></span>
            </div>
            <input type="hidden" id="imageStr" name="imageStr" value="<?php echo $new['image']; ?>" />
            <div class="form-group">
                <div id="imagePreview" class="drop" <?php
                                                    if (!empty($new['image'])) {
                                                        echo "style=\"background-image:url('../../uploads/images/{$new['image']}')\"";
                                                    }
                                                    ?>>
                    <div class="cont">
                        <i class="fa fa-cloud-upload"></i>
                    </div>
                    <input id="imageUpload" name="image" type="file" />
                </div>
            </div>
            <div class="form-group">
                <label for="date_">Data</label>
                <input type="text" name="date" value="<?php echo \App\formatDate('[VALUE]', $new['date']); ?>" maxlength="150" required class="form-control form-control-lg datepicker" id="date_" />
            </div>
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" value="<?php echo $new['title']; ?>" maxlength="150" required class="form-control form-control-lg" id="title" />
            </div>
            <div class="form-group">
                <label for="hyperlink">Hyperlink</label>
                <input type="text" name="hyperlink" value="<?php echo $new['hyperlink']; ?>" maxlength="500" class="form-control form-control-lg" id="hyperlink" />
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" class="form-control editor" id="description" rows="5"><?php echo $new['description']; ?></textarea>
            </div>
            <div class="form-group">
                <h6><a href="https://www.flipsnack.com/accounts/sign-in.html" target="_blank">Galeria de imagens com Flipsnack</a></h6>
                <textarea name="body" class="form-control editor" id="body"><?php echo $new['body']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="class">Classe</label>
                <input type="text" name="class" value="<?php echo $new['class']; ?>" maxlength="150" class="form-control form-control-lg" id="class" />
            </div>
            <div class="form-group">
                <input type="checkbox" name="active" <?php
                                                        if ($new['active'] == "1") {
                                                            echo 'checked';
                                                        }
                                                        ?> id="active" /><label for="active">&nbsp;Publicado</label>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-xl mr-2" type="submit" id="sendButton">Salvar</button>
                <button class="btn btn-primary btn-xl" type="button" onclick="window.location = '../../deletenews/<?php echo $new['id'] ?>/<?php echo $new['category_id'] ?>'" id="sendButton">Remover</button>
            </div>
            <div id="result"></div>
        </form>
    </div>
</div>
<?php include 'FontAwesome.php';
