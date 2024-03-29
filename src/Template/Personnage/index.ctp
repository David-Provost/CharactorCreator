<?php
$urlToRestApi = $this->Url->build('/api/personnages', true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->script('Personnage/index', ['block' => 'scriptBottom']);
?>

<div class="container">
    <div class="row">
        <div class="panel panel-default personnage-content">
            <div class="panel-heading">Characters <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
            <div class="panel-body none formData" id="addForm">
                <h2 id="actionLabel">Add Character</h2>
                <form class="form" id="personnageAddForm" enctype='application/json'>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="name"/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" id="description"/>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" onclick="personnageAction('add')">Add Character</a>
                    <!-- input type="submit" class="btn btn-success" id="addButton" value="Add Personnage" -->
                </form>
            </div>
            <div class="panel-body none formData" id="editForm">
                <h2 id="actionLabel">Edit Character</h2>
                <form class="form" id="personnageEditForm" enctype='application/json'>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="nameEdit"/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" id="descriptionEdit"/>
                    </div>
                    <input type="hidden" class="form-control" name="id" id="idEdit"/>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" onclick="personnageAction('edit')">Update Personnage</a>
                    <!-- input type="submit" class="btn btn-success" id="editButton" value="Update Personnage" -->
                </form>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="personnageData">
                    <?php
                    $count = 0;
                    foreach ($personnages as $personnage): $count++;
                        ?>
                        <tr>
                            <td><?php echo '#' . $count; ?></td>
                            <td><?php echo $personnage['name']; ?></td>
                            <td><?php echo $personnage['description']; ?></td>
                            <td>
                                <a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editPersonnage('<?php echo $personnage['id']; ?>')"></a>
                                <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?') ? personnageAction('delete', '<?php echo $personnage['id']; ?>') : false;"></a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                    <tr><td colspan="5">No Character(s) found......</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

