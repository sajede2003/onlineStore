<h1>create an account</h1>


<form action="" method="POST">
    <div class="row">
        <div class="col">
            <div class=" form-floating mb-3">
                <input type="text" name="firstname" id="floatingInput" class="form-control" placeholder="name@example.com">
                <label for="floatingInput">first name</label>
            </div>
        </div>
        <div class="col">
            <div class=" form-floating mb-3">
                <input type="text" name="lastname" id="floatingInput" class="form-control" placeholder="name@example.com">
                <label for="floatingInput">last name</label>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="email" name="email" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="password" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="confirmPassword" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">confirm password</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
