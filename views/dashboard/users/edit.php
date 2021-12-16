<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/dashboard/users/edit" method="POST">
        <input type="hidden" name="id" value="<?=$data[0]->id?>">
        <div class="form-floating mb-3 col-5">
            <input type="text" name="full_name" value="<?=$data[0]->full_name;?>" class="form-control mb-2" id="FullName" placeholder="name@example.com">
            <label for="FullName">Full name</label>
        </div>
        <div class="form-floating mb-3 col-5">
            <input type="text" name="phone_number" value="<?=$data[0]->phone_number?>" class="form-control mb-2" id="PhoneNumber" placeholder="name@example.com">
            <label for="PhoneNumber">phone number</label>
        </div>
        <div class="mb-3 col-5">
            <label for="email" class="form-label ">email : </label>
            <textarea name="email" class="form-control mb-2" id="email" rows="3"><?=$data[0]->email?></textarea>
        </div>

        <span>
            <button class=" btn btn-lg btn-primary col-1" type="submit">edit</button>
            <a class=" btn btn-lg btn-danger" href="/dashboard/users">back</a>
        </span>
    </form>
</body>
</html>