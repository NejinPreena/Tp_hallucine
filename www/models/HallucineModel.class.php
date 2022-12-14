<?php

    require_once "Model.class.php";
    require_once "Movie.class.php";

    class HallucineModel extends Model{
        private $_movies;

        public function requestMovies(){
            $_movies = array();
            $sql = "SELECT * FROM `movies` ORDER BY title;";

            $request = $this->_getDatabase("localhost", "hallucine", "root", "root")->prepare($sql);
            $request->execute();
            $rows = $request->fetchAll(PDO::FETCH_ASSOC); 
            $request->closeCursor();

            foreach ($rows as $key => $value) {
            $movie = new Movie($value["id"], $value["title"], $value["image_url"], $value["runtime"], $value["description"], $value["release_date"]/*, $value["added_date"]*/);
            $this->_movies[] = $movie;
            }
        }

        public function getMovies(){return $this->_movies;}
    }
?>