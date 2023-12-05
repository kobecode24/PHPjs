<?php
require_once '../controller/auth/LoginController.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: /PHPjs/views/user_home.php'); // Redirect to user home or dashboard
    exit;
}
$title = 'Login Page';
$hideBurgerMenu = true;

require_once '../includes/header.php'
?>


    <section class="sign-up sign-in">
        <div class="sign-up-container">
            <h1>Login</h1>
            <?php if (!empty($_SESSION['login_error'])): ?>
                <div class="error"><?= $_SESSION['login_error']; ?></div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>

            <form id="form" action="../controller/auth/LoginController.php" method="post">
                <div class="form-controls">
                    <label for="form-name">Username</label>
                    <input type="text" name="username" id="form-name" placeholder="Your username" class="input-pd"
                           value="<?php
                           if (isset($_SESSION['form_data']['username'])) {
                               echo htmlspecialchars($_SESSION['form_data']['username']);
                           } else {
                               echo '';
                           }
                           ?>">
                    <?php if (!empty($_SESSION['name_error'])): ?>
                        <span class="error"><?= $_SESSION['name_error']; ?></span>
                        <?php unset($_SESSION['name_error']); ?>
                    <?php endif; ?>
                </div>

                <div class="form-controls">
                    <label for="form-password">Password</label>
                    <input type="password" name="password" id="form-password" placeholder="Your password" class="input-pd"
                            value="<?php
                            if (isset($_SESSION['form_data']['password'])) {
                                 echo htmlspecialchars($_SESSION['form_data']['password']);
                            } else {
                                 echo '';
                            }
                            ?>">
                    <?php if (!empty($_SESSION['password_error'])): ?>
                        <span class="error"><?= $_SESSION['password_error']; ?></span>
                        <?php unset($_SESSION['password_error']); ?>
                    <?php endif; ?>
                </div>

                <button type="submit" id="submit">Sign in</button>
            </form>
            <p class="signin-link">Don't have an account?<a href="./sign-up.php"> Sign up</a></p>
        </div>
    </section>

    <?php
    unset($_SESSION['form_data']);
    ?>


<?php require_once '../includes/footer.php'; ?>

