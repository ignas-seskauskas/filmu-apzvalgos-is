<?php
class Comment
{
    public $id;
    public $text;
    public $date;
    public $rating;
    public $header;
    public $fk_movie;
    public $fk_user;

    public static function Comment($text, $date, $rating, $header, $id, $fk_movie, $fk_user)
    {
        $instance = new self();
        $instance->id = $id;
        $instance->text = $text;
        $instance->date = $date;
        $instance->rating = $rating;
        $instance->header = $header;
        $instance->fk_movie = $fk_movie;
        $instance->fk_user = $fk_user;
        return $instance;
    }
}

class CommentController
{
    function getComments()
    {
        return array(Comment::Comment("Random comment text.", date("Y-m-d H:i:s"), 7, "Comment header.", 0, 1, 4));
    }
    function getCommentsByMovieID($id)
    {
        $dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);
        $sql = "SELECT * FROM `komentaras` WHERE `fk_Filmas`=$id";
        $result = mysqli_query($dbc, $sql);
        $comments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($comments, Comment::Comment($row['tekstas'], $row['data'], $row['reitingas'], $row['antraste'], $row['id'], $row['fk_Filmas'], $row['fk_user']));
        }
        return $comments;
    }
    function getCommentByID($id){
        $dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);
        $sql = "SELECT * FROM `komentaras` WHERE `id`=$id";
        $result = mysqli_query($dbc, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            return Comment::Comment($row['tekstas'], $row['data'], $row['reitingas'], $row['antraste'], $row['id'], $row['fk_Filmas'], $row['fk_user']);
        }
    }
}

$_commentController = new CommentController();
