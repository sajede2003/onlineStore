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
  <div class="border backgroundWhite p-5">
    <div class="row border-bottom pb-3" style="display: flex; justify-content:space-between;">
        <div class="col-6">     
          <h2 class="text-info" > category List</h2>
        </div>
    </div>
    <br/>
    <br/>
    <div>
      <table class="table table-striped border">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
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
            <td><?=$data['title'];?></td>
            <td class="f-flex col-2">
              <a href="/dashboard/category/delete?id=<?=$data['id']?>" class="btn  btn-danger "> delete</a>
              <a href="/dashboard/category/edit?id=<?=$data['id'] ?>" class="btn btn-info"> edit</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <a href="/dashboard/category/add" class="btn btn-success">add</a>
    </div>
  </div>
</body>

</html>
