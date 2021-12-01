<?php
    // dd($error);
?>


<h1>create an account</h1>


<form action="/register" method="POST">
    <div class="row">
        <div class="col">
            <div class=" form-floating mb-3">
                <input type="text" name="firstName" id="floatingInput" class="form-control" placeholder="name@example.com">
                <label for="floatingInput">First Name</label>
                <span class="invalidFeedback" style="color: red;">
                <?php if (isset($error['firstName'])): ?>
                        <?=$error['firstName'][0];?>
                    <?php endif;?>
                </span>
            </div>
        </div>
        <div class="col">
            <div class=" form-floating mb-3">
                <input type="text" name="lastName" id="floatingInput" class="form-control" placeholder="name@example.com">
                <label for="floatingInput">Last Name</label>
                <span class="invalidFeedback" style="color: red;">
                    <?php if (isset($error['lastName'])): ?>
                        <?=$error['lastName'][0];?>
                    <?php endif;?>
                </span>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" name="phoneNumber" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Phone Number *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if(isset($error['phoneNumber'])): ?>
                <?= $error['phoneNumber'][0]; ?>
            <?php endif;?>
        </span>
    </div>
    <div class="form-floating mb-3">
        <input type="email" name="email" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Email Address *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if(isset($error['email'])): ?>
                <?= $error['email'][0]; ?>
            <?php endif;?>
        </span>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="password" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Password *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if(isset($error['password'])): ?>
                <?= $error['password'][0]; ?>
            <?php endif;?>
        </span>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="confirmPassword" id="floatingPassword" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Confirm Password *</label>
        <span class="invalidFeedback" style="color: red;">
            <?php if(isset($error['confirmPassword'])): ?>
                <?= $error['confirmPassword'][0]; ?>
            <?php endif;?>
        </span>
    </div>
    <P>Do you have account? <a href="login">login</a></P>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>