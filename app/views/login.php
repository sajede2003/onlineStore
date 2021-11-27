<h1>login account</h1>
<br>

<form action="/" method="POST">
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address or UserName</label>
        <span class="invalidFeedback">
            <?= $data['usernameError']; ?>
        </span>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        <span class="invalidFeedback">
            <?= $data['passwordError']; ?>
        </span> <br>
    </div>
    <p>Not register yet?<a href="/register">create an account</a></p>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
