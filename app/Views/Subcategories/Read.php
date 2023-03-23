<?php
namespace App;
?>
<h3 class="text-uppercase text-center text-white text-dark">Subcategorias</h3>
<?php if ($arg != 'all'): ?>
    <?php if (is_numeric($arg)): ?>
        <div class="row">
            <div class="col mr-auto">
                <a class="btn btn-outline-secondary btn-lg mb-4" role="button" href="../createsubcategories/<?php echo $arg; ?>">
                    <i class="fa fa-plus-circle mr-2"></i><span>NOVA SUBCATEGORIA</span>
                </a>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<div class="row">
    <div class="col mr-auto">        
        <div class="table-responsive">
                <?php if (count($subcategories) > 0): ?>
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
                    <?php foreach ($subcategories as $subcategory): ?>
                        <tr>                            
                            <td><?php echo $subcategory['name']; ?></td>
                            <td style="width: 8%"><?php if ((bool) $subcategory['active']) { echo "<span class=\"badge badge-info\">SIM</span>"; } else { echo "<span class=\"badge badge-warning text-white\">NÃO</span>"; } ?></td>
                            <td style="width: 4%"><a href="../updatesubcategories/<?php echo $subcategory['id'] ?>"><i class="fa fa-edit btn-edit"></i></a></td>
                            <td style="width: 4%"><a href="../deletesubcategories/<?php echo $subcategory['id'] ?>" onclick="return confirm('Deseja remover esta subcategoria?');"><i class="fa fa-trash-o btn-remove"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    Não existem subcategorias cadastradas!
                <?php endif; ?>
        </div>
    </div>                  
</div>