<h3 class="text-uppercase text-center text-white text-dark">NOVO CONTEÚDO</h3>
<div class="row">
    <div class="col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2 mr-auto">
        <form action="../storecreatenews" id="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="subcategory_id">Subcategoria</label>
                <select name="subcategory_id" class="form-control form-control-lg" id="subcategory_id">
                    <option value="0">Selecione</option>
                    <?php if (count($subcategories) > 0) : ?>
                        <?php foreach ($subcategories as $subcategory) :
                            $i++;
                        ?>
                            <?php if ($i == 1) : ?>
                                <option selected value="<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></option>
                            <?php else : ?>
                                <option value="<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="icon">Ícone</label>
                <input type="text" name="icon" maxlength="150" class="form-control form-control-lg" id="icon" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary mr-2" type="button" role="button" data-toggle="modal" data-target="#listFontAwesome">Selecione um ícone</button><span class="icon"></span>
            </div>
            <div class="form-group">
                <div id="imagePreview" class="drop">
                    <div class="cont">
                        <i class="btn-fa fa fa-cloud-upload"></i>
                    </div>
                    <input id="imageUpload" name="image" type="file" />
                </div>
            </div>
            <div class="form-group">
                <label for="date">Data</label>
                <input type="text" name="date" maxlength="150" autocomplete="off" required class="form-control form-control-lg datepicker" id="date" />
            </div>
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" maxlength="150" required class="form-control form-control-lg" id="title" />
            </div>
            <div class="form-group">
                <label for="hyperlink">Hyperlink</label>
                <input type="text" name="hyperlink" maxlength="500" class="form-control form-control-lg" id="hyperlink" />
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" class="form-control form-control-lg" id="description" rows="5"></textarea>
            </div>
            <div class="form-group">
                <h6><a href="https://www.flipsnack.com/accounts/sign-in.html" target="_blank">Galeria de imagens com Flipsnack</a></h6>
                <textarea name="body" class="form-control editor" id="body"></textarea>
            </div>
            <div class="form-group">
                <label for="class">Classe</label>
                <input type="text" name="class" maxlength="150" class="form-control form-control-lg" id="class" />
            </div>
            <div class="form-group">
                <input type="checkbox" checked name="active" id="active" /><label for="active">&nbsp;Publicado</label>
            </div>
            <?php if ($arg != 'all') : ?>
                <?php if (is_numeric($arg)) : ?>
                    <div class="form-group">
                        <button class="btn btn-primary btn-xl" type="submit" id="sendButton">Cadastrar</button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div id="result"></div>
        </form>
    </div>
</div>
<?php include 'FontAwesome.php';
