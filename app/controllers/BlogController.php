<?php

class BlogController extends BaseController {

    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Post $post, User $user)
    {
        parent::__construct();

        $this->post = $post;
        $this->user = $user;
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Get all the blog posts
		$posts = $this->post->orderBy('created_at', 'DESC')->paginate(10);

		// Get search post
		$posts1 = $this->post->orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('site/blog/index', compact('posts','posts1'));
	}

	/**
	 * View a blog post.
	 *
	 * @param  string  $slug
	 * @return View
	 * @throws NotFoundHttpException
	 */
	public function getView($slug)
	{
		$post = $this->post->where('slug', '=', $slug)->first();

		// Get search post
		$posts1 = $this->post->orderBy('created_at', 'DESC')->paginate(10);

		if (is_null($post))
		{
			return App::abort(404);
		}

		$comments = $post->comments()->orderBy('created_at', 'ASC')->get();

        $user = $this->user->currentUser();
        $canComment = false;
        if(!empty($user)) {
            $canComment = $user->can('post_comment');
        }

		return View::make('site/blog/view_post', compact('post', 'comments', 'canComment','posts1'));
	}

	/**
	 * View a blog post.
	 *
	 * @param  string  $slug
	 * @return Redirect
	 */
	public function postView($slug)
	{

        $user = $this->user->currentUser();
        $canComment = $user->can('post_comment');
		if ( ! $canComment)
		{
			return Redirect::to($slug . '#comments')->with('error', 'You need to be logged in to post comments!');
		}

		$post = $this->post->where('slug', '=', $slug)->first();

		$rules = array(
			'comment' => 'required|min:3'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes())
		{
			$comment = new Comment;
			$comment->user_id = Auth::user()->id;
			$comment->content = Input::get('comment');

			if($post->comments()->save($comment))
			{
				return Redirect::to($slug . '#comments')->with('success', 'Your comment was added with success.');
			}

			return Redirect::to($slug . '#comments')->with('error', 'There was a problem adding your comment, please try again.');
		}

		return Redirect::to($slug)->withInput()->withErrors($validator);
	}

	/**
	 *  Search 
	 * 
	 */
	public function search(){
		if(isset($_POST["submitSearch"])){
        	$find = $_POST['searchBlog'];
			$getData = Post::all();
			$temp = array();
			if($find != ""){
		
			foreach ($getData as $data) {
				$pos = strpos($data['title'], $find);
				if ($pos !== false) {
					$temp[] = $data;
				}
			}	

			$posts1 = $this->post->orderBy('created_at', 'DESC')->paginate(10);
			return View::make('site/blog/index')->with([
						'posts'=>$temp,
						'posts1'=>$posts1]);
			} else if($find == "") { 
				$posts = $this->post->orderBy('created_at', 'DESC')->paginate(10);
				$posts1 = $this->post->orderBy('created_at', 'DESC')->paginate(10);
		    	return View::make('site/blog/index', compact('posts','posts1'));
			}
    	}
    }
}
