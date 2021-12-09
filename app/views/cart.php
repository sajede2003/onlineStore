<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="border backgroundWhite p-5">
        <div class="row border-bottom pb-3" style="display: flex; justify-content:space-between;">
            <div>
                <h2 class="text-info "> Cart </h2>
            </div>
        </div>
        <br />
        <br />
        <div>
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">product name </th>
                        <th scope="col"> count </th>
                        <th scope="col"> link </th>
                        <th scope="col">sum </th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (count($cartData) == 0) :?>
                        <h3> there is no item to show </h3>
                    <?php else : ?>
                        <?php $counter = 1;
                        foreach ($cartData as $key => $value) :?>
                            <tr>
                                <th scope="row"><?=$counter++?>
                            </th>
                                <td>
                                    <?= $value['name'] ?>
                                </td>
                                <td>
                                    <p>
                                        <?=$value['sum']?>
                                    </p>
                                </td>
                                <td>
                                    <a href="/more?id=<?=$key?>"> more</a>
                                </td>
                                <td>
                                    <div style="display:flex; justify-content:end;">
                                        <a href="/add-to-cart?product_id=<?=$key?>" class="btn btn-danger text-white">+</a>
                                        <?=$value['count']?>
                                        <a href="/remove-to-cart?product_id=<?=$key?>" class="btn btn-info text-white mx-2">-</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>