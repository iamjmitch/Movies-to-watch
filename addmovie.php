<?php
require_once './inc/functions.inc.php';

if (!isset($_POST['submitSelect']))
{
    header("Location: index.php");
    exit;
}
else
{
    if (!isset($_POST['Title']) || !isset($_POST['imdbID']) || !isset($_POST['poster']))
    {
        header("Location: index.php?error=paramPassError");
        exit;
    }
    else
    {
        $title = $_POST['Title'];
        $imdbID = $_POST['imdbID'];
        $poster = $_POST['poster'];
        $i = new movieGetter;
        $i->processAdd($title, $imdbID, $poster);
        header("Location: index.php?message=Success");
        exit;
    }
}

?>
