<h1>contact page</h1>


<form action="/contact" method="POST">
    <div class="mb-3">
        <label>subject</label>
        <input type="text" name="subject" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email address</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Body</label>
        <textarea name="body" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
