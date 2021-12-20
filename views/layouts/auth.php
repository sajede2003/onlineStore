<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <header class="p-3 bg-dark text-white">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li style="font-size: 33px;">Admin Dashboard</li>
          </ul>
          <div class="text-end">
            <a href="/" class="btn btn-outline-light me-2">Home</a>
            <a href="/logout" class="btn btn-warning">LogOut</a>
          </div>
        </div>
      </div>
    </header>

    <div style="height: 92%;">
        <div style=" height: 100%; display: flex;">
            <nav class=" bg-light sidebar " style="width: 15%;">
                <div class="sidebar-sticky">
                    <ul class="list-group">
                        <li class="list-group-item ">
                            <a href="/dashboard" class="text-dark h5">
                                Dashboard
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="/dashboard/users" class="text-dark h5">
                                Users
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="/dashboard/category" class="text-dark h5">
                                category 
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="/dashboard/product" class="text-dark h5">
                                Product
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container">
              {{content}}
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   
  </body>
</html>