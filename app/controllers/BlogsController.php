<?php

class BlogsController extends \BaseController {

	/**
	 * Display a listing of blogs
	 *
	 * @return Response
	 */
	public function index()
	{
		$blogs = Blog::orderBy('created_at', 'desc')->get();
		
		return View::make('blogs.index', compact('blogs'));
	}

	/**
	 * Show the form for creating a new blog
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('blogs.create');
	}

	
	public function create_comment() {
		if(Auth::check()) {
			
			$comment = new Comment;
			$comment->comment = Input::get('comment');
			$comment->user_id = Auth::user()->id;
			$comment->blog_id = Input::get('blog_id');
			$comment->save();
			
			return Redirect::to("/blogs/".Input::get('blog_id'));
			
		} else {
			return Redirect::to("login");
		}
	}
	
	/**
	 * Store a newly created blog in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Blog::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Blog::create($data);

		return Redirect::route('blogs.index');
	}

	/**
	 * Display the specified blog.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$blog = Blog::findOrFail($id);
		$comments = Comment::where('blog_id', '=', $blog->id)->get();
		
		return View::make('blogs.show', compact('blog', 'comments'));
	}

	/**
	 * Show the form for editing the specified blog.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$blog = Blog::find($id);

		return View::make('blogs.edit', compact('blog'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$blog = Blog::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Blog::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$blog->update($data);

		return Redirect::route('blogs.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Blog::destroy($id);

		return Redirect::route('blogs.index');
	}

}