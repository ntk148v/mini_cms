<?php

class AdminCommentsController extends AdminController
{

    /**
     * Comment Model
     * @var Comment
     */
    protected $comment;

    /**
     * Inject the models.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        parent::__construct();
        $this->comment = $comment;
    }

    /**
     * Show a list of all the comment posts.
     *
     * @return View
     */
    public function getIndex()
    {
        $title = Lang::get('admin/comments/title.comment_management');

        $comments = $this->comment;

        return View::make('admin/comments/index', compact('comments', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $comment
     * @return Response
     */
	public function getEdit($comment)
	{
        $title = Lang::get('admin/comments/title.comment_update');

        return View::make('admin/comments/edit', compact('comment', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $comment
     * @return Response
     */
	public function postEdit($comment)
	{
        $rules = array(
            'content' => 'required|min:3'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes())
        {
            $comment->content = Input::get('content');

            if($comment->save())
            {
                return Redirect::to('admin/comments/' . $comment->id . '/edit')->with('success', Lang::get('admin/comments/messages.update.success'));
            }

            return Redirect::to('admin/comments/' . $comment->id . '/edit')->with('error', Lang::get('admin/comments/messages.update.error'));
        }

        return Redirect::to('admin/comments/' . $comment->id . '/edit')->withInput()->withErrors($validator);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $comment
     * @return Response
     */
	public function getDelete($comment)
	{
        $title = Lang::get('admin/comments/title.comment_delete');
        return View::make('admin/comments/delete', compact('comment', 'title'));
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $comment
     * @return Response
     */
	public function postDelete($comment)
	{
        $rules = array(
            'id' => 'required|integer'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes())
        {
            $id = $comment->id;
            $comment->delete();
            $comment = Comment::find($id);
            if(empty($comment))
            {
                return Redirect::to('admin/comments')->with('success', Lang::get('admin/comments/messages.delete.success'));
            }
        }
        return Redirect::to('admin/comments')->with('error', Lang::get('admin/comments/messages.delete.error'));
	}

    /**
     * Show a list of all the comments formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $comments = Comment::leftjoin('posts', 'posts.id', '=', 'comments.post_id')
                        ->leftjoin('users', 'users.id', '=','comments.user_id' )
                        ->select(array('comments.id as id', 'posts.id as postid','users.id as userid', 'comments.content', 'posts.title as post_name', 'users.username as poster_name', 'comments.created_at'));

        return Datatables::of($comments)

        ->edit_column('content', '<a href="{{{ URL::to(\'admin/comments/\'. $id .\'/edit\') }}}" class="iframe cboxElement">{{{ Str::limit($content, 40, \'...\') }}}</a>')

        ->edit_column('post_name', '<a href="{{{ URL::to(\'admin/blogs/\'. $postid .\'/edit\') }}}" class="iframe cboxElement">{{{ Str::limit($post_name, 40, \'...\') }}}</a>')

        ->edit_column('poster_name', '<a href="{{{ URL::to(\'admin/users/\'. $userid .\'/edit\') }}}" class="iframe cboxElement">{{{ $poster_name }}}</a>')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/comments/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-default btn-xs">{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/comments/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')
        ->remove_column('postid')
        ->remove_column('userid')

        ->make();
    }

}
