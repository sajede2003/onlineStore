
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../lib/bootstrap-rtl/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>table</title>
</head>
<main>
  <div class="container">
    <div class="content">


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
          $counter=1;
          foreach($allData as $key => $value): ?>

          <tr>
            <th scope="row"><?= $counter++ ?></th>
            <td><?= $value['subject']?></td>
            <td><?= $value['email']?></td>
            <td class="w-25 ">
              <p style="height: 100px; overflow: hidden;"><?= $value ['body'];?></p>
            </td>
            <td>
              <button class="btn btn-danger "> حذف</button>
              <button class="btn btn-success"> ویرایش</button>
            </td>
          </tr>
          <?php endforeach ; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<body>
  <script src="lib/jquery/dist/jquery.min.js"></script>
  <script src="lib/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="js/app.js"></script>
</body>

</html>