<?php
$title = 'Sign Up Page';
$hideBurgerMenu = true;
require_once "../controller/auth/sign-upController.php";
require_once '../includes/header.php'
?>

    <section class="sign-up">
        <div class="sign-up-container">
            <h1>Create account</h1>
            <form action="../controller/auth/sign-upController.php" id="form" method="POST">
                <label for="form-username">Your Name</label>
                <div class="form-controls">
                    <input type="text" name="username" id="form-username" placeholder="Your First name" class="input-pd"
                           value="<?php echo htmlspecialchars($_SESSION['form_data']['username'] ?? ''); ?>">
                    <?php if (!empty($_SESSION['name_error'])): ?>
                        <span class="error"> <?= $_SESSION['name_error'] ?></span>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['username_taken_error'])): ?>
                        <span class="error"> <?= $_SESSION['username_taken_error'] ?></span>
                    <?php endif; ?>
                    <?php unset($_SESSION['name_error'], $_SESSION['username_taken_error']); ?>
                </div>

                <label for="form-password">Password</label>
                <div class="form-controls">
                    <input type="password" name="password" id="form-password" placeholder="at least 8 characters" class="input-pd">
                    <?php if(!empty($_SESSION['password_error'])) :?>
                        <span class="error"> <?= $_SESSION['password_error']?></span>
                    <?php endif;?>
                    <?php unset($_SESSION['password_error'])?>
                </div>

                <label for="form-confirmed-password">Re-enter password</label>
                <div class="form-controls">
                    <input type="password" name="re_enter_password" id="form-confirmed-password" class="input-pd">
                    <?php if(!empty($_SESSION['re_enter_password_error'])) :?>
                        <span class="error"> <?= $_SESSION['re_enter_password_error']?></span>
                    <?php endif;?>
                    <?php unset($_SESSION['re_enter_password_error'])?>
                </div>
                <button type="submit" id="submit">Create your MovieMingle account</button>
            </form>
            <p class="signin-link">Already have an account? <a href="./login.php">Sign in</a></p>
        </div>
    </section>
<?php
unset($_SESSION['form_data']);
?>
<?php require_once '../includes/footer.php'; ?>
