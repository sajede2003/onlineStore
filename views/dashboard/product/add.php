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
    <form action="/dashboard/product/add" method="POST" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal">add product Page</h1>

        <div class="form-floating mb-3 col-5">
            <input type="text" name="title" class="form-control mb-2" id="title" placeholder="name@example.com">
            <label for="title">title</label>
            <span class="text-danger">
                <?php if (isset($errors['title'])):?>
                    <?=$errors['title'][0]?>
                <?php endif;?>
            </span>
        </div>
        <div class=" mb-3 col-5">
            <label for="description">description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
            <span class="text-danger">
                <?php if (isset($errors['description'])): ?>
                    <?=$errors['description'][0]?>
                <?php endif;?>
            </span>
        </div>
        <div class=" mb-3 col-5">
            <label for="pic">pic</label>
            <input type="file" name="pic" class=" mb-2" id="pic" >
            <span class="text-danger">
                <?php if (isset ($errors['pic'])): ?>
                    <?=$errors['pic'][0];?>
                <?php endif;?>
            </span>
        </div>
        <div class="form-floating mb-3 col-5">
            <input type="number" name="price" class="form-control mb-2" id="price" placeholder="name@example.com">
            <label for="price">price</label>
            <span class="text-danger">
                <?php if (isset($errors['price'])) :?>
                    <?=$errors['price'][0]?>
                <?php endif;?>
            </span>
        </div>
        <div class="form-floating mb-3 col-5">
            <input type="number" name="count" class="form-control mb-2" id="count" placeholder="name@example.com">
            <label for="count">count</label>
            <span class="text-danger">
                <?php if(isset($errors['count'])):?>
                    <?=$errors['count'][0]?>
                <?php endif; ?>
            </span>
        </div>
        <div class=" mb-3 col-5">
            <label for="CategoryId"> category </label>
  
            <select name="category_id" id="CategoryId">
                <?php foreach ($category as $item): ?>
                    <option value="<?=$item['id'];?>"><?=$item['title'];?></option>     
                <?php endforeach;?>      
            </select>
        </div>

        <span>
            <button class=" btn btn-lg btn-primary col-1" type="submit">add</button>
            <a class=" btn btn-lg btn-danger" href="/dashboard/product">back</a>
        </span>

    </form>

</body>
</html>