<?php

class AdminDashboardController extends AdminController {

	protected $post,$comment,$user;

	public function __construct(Post $post,Comment $comment,User $user){
		parent::__construct();
        $this->post = $post;
        $this->comment = $comment;
        $this->user = $user;
	}
	/**
	 * Admin dashboard
	 *
	 */
	public function getIndex()
	{
		$posts = $this->post;
		$comments = $this->comment;
		$users = $this->user;
        return View::make('admin.dashboard',compact('posts','comments','users'));
	}

}