<?php
class Comment{
    public $text;
    public $date;
    public $rating;
    public $header;

    public static function Comment($text, $date, $rating, $header){
        $instance = new self();
        $instance->text = $text;
        $instance->date = $date;
        $instance->rating = $rating;
        $instance->header = $header;
        return $instance;
    }
}

class CommentController{
    function getComments(){
        return array(Comment::Comment("Random comment text.", date("Y-m-d H:i:s"), 7, "Comment header."));
    }
    function getCommentsByMovieID($id){
        return;
    }
}

$_commentController = new CommentController();
