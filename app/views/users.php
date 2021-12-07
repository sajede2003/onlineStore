<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>table</title>
</head>
<body>
  <main>
    <div class="container">
      <div class="content">
        <table class="table table-striped border">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Full name</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Email</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $counter = 1;
              foreach ($allData as $key => $data):
            ?>
            <tr>
              <td><?= $counter++ ?></td>
              <td><?=$data->full_name;?></td>
              <td><?=$data->phone_number ;?></td>
              <td><?=$data->email;?></td>
              <td class="col-10 ">
                <p style="height: 100px; overflow: hidden;"></p>
              </td>
              <td class="f-flex col-2">
                <a href="/dashboard/users/delete?id=<?=$data->id?>" class="btn  btn-danger "> delete</a>
                <a href="/dashboard/users/edit?id=<?=$data->id ?>" class="btn btn-info"> edit</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <script src="lib/jquery/dist/jquery.min.js"></script>
  <script src="lib/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="js/app.js"></script>
</body>

</html>
