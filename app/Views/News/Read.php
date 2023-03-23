<?php

namespace App;
?>
<h3 class="text-uppercase text-center text-white text-dark">Conteúdos</h3>
<?php if ($arg != 'all') : ?>
    <?php if (is_numeric($arg)) : ?>
        <div class="row">
            <div class="col mr-auto">
                <a class="btn btn-outline-secondary btn-lg mb-4" role="button" href="../createnews/<?php echo $arg; ?>">
                    <i class="fa fa-plus-circle mr-2"></i><span>NOVO CONTEÚDO</span>
                </a>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<div class="row">
    <div class="col mr-auto">
        <div class="table-responsive">
            <?php if (count($news) > 0) : ?>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Subcategoria</th>
                            <th>Título</th>
                            <th>Publicado</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($news as $new) : ?>
                            <tr>
                                <td style="width: 12%"><?php echo \App\formatDate("[SMALL]", $new['date']); ?></td>
                                <td style="width: 16%"><?php echo $new['subcategory_name']; ?></td>
                                <td><?php echo $new['title']; ?></td>
                                <td style="width: 8%">
                                    <?php if ((bool) $new['active']) {
                                        echo "<span class=\"badge badge-info\">SIM</span>";
                                    } else {
                                        echo "<span class=\"badge badge-warning text-white\">NÃO</span>";
                                    } ?></td>
                                <td style="width: 4%">
                                    <a href="../updatenews/<?php echo $new['id'] ?>/<?php echo $new['category_id'] ?>">
                                        <i class="fa fa-edit btn-edit"></i>
                                    </a>
                                </td>
                                <td style="width: 4%">
                                    <a href="../deletenews/<?php echo $new['id'] ?>/<?php echo $new['category_id'] ?>" onclick="return confirm('Deseja remover este conteúdo?');">
                                        <i class="fa fa-trash-o btn-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                Não existem conteúdos cadastrados!
            <?php endif; ?>
        </div>
    </div>
</div>