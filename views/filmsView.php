<?php

global $conn;
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['isadmin']) || !$_SESSION['isadmin']) {
    header('Location: /PHPjs/views/login.php');
    exit;
}
$title = 'Film Dashboard';
$dashcss = '../public/css/dashboard.css';
require_once "../controller/admin/FilmController.php";
require_once '../includes/header.php';
$genres = fetchGenres($conn);
$films = fetchFilms($conn);

?>

<section class="container">
    <div class="row flex-nowrap">
        <?php include '../includes/sidebar.php'; ?>

        <!-- content -->
        <div class="content m-1 p-md-4 col-md-9 col-9 min-vh-100">
            <div class="doughnut  p-3 rounded-4 d-flex flex-column gap-5">
                <h1 class="title fs-5">Films table</h1>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    add
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Film</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="filmTitle" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="filmTitle" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="filmDuration" class="form-label">Duration (in minutes)</label>
                                        <input type="number" class="form-control" id="filmDuration" name="duration">
                                    </div>
                                    <div class="mb-3">
                                        <label for="filmReleaseDate" class="form-label">Release Date</label>
                                        <input type="date" class="form-control" id="filmReleaseDate" name="releaseDate">
                                    </div>
                                    <div class="mb-3">
                                        <label for="filmGenre" class="form-label">Genre</label>
                                        <select class="form-select" id="filmGenre" name="genreId">
                                            <?php foreach ($genres as $genre): ?>
                                                <option value="<?= htmlspecialchars($genre['id']) ?>"><?= htmlspecialchars($genre['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="addfilm" class="btn btn-primary">Add Film</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-12">
                    <!-- Film Table -->
                    <div class="col-12 mb-3">
                        <table class="table table-dark table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Release Date</th>
                                <th>Genre </th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($films as $film): ?>
                                <tr>
                                    <td><?= htmlspecialchars($film['id']) ?></td>
                                    <td><?= htmlspecialchars($film['title']) ?></td>
                                    <td><?= htmlspecialchars($film['duration']) ?></td>
                                    <td><?= htmlspecialchars($film['releasedate']) ?></td>
                                    <td><?= htmlspecialchars($film['genre_name']) ?></td>
                                    <td>
                                        <button class="btn btn-primary mb-2"
                                                onclick="openEditModal({
                                                        'id': '<?= htmlspecialchars($film['id']) ?>',
                                                        'title': '<?= htmlspecialchars(addslashes($film['title'])) ?>',
                                                        'duration': '<?= htmlspecialchars($film['duration']) ?>',
                                                        'releasedate': '<?= htmlspecialchars(date('Y-m-d', strtotime($film['releasedate']))) ?>',
                                                        'genre_id': '<?= htmlspecialchars($film['genre_id']) ?>'
                                                        })">
                                            Edit
                                        </button>
                                        <form action="filmsView.php" method="POST" style="display: block;">
                                            <input type="hidden" name="filmId" value="<?= htmlspecialchars($film['id']) ?>">
                                            <button type="submit" name="deleteFilm" class="btn btn-danger w-100">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</section>
<!-- Edit Modal -->
<div class="modal fade" id="editFilmModal" tabindex="-1" aria-labelledby="editFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFilmModalLabel">Edit Film</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFilmForm" method="POST">
                    <input type="hidden" id="editFilmId" name="filmId">
                    <div class="mb-3">
                        <label for="editFilmTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editFilmTitle" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="editFilmDuration" class="form-label">Duration (in minutes)</label>
                        <input type="number" class="form-control" id="editFilmDuration" name="duration">
                    </div>
                    <div class="mb-3">
                        <label for="editFilmReleaseDate" class="form-label">Release Date</label>
                        <input type="date" class="form-control" id="editFilmReleaseDate" name="releaseDate">
                    </div>
                    <div class="mb-3">
                        <label for="editFilmGenre" class="form-label">Genre</label>
                        <select class="form-select" id="editFilmGenre" name="genreId">
                        <?php foreach ($genres as $genre): ?>
                                <option value="<?= htmlspecialchars($genre['id']) ?>"><?= htmlspecialchars($genre['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="updateFilm" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
$conn->close();
?>

</body>

</html>

    </div>
</section>
<?php require_once '../includes/footer.php'; ?>
