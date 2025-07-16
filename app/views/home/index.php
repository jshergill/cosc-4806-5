<?php require_once 'app/views/templates/header.php' ?>
<main class="container mt-5 mb-5" style="max-width: 700px;">
    <div class="text-center mb-4">
        <h1 class="fw-semibold display-5"> Hey</h1>
        <p class="text-muted fs-5"><?= date("F jS, Y"); ?></p>
    </div>

    <div class="d-flex justify-content-center">
        <a href="/logout" class="btn btn-outline-danger rounded-pill px-4 py-2 shadow-sm">
             Logout
        </a>
    </div>
</main>
<?php require_once 'app/views/templates/footer.php' ?>
