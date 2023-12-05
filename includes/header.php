<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Page'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <script src="../public/js/main.js" defer></script>
    <link rel="stylesheet" href="<?php echo $page_css ?? '../public/css/sign-up.css'; ?>">
</head>
<body>

<nav>
    <div class="container d-flex justify-content-between gap-md-3 gap-lg-5 align-items-center position-relative">
        <div class="d-flex w-sm-100 align-items-center justify-content-between gap-3">
            <div class="logo"><img class="img-fluid" src="../public/assets/imgs/logo.png" alt="logo"></div>
            <?php if (!isset($hideBurgerMenu)): ?>
                <div class="menu"><i class="fa-solid fa-bars burger-menu fs-3 text-white"></i></div>
        </div>
            <div class="sub-menu d-flex w-25 justify-content-center">
                <ul class="">
                    <li><a class="text-capitalize" href="./contact.html">contact</a></li>
                    <li><a class="text-capitalize" href="./dashboard.html">dashboard</a></li>
                    <li><a class="text-capitalize" href="./about.html">about</a></li>
                </ul>
            </div>
            <div class="search-wrapper flex-grow-1">
                <input class="py-2 px-3 rounded-2 w-100 border-0 d-none d-md-block" type="text" placeholder="Search">
            </div>

        <div class="sign-in-wrapper d-flex align-items-center gap-3">
            <a href="./MoviesSeries.html" class="fw-semibold text-white d-none d-md-block"> Watchlist</a>
            <select class="form-select d-none d-md-block" aria-label="Default select example">
                <option selected>En</option>
                <option value="2">Fr</option>
                <option value="3">Sp</option>
            </select>
            <?php endif; ?>
        </div>
    </div>
</nav>
