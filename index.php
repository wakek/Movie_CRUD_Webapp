<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Script -->
        <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
        <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="views/js/datatables.min.js"></script>
    <script type="text/javascript" src="views/js/index.js"></script>

    <!-- CSS -->
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="views/css/overlay.css">
    <link rel="stylesheet" href="views/css/index.css">

    <title>Movie Catalog</title>
</head>
<body>

    <div class="table-wrapper-scroll-y my-custom-scrollbar pagination_div">

        <h1><b>Movie CRUD</b></h1>

        <br>

        <table id="dtBasic" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="color: white;">
        <thead style="background: white; color: black">
            <tr>
            <th class="th-sm">Id

            </th>
            <th class="th-sm">Title

            </th>
            <th class="th-sm">Genre

            </th>
            <th class="th-sm">About

            </th>
            <th class="th-sm">Action

            </th>
            </tr>
        </thead>
        <tbody>
            <?php
                include_once('models/movie.php');
                $movie = new Movie();
                $res = $movie->read_all();
                if ($res != "Empty query result.")
                {
                    foreach ($res as $row)
                    {
                    echo '<tr>';
                    echo '<td>'.$row[0].'</td>';
                    echo '<td>'.$row[1].'</td>';
                    echo '<td>'.$row[2].'</td>';
                    echo '<td>'.$row[3].'</td>';
                    echo '<td> <form class="crud-action-forms" action="controllers/movie_controller.php" method="POST">'.
                    '<input name="movie_id" id="movie_id_'.$row[0].'" type="hidden" value="'.$row[0].'">'.
                    '<input name="movie_title" id="movie_title_'.$row[0].'" type="hidden" value="'.$row[1].'">'.
                    '<input name="movie_genre" id="movie_genre_'.$row[0].'" type="hidden" value="'.$row[2].'">'.
                    '<input name="movie_about" id="movie_about_'.$row[0].'" type="hidden" value="'.$row[3].'">'.
                    '<input name="update_movie" type="hidden" value="empty">'.
                    '<a class="goto_update_movie_form" id="'.$row[0].'"><i class="far fa-edit"></i></a>'.
                    '</form>';
                    echo '<form id="delete_movie_form" class="crud-action-forms" action="controllers/movie_controller.php" method="POST">'.
                    '<input name="movie_id" id="movie_id" type="hidden" value="'.$row[0].'">'.
                    '<input name="delete_movie" type="hidden" value="">'.
                    '<a class="delete_movie"><i class="fas fa-trash-alt"></i></a>'.
                    '</form> </td>';
                    echo '</tr>';
                    }
                }
            ?>
        </tbody>
        <tfoot style="background: white; color: black">
            <tr>
            <th>Id
            </th>
            <th>Title
            </th>
            <th>Genre
            </th>
            <th>About
            </th>
            <th>Action
            </th>
            </tr>
        </tfoot>
        </table>

    </div>

    <div id="add_btn_div">
        <button class="btn button-gradient" id="goto_create_movie_form">Create Entry</button>
    </div>

    <div id="overlay"></div>
</body>
</html>