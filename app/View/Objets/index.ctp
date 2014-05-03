<h1>Ojects</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($objets as $objet): ?>
    <tr>
        <td><?php echo $objet['Objet']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($objet['Objet']['name'],
array('controller' => 'objets', 'action' => 'view', $objet['Objet']['id'])); ?>
        </td>
        <td><?php echo $objet['Objet']['created']; ?></td>
        <td><?php echo $objet['Objet']['description']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($objet); ?>
</table>