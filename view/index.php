<?php require  '../require.php' ?>
<?php echo $data["title"]; ?>
<a href="<?= URLROOT; ?>/countries/create">Nieuw record</a>
<table>
    <thead>
        <th>id</th>
        <th>Land</th>
        <th>hoofdstad</th>
        <th>continent</th>
        <th>aantalinwoners</th>
        <th>update</th>
        <th>delete</th>
    </thead>
    <tbody>
        <?= $data['richestpeople'] ?>
    </tbody>
</table>