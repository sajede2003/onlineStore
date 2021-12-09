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
        <h2 class="text-info" > users List</h2>
      </div>
    </div>
    <br/>
    <br/>
    <div>
      <table class="table table-striped border">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">موضوع</th>
            <th scope="col">ایمیل</th>
            <th scope="col">توضیحات</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $counter = 1 ;
          foreach ($allData as $key => $data) : ?>
            <tr>
              <th scope="row"><?= $counter++ ?></th>
                <td><?= $data->subject ; ?></td>
                <td><?= $data->email ;?></td>
                <td class="w-25">
                  <p style="height: 100px; overflow: hidden;"><?= $data->comment; ?></p>
                </td>
                <td>
                  <button class="btn btn-danger "> حذف</button>
                  <button class="btn btn-success"> ویرایش</button>
                </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
</body>
</html>