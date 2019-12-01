<div id="wrapper">
    <div id="container">
        <div id="card">

            <div id="title">
                <h2><b>UPDATE<b></h2>
            </div>

            <br/>
            
            <form form id="update_movie_form" action="controllers/movie_controller.php" enctype="multipart/form-data" method="POST">
                <input name="update_movie" id="update_movie" type="hidden" value="">
                <?php echo '<input name="m_id" id="m_id" type=hidden value="'.$_POST['movie_id'].'" />'; ?>
                <label for="movie_title" class="inp">
                    <?php echo '<input name="movie_title" id="movie_title" placeholder="&nbsp" type="text" value="'.$_POST['movie_title'].'" required />'; ?>
                    <!-- <input name="movie_title" id="movie_title" placeholder="&nbsp" type="text" required /> -->
                    <span class="label">Title</span>
                    <span class="border"></span>
                </label>
                <br/>
                <br/>
                <label for="movie_genre" class="inp">
                    <?php echo '<input name="movie_genre" id="movie_genre" placeholder="&nbsp" type="text" value="'.$_POST['movie_genre'].'" required />'; ?>
                    <!-- <input name="movie_genre" id="movie_genre" placeholder="&nbsp" type="text" required /> -->
                    <span class="label">Genre</span>
                    <span class="border"></span>
                </label>
                <br/>
                <br/>
                <label for="movie_about" class="inp">
                    <?php echo '<textarea name="movie_about" id="movie_about" placeholder="&nbsp" rows="5">'.$_POST['movie_about'].'</textarea>'; ?>
                    <!-- <textarea name="movie_about" id="movie_about" placeholder="&nbsp" rows="5"></textarea> -->
                    <span class="label">About</span>
                    <span class="border"></span>
                </label>
                <br/>
                <br/>
                <label for="movie_cover" class="inp" style="padding: 0px">
                    <!-- <span class="label">Cover</span> -->
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
                <a class="submit_btn" id="update_movie_final">Update</a>
            </form>

            <?php

            ?>
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

    $("#update_movie_final").click(function() {
        let movie_title = $("#movie_title").val();
        let movie_genre = $("#movie_genre").val();
        let movie_about = $("#movie_about").val();
        let movie_cover = $("#file_selected").val();
        if (movie_title != "" && movie_genre != "" && movie_about != "" && movie_cover != "") {
            $("#update_movie_form").submit();
        }
    })
</script>