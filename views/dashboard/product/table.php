<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="border backgroundWhite p-5">
            <div class="row border-bottom pb-3" style="display: flex; justify-content:space-between;">
                <div class="col-6">     
                    <h2 class="text-info" > product List</h2>
                </div>
            </div>
            <br/>
            <br/>
            <div>
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">title</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 1;
                            foreach ($allData as $key => $data): 
                        ?>
                        <tr>
                            <th scope="row"><?= $counter++ ?></th>
                                <td>
                                    <?= $data['title']; ?>
                                </td>
                                <td>
                                    <div style="display:flex; justify-content:end;">
                                        <a href="/dashboard/product/delete?id=<?=$data['id']?>" class="btn btn-danger text-white">delete</a>
                                        <a href="/dashboard/product/edit?id=<?= $data['id'] ?>" class="btn btn-info text-white mx-2">edit</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
                <a class="btn btn-success" href="/dashboard/product/add"> add </a>
            </div>
        </div>
    </div>
</body>
</html>