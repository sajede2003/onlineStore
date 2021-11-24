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
      foreach ($item as $key => $value): ?>
          <tr>
              <th scope="row"><?=$counter++ ?></th>
              <td><?=$value['name'];?></td>
              <td><?=$value['email']?></td>
              <td><?=$value['phoneNumber']?></td>
            </tr>
        <?php endforeach; ?>
  </tbody>
</table>

