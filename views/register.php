<h1>create an account</h1>


<form action="/register" method="POST">
    <div class="row">
        <div class="col">
            <div class=" form-floating mb-3">
                <input type="text" name="firstname" id="floatingInput" class="form-control" placeholder="name@example.com">
                <label for="floatingInput">First Name *</label>
            </div>
        </div>
        <div class="col">
            <div class=" form-floating mb-3">
                <input type="text" name="lastname" id="floatingInput" class="form-control" placeholder="name@example.com">
                <label for="floatingInput">Last Name</label>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="number" name="phoneNumber" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Phone Number *</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" name="email" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Email Address *</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="password" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Password *</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="confirmPassword" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Confirm Password *</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
