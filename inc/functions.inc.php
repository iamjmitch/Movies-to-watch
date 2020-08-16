<?php
require_once 'dbh.inc.php';


class movieGetter extends db
{

    function grabFromApi($search)
    {
        $term = str_replace(" ", "%20", $search);
        $url = "http://www.omdbapi.com/?s=" . $term . "&type=movie&plot=short&apikey=" . $this->apitoken;

        $result = file_get_contents($url);
        $input = json_decode($result, true);
        $output = [];

        foreach ($input["Search"] as $value)
        {
            $tempArray = [];
            $arrayName = $value["imdbID"];
            $tempArray['Title'] = $value['Title'];
            $tempArray['imdbID'] = $value['imdbID'];
            $tempArray['Poster'] = $value['Poster'];
            $tempArray['Year'] = $value['Year'];
            $output[$arrayName] = $tempArray;
        }
        return $output;
    }

    function getDeets($imdbID)
    {
        $url = "http://www.omdbapi.com/?i=" . $imdbID . "&apikey=" . $this->apitoken;
        $result = json_decode(file_get_contents($url) , true);
        $data = [];
        $data['Plot'] = $result['Plot'];
        $data['Year'] = $result['Year'];
        $data['Genre'] = $result['Genre'];
        $data['Runtime'] = $result['Runtime'];
        return $data;
    }

    function getGenre($imdbID)
    {
        $url = "http://www.omdbapi.com/?i=" . $imdbID . "&apikey=" . $this->apitoken;
        $result = json_decode(file_get_contents($url) , true);
        return $result['Plot'];
    }

    function getYear($imdbID)
    {
        $url = "http://www.omdbapi.com/?i=" . $imdbID . "&apikey=" . $this->apitoken;
        $result = json_decode(file_get_contents($url) , true);
        return $result['Plot'];
    }

    function getRunTime($imdbID)
    {
        $url = "http://www.omdbapi.com/?i=" . $imdbID . "&apikey=" . $this->apitoken;
        $result = json_decode(file_get_contents($url) , true);
        return preg_replace("/[^0-9]/", "", $result['Runtime']);

    }

    function displayResults($query)
    {
        $result = $this->grabFromApi($query);
        echo '<div class="resultsContainer">';
        foreach ($result as $key)
        {
            if ($this->getRunTime($key['imdbID']) > "70")
            {
                echo '<div class="result">';

                echo '<div class="imgContainer"><img src="' . $key['Poster'] . '"></div>';

                echo '<p>' . $key['Title'] . ' (' . $key['Year'] . ')</p>';
                echo '<form action="addmovie.php" method="POST">';
                echo '<input type="hidden" name="Title" ID="Title" value="' . $key['Title'] . '">';
                echo '<input type="hidden" name="imdbID" ID="imdbID" value="' . $key['imdbID'] . '">';
                echo '<input type="hidden" name="poster" ID="poster" value="' . $key['Poster'] . '">';
                echo '<button type="submit" name="submitSelect" id="submitSelect">Select</button>';
                echo '</form>';
                echo '</div>';
            }
        }
        echo '</div>';
    }

    public function convert($string)
    {
        $i = '"' . $string . '"';
        return $i;
    }

    function addMovieToDB($name, $imdbID, $Poster, $Plot, $year, $genre, $runtime)
    {
        $cname = $this->convert($name);
        $cimdbID = $this->convert($imdbID);
        $cPoster = $this->convert($Poster);
        $cPlot = $this->convert($Plot);
        $cyear = $this->convert($year);
        $cgenre = $this->convert($genre);
        $cruntime = $this->convert($runtime);
        $query = "INSERT INTO movies (MovieName, PosterSrc, Plot, imdbID, mYear, Genre, runtime ) VALUES ($cname, $cPoster, $cPlot, $cimdbID, $cyear, $cgenre, $cruntime)";
        $result = $this->connect()
            ->query($query);
        $result;

    }

    private function removeMovieToDB($imdbID)
    {
        $cimdbID = $this->convert($imdbID);
        $query = "DELETE FROM movies WHERE imdbID = $cimdbID";
        $result = $this->connect()
            ->query($query);
        $result;

    }

    public function remove($imdbID)
    {
        $this->removeMovieToDB($imdbID);
    }

    public function processAdd($name, $imdbID, $Poster)
    {
        $data = $this->getDeets($imdbID);
        $runtime = $data['Runtime'];
        $genre = $data['Genre'];
        $year = $data['Year'];
        $plot = $data['Plot'];
        $this->addMovieToDB($name, $imdbID, $Poster, $plot, $year, $genre, $runtime);
    }

    private function displayMovies()
    {
        $query = "SELECT * FROM movies";
        $result = $this->connect()
            ->query($query);
        echo '<div class="movieContainer">';
        while ($row = $result->fetch_assoc())
        {
            $YTReady = str_replace(" ", "+", $row["MovieName"]);
            $imdblink = 'https://www.imdb.com/title/' . $row["imdbID"] . '/';
            $trailer = 'https://www.youtube.com/results?search_query=' . $YTReady . '+trailer+' . $row["mYear"];

            echo '<div class="movie">
           <div class="title mobile">
                    <p>' . $row["MovieName"] . '</p>                    
                    </div>
                <div class="topContainer">
                
                    <div class="poster">
                    <img src="' . $row["PosterSrc"] . '" alt="">
                    </div>
                    <div class="words mobile">
                            <div class="extras">
                            <p><b>Genre: </b><br>' . $row["Genre"] . '</p>   
                            <p><b>Runtime: </b><br>' . $row["runtime"] . '</p> 
                            <p><b>Year: </b><br>' . $row["mYear"] . '</p>                    
                        </div>
                    </div>               
                
                </div>
                <div class="words">
                    <div class="title desk">
                    <p>' . $row["MovieName"] . '</p>                    
                    </div>
                    <div class="extras desk">
                    <p><b>Genre: </b><br>' . $row["Genre"] . '</p>   
                    <p><b>Runtime: </b><br>' . $row["runtime"] . '</p> 
                    <p><b>Year: </b><br>' . $row["mYear"] . '</p>                    

                    </div>
                    <div class="plot">
                    <p>' . $row['Plot'] . '</p> 
                    </div> 
                    <div class="movieButtons">   
                        
                <a href="' . $trailer . '" target="_blank"><i class="fas fa-video"></i> Trailer</a>
                <div class="delete mobile">
                    <a href="./removemovie.php?imdbID=' . $row['imdbID'] . '">&#10008; Remove</a>                             
                    </div> 
                <a href="' . $imdblink . '" target="_blank"><i class="fas fa-info-circle"></i> Info</a>      
                     
                </div>
                
                </div> 
                <div class="delete desk">
                <a href="./removemovie.php?imdbID=' . $row['imdbID'] . '">&#10008;</a>                             
                </div>               
                
            </div>';

        }
        echo '</div>';
    }

    public function display()
    {
        $this->displayMovies();
    }

}

?>
