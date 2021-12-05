<h1>contact page</h1>


<form action="/contact" method="POST">
    <div class=" form-floating mb-3">
        <input type="text" name="subject"  class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingPassword">subject *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if(isset($error['subject'])): ?>
                <?=$error['subject'][0]; ?>
            <?php endif; ?>
        </span>
    </div>
    <div class="form-floating mb-3">
        <input type="email" name="email"  class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingPassword">Email address *</label>
        <span class="invalidFeedback" style="color: red;">
                <?php if(isset($error['email'])): ?>
                    <?= $error['email'][0]; ?>
                <?php endif; ?>
        </span>
    </div>
    <div class=" form-floating mb-3">
        <textarea name="comment" id="floatingInput" class="form-control"></textarea>
        <label for="floatingPassword">Body *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if(isset($error['comment'])): ?>
                <?= $error['comment'][0];?>
            <?php endif;?>
        </span>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
