<?php
    include_once("utilities/settings.php");

    class Movie{
        private $conn = null;
        private $id = null;
        private $movie_title = null;
        private $movie_genre = null;
        private $movie_about = null;
        private $movie_cover = null;
        private $create_stmnt = "INSERT INTO movie (Movie_Title, Movie_Genre, About_Movie, Movie_Cover) VALUES(:Movie_Title, :Movie_Genre, :About_Movie, :Movie_Cover)";
        private $read_stmnt = "SELECT * FROM movie WHERE ";
        private $read_all_stmnt = "SELECT * FROM movie";
        private $update_stmnt = "UPDATE movie SET Movie_Title=:Movie_Title, Movie_Genre=:Movie_Genre, About_Movie=:About_Movie, Movie_Cover=:Movie_Cover WHERE Movie_ID=:Movie_ID";
        private $delete_stmnt = "DELETE FROM movie WHERE Movie_ID=:Movie_ID";


        function __construct($movie_title = 'none', $movie_about = 'none', $movie_genre = 'none', $movie_cover = 'none')
        {
            $this->movie_title = $movie_title;
            $this->movie_about = $movie_about;
            $this->movie_genre = $movie_genre;
            $this->movie_cover = $movie_cover;
            try {
                $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e){
                echo "Error: " . $e->getMessage() . "<br/>";
            }
        }

        function __destruct()
        {
            try {
                $this->conn = null;
            } catch (PDOException $e){
                echo "Error: " . $e->getMessage() . "<br/>";
            }
        }
        
        function create()
        {
            $stmt = $this->conn->prepare($this->create_stmnt);
            $stmt->bindParam(':Movie_Title', $this->movie_title);
            $stmt->bindParam(':Movie_Genre', $this->movie_genre);
            $stmt->bindParam(':About_Movie', $this->movie_about);
            $stmt->bindParam(':Movie_Cover', $this->movie_cover);

            try {
                $res = $stmt->execute();
            } catch (PDOException $e){
                return "Error: " . $e->getMessage() . "<br/>";
            }

            if ($res) {
                $this->id = $this->conn->lastInsertId();
                return "Create query successful.";
            }
            
            return "Create query unsuccessful.";
        }
        
        function read($condition)
        {
            $stmnt = $this->conn->prepare($this->read_stmnt.$condition);

            try {
                $stmnt->execute();
            } catch (PDOException $e){
                return "Error: " . $e->getMessage() . "<br/>";
            }
            
            if ($stmnt->rowCount() > 0) {
                return $stmnt->fetchAll();
            }
            return "Empty query result";
        }

        function read_all()
        {
            $stmnt = $this->conn->prepare($this->read_all_stmnt);

            try {
                $stmnt->execute();
            } catch (PDOException $e){
                return "Error: " . $e->getMessage() . "<br/>";
            }

            if ($stmnt->rowCount()) {
                return $stmnt->fetchAll();
            }
            return "Empty query result";
        }

        function update($m_id = 'none')
        {
            if ($m_id == 'none'){
                $m_id = $this->id;
            }
            $stmt = $this->conn->prepare($this->update_stmnt);
            $stmt->bindParam(':Movie_Title', $this->movie_title);
            $stmt->bindParam(':Movie_Genre', $this->movie_genre);
            $stmt->bindParam(':About_Movie', $this->movie_about);
            $stmt->bindParam(':Movie_Cover', $this->movie_cover);
            $stmt->bindParam(':Movie_ID', $m_id);

            try {
                $res = $stmt->execute();
            } catch (PDOException $e){
                return "Error: " . $e->getMessage() . "<br/>";
            }

            if ($res) {
                return "Update query successful.";
            }
            
            return "Update query unsuccessful.";
        }

        function delete($m_id = 'none')
        {
            if ($m_id == 'none'){
                $m_id = $this->id;
            }
            $stmt = $this->conn->prepare($this->delete_stmnt);
            $stmt->bindParam(':Movie_ID', $this->id);

            try {
                $res = $stmt->execute();
            } catch (PDOException $e){
                return "Error: " . $e->getMessage() . "<br/>";
            }

            if ($res) {
                return "Delete query successful.";
            }
            
            return "Delete query unsuccessful.";
        }
    }
    
?>