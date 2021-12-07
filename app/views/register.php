<?php
// dd($error);
?>


<h1>create an account</h1>


<form action="/register" method="POST">
    <div class=" form-floating mb-3">
        <input type="text" name="full_name" id="floatingInput" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Full Name</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if (isset($error['full_name'])): ?>
                <?=$error['full_name'][0];?>
            <?php endif;?>
        </span>
    </div>
    <div class="form-floating mb-3">
        <input type="text" name="phone_number" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Phone Number *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if (isset($error['phone_number'])): ?>
                <?=$error['phone_number'][0];?>
            <?php endif;?>
        </span>
    </div>
    <div class="form-floating mb-3">
        <input type="email" name="email" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Email Address *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if (isset($error['email'])): ?>
                <?=$error['email'][0];?>
            <?php endif;?>
        </span>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="password" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Password *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if (isset($error['password'])): ?>
                <?=$error['password'][0];?>
            <?php endif;?>
        </span>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="confirmPassword" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Confirm Password *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if (isset($error['confirmPassword'])): ?>
                <?=$error['confirmPassword'][0];?>
            <?php endif;?>
        </span>
    </div>
    <P>Do you have account? <a href="login">login</a></P>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>