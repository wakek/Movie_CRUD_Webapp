$(document).ready(function() {
    $('#dtBasic').DataTable();
    $('.dataTables_length').addClass('bs-select');

    $("#goto_create_movie_form").click(function() {
        $("#overlay").load("views/create_movie.php", {
            movie_create: 'ignore'
        }, function(data, status) {
            on();
        });
    })

    $(".goto_update_movie_form").click(function() {
        $movie_id = $(this).attr("id");
        $("#overlay").load("views/update_movie.php", {
            movie_id: $("#movie_id_" + $movie_id).val(),
            movie_title: $("#movie_title_" + $movie_id).val(),
            movie_genre: $("#movie_genre_" + $movie_id).val(),
            movie_about: $("#movie_about_" + $movie_id).val()
        }, function(data, status) {
            on();
        });
    })

    $(".delete_movie").click(function() {
        if (confirm('Are you sure you want to delete this record?')) {
            $("#delete_movie_form").submit();
        } else {
            // Do nothing!
        }

    })

    // Close form when clicking outside
    $("body").click(function(e) {
        if (e.target.id == "container" || $(e.target).parents("#wrapper").length) {

        } else {
            off();
        }
    });

    function on() {
        document.getElementById("overlay").style.display = "block";
    }

    function off() {
        document.getElementById("overlay").style.display = "none";
    }

});