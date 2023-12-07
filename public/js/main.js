const menu = document.querySelector('nav .container .sub-menu');
const burgerMenu  = document.querySelector('.burger-menu ');

burgerMenu.addEventListener('click', () => {
    menu.classList.toggle("active");
})
function openEditModal(film) {
    document.getElementById('editFilmId').value = film.id;
    document.getElementById('editFilmTitle').value = film.title;
    document.getElementById('editFilmDuration').value = film.duration;
    document.getElementById('editFilmReleaseDate').value = film.releasedate;

    const genreSelect = document.getElementById('editFilmGenre');
    genreSelect.value = film.genre_id;

    let editModal = new bootstrap.Modal(document.getElementById('editFilmModal'));
    editModal.show();
}

