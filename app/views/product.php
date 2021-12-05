<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>table</title>
</head>
<Body>
    <main>
    <div class="container">
        <div class="content">
            <table class="table table-striped border">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td class="col-10 ">
                    <p style="height: 100px; overflow: hidden;"></p>
                    </td>
                    <td class="col-2">
                    <button class="btn btn-danger "> delete</button>
                    <button class="btn btn-info"> edit</button>
                    </td>
                </tr>
                </tbody>
            </table>
        <button class="btn btn-success">add</button>
        </div>
    </div>
    </main>
<body>
  <script src="lib/jquery/dist/jquery.min.js"></script>
  <script src="lib/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="js/app.js"></script>
</body>

</html>