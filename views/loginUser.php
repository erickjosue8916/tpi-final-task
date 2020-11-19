

<main class="container h-100 d-flex justify-content-center align-items-center">
    <content>
    <h1>login</h1>
    <?php if (isset($error)) { ?>
        <div class="alert bg-danger text-white" role="alert">
        <?=$error;?>
        </div>
    <?php } ?>
    <form action="" method="POST">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" id="form1Example1" name="email" class="form-control" required/>
        <label class="form-label" for="form1Example1">email</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="form1Example2" name="password" class="form-control" required/>
        <label class="form-label" for="form1Example2">Password</label>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
    </form>
    </content>
</main>