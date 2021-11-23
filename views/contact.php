<h1>contact page</h1>


<form action="/contact" method="POST">
    <div class=" form-floating mb-3">
        <input type="text" name="subject"  class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingPassword">subject *</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" name="email"  class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingPassword">Email address *</label>
    </div>
    <div class=" form-floating mb-3">
        <textarea name="body" id="floatingInput" class="form-control"></textarea>
        <label for="floatingPassword">Body *</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
