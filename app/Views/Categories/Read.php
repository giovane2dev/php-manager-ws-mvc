<?php
namespace App;
?>
<h3 class="text-uppercase text-center text-white text-dark">Categorias</h3>
<div class="row">
    <div class="col mr-auto">
        <a class="btn btn-outline-secondary btn-lg mb-4" role="button" href="createcategories">
            <i class="fa fa-plus-circle mr-2"></i><span>NOVA CATEGORIA</span>
        </a>
    </div>
</div>
<div class="row">
    <div class="col mr-auto">        
        <div class="table-responsive">
                <?php if (count($categories) > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ativa</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>                            
                            <td><?php echo $category['name']; ?></td>
                            <td style="width: 8%"><?php if ((bool) $category['active']) { echo "<span class=\"badge badge-info\">SIM</span>"; } else { echo "<span class=\"badge badge-warning text-white\">NÃO</span>"; } ?></td>
                            <td style="width: 4%"><a href="updatecategories/<?php echo $category['id'] ?>"><i class="fa fa-edit btn-edit"></i></a></td>
                            <td style="width: 4%"><a href="deletecategories/<?php echo $category['id'] ?>" onclick="return confirm('Deseja remover esta categoria?');"><i class="fa fa-trash-o btn-remove"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    Não existem categorias cadastradas!
                <?php endif; ?>
        </div>
    </div>                  
</div>