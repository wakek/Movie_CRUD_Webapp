<div id="wrapper">
    <div id="container">
        <div id="card">

            <div id="title">
                <h2><b>CREATE<b></h2>
            </div>

            <br/>
            
            <form id="create_movie_form" action="controllers/movie_controller.php" enctype="multipart/form-data" method="POST">
                <input name="create_movie" id="create_movie" type="hidden" value="">
                <label for="movie_title" class="inp">
                    <input name="movie_title" id="movie_title" placeholder="&nbsp" type="text" required />
                    <span class="label">Title</span>
                    <span class="border"></span>
                </label>
                <br/>
                <br/>
                <label for="movie_genre" class="inp">
                    <input name="movie_genre" id="movie_genre" placeholder="&nbsp" type="text" required />
                    <span class="label">Genre</span>
                    <span class="border"></span>
                </label>
                <br/>
                <br/>
                <label for="movie_about" class="inp">
                    <textarea name="movie_about" id="movie_about" placeholder="&nbsp" rows="5"></textarea>
                    <span class="label">About</span>
                    <span class="border"></span>
                </label>
                <br/>
                <br/>
                <label for="movie_cover" class="inp" style="padding: 0px">
                    <i class="fas fa-upload"></i>Upload Movie Cover
                    <input name="movie_cover" id="movie_cover" type="file" accept="image/*" required>
                </label>
                <br/>
                <label for="file_selected" class="inp">
                    <input name="file_selected" id="file_selected" placeholder="&nbsp" type="text" readonly />
                    <span class="label" id="file_selected_placeholder">Image selected...</span>
                    <span class="border"></span>
                </label>
                <br/>
                <br/>
                <a class="submit_btn" id="create_movie_final">Create</a>
            </form>
        </div>
    </div>
</div>

<script>
    // Show file (image) selected
    $('input[type=file]').change(function(e) {
        $("#file_selected").prop('readonly', false);
        $("#file_selected_placeholder").text('');
        $("#file_selected").prop('value', e.target.files[0].name);
        $("#file_selected").prop('readonly', true);
    });

    $("#create_movie_final").click(function() {
        let movie_title = $("#movie_title").val();
        let movie_genre = $("#movie_genre").val();
        let movie_about = $("#movie_about").val();
        let movie_cover = $("#file_selected").val();
        if (movie_title != "" && movie_genre != "" && movie_about != "" && movie_cover != "") {
            $("#create_movie_form").submit();
        }
    })
</script>