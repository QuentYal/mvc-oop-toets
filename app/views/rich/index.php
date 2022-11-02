<?php echo $data["title"]; ?>
<table>
  <thead>
    <th>id</th>
    <th>Name</th>
    <th>Netwhorth</th>
    <th>Age</th>
    <th>MyComapany</th>
    <th>delete</th>
  </thead>
  <tbody>
    <?= $data['richestpeople'] ?>
  </tbody>
</table>
<a href="<?= URLROOT; ?>/homepages/index">terug</a>