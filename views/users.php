<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $counter=1;
      foreach ($item as $key => $value) {?>
          <tr>
              <th scope="row"><?=$counter ?></th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
        <?php $counter++; } ?>
  </tbody>
</table>