<?php

class AdminBlogsController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        $title = Lang::get('admin/blogs/title.blog_management');

        $posts = $this->post;

        return View::make('admin/blogs/index', compact('posts', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        $title = Lang::get('admin/blogs/title.create_a_new_blog');

        return View::make('admin/blogs/create_edit', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
        $destinationPath = '';
        $filename        = '';

        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes())
        {
            $user = Auth::user();

            $this->post->title            = Input::get('title');
            $this->post->slug             = Str::slug(Input::get('title'));
            if (Input::hasFile('img_path')) {
                $file = Input::file('img_path');
                $destinationPath = 'public/uploads/';
                $filename = str_random(6) . '_' .$file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath,$filename);
                Image::make(sprintf($destinationPath . '%s',$filename))->resize(260,180)->save();
            }
            $this->post->content          = Input::get('content');
            $this->post->meta_title       = Input::get('meta-title');
            $this->post->meta_description = Input::get('meta-description');
            $this->post->meta_keywords    = Input::get('meta-keywords');
            $this->post->user_id          = $user->id;
            $this->post->img_path         = $destinationPath . $filename;

            if($this->post->save())
            {
                return Redirect::to('admin/blogs/' . $this->post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
            }

            return Redirect::to('admin/blogs/create')->with('error', Lang::get('admin/blogs/messages.create.error'));
        }

        return Redirect::to('admin/blogs/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getShow($post)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getEdit($post)
	{
        $title = Lang::get('admin/blogs/title.blog_update');

        return View::make('admin/blogs/create_edit', compact('post', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $post
     * @return Response
     */
	public function postEdit($post)
	{
        $destinationPath = '';
        $filename        = '';
        
        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes())
        {
            $post->title            = Input::get('title');
            $post->slug             = Str::slug(Input::get('title'));
            if (Input::hasFile('img_path')) {
                $file = Input::file('img_path');
                $destinationPath = 'public/uploads/';
                $filename = str_random(6) . '_' .$file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath,$filename);
                Image::make(sprintf($destinationPath . '%s',$filename))->resize(260,180)->save();
            }
            $post->content          = Input::get('content');
            $post->meta_title       = Input::get('meta-title');
            $post->meta_description = Input::get('meta-description');
            $post->meta_keywords    = Input::get('meta-keywords');
            $post->img_path         = $destinationPath . $filename;

            if($post->save())
            {
                return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
            }

            return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
        }

        return Redirect::to('admin/blogs/' . $post->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($post)
    {
        $title = Lang::get('admin/blogs/title.blog_delete');

        return View::make('admin/blogs/delete', compact('post', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($post)
    {
        $rules = array(
            'id' => 'required|integer'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes())
        {
            $id = $post->id;
            $post->delete();

            $post = Post::find($id);
            if(empty($post))
            {
                return Redirect::to('admin/blogs')->with('success', Lang::get('admin/blogs/messages.delete.success'));
            }
        }

        return Redirect::to('admin/blogs')->with('error', Lang::get('admin/blogs/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}