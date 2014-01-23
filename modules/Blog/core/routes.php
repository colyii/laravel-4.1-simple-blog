<?php

// 注册视图别名
View::addNamespace('Blog', __DIR__.'/../views');
// 注册配置别名（模块不使用独立配置的可以注释掉）
// Config::package('_modules/Blog', __DIR__, 'Blog');

/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/
Route::group(array('prefix'=>'/'), function()
{
    $Blog = 'Blog\BlogController@';

    # 博客首页
    Route::get('/', array('as'=>'home', 'uses'=>$Blog.'getIndex'));
    # 展示博客文章
    Route::get('blog/{id}', array('as'=>'view-post', 'uses'=>$Blog.'getView'));
    # 提交文章评论
    Route::post('blog/{id}', $Blog.'postView');

    # 关于博客
    Route::get('about-us', array('as'=>'contact-us', 'uses'=>$Blog.'getAboutUs'));
    # 给我留言
    Route::get('contact-us', array('as'=>'contact-us', 'uses'=>$Blog.'getContactUs'));
    Route::post('contact-us', $Blog.'postContactUs');


});

Route::group(array('prefix'=>'admin', 'before'=>'auth|admin'), function()
{
    # 文章
    Route::resource('post', 'Blog\PostController');
    # 评论
    Route::resource('comment', 'Blog\CommentController');
    # 关于博客
    Route::resource('about-us', 'Blog\AboutUsController');
    # 用户留言
    Route::resource('contact-us', 'Blog\ContactUsController');
});
