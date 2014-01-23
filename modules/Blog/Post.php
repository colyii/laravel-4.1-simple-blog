<?php namespace Blog;

class Post extends \Eloquent {

    /**
     * 开启软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 文章的评论
     * @return object Blog\Comment
     */
    public function comments()
    {
        return $this->hasMany('Blog\Comment');
    }

    /**
     * 访问器：文章评论的数量
     * @return integer
     */
    public function getNumberOfCommentsAttribute()
    {
        return $this->comments()->count();
    }

    /**
     * 文章的作者
     * @return object Authority\User
     */
    public function user()
    {
        return $this->belongsTo('Blog\User');
    }

}