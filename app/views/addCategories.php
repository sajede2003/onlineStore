
<form action="/dashboard/category/add" method="POST">
    <h1 class="h3 mb-3 fw-normal">add category Page</h1>
    <div class="form-floating mb-3 col-5">
        <input type="text" name="title"  class="form-control mb-2" id="title" placeholder="name@example.com">
        <label for="title">title</label>
        <span class="invalidFeedback text-danger">
            <?php if(isset($error)): ?>
                <?=$error['title'][0]?>
            <?php endif; ?>
        </span>
    </div>

    <span>
        <button class=" btn btn-lg btn-primary col-1" type="submit">add</button>
        <a class=" btn btn-lg btn-danger" href="/dashboard/category">back</a>
    </span>
</form>