<?php

class ForumController extends \BaseController {

	/**
	 * Display a listing of forumreplies
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = ForumGroup::all();

		return View::make('forum.index', compact('groups'));
	}
	
	public function category($url_name)
	{
		
		$category = ForumCategory::where('url_name', '=', $url_name)->first();
		$topics = ForumTopic::where('forum_category_id', '=', $category->id)->orderBy('updated_at', 'desc')->paginate(15);
		
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$last_reads = ForumLastRead::where("user_id", "=", $user->id)->get();
		} else {
			$last_reads = array();
		}
		
		return View::make('forum.category', compact('category', 'topics','last_reads'));
	}

	
	public function topic($category_url_name, $url_name)
	{
		$url_name = urlencode($url_name);
		$category = ForumCategory::where('url_name', '=', $category_url_name)->first();
		$topic = ForumTopic::where('url_name', '=', $url_name)->first();
		$replies = ForumReply::where('forum_topic_id', '=', $topic->id)->paginate(15);
		
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$marker = ForumLastRead::where("user_id", "=", $user->id)->where("forum_topic_id", "=", $topic->id)->first();
			if($marker) {
				$marker->last_read = date("Y-m-d H:i:s");
				$marker->save();
			} else {
				$new_marker = new ForumLastRead;
				$new_marker->user_id = $user->id;
				$new_marker->forum_topic_id = $topic->id;
				$new_marker->last_read = date("Y-m-d H:i:s");
				$new_marker->save();
			}
		}
		
		
		return View::make('forum.topic', compact('category', 'topic', 'replies'));
	}
	
	
	public function reply($category_url_name, $url_name)
	{
		$url_name = urlencode($url_name);
		$category = ForumCategory::where('url_name', '=', $category_url_name)->first();
		$topic = ForumTopic::where('url_name', '=', $url_name)->first();
		
		return View::make('forum.reply', compact('category', 'topic'));
	}
	
	public function create_topic($category_url_name)
	{
		$category = ForumCategory::where('url_name', '=', $category_url_name)->first();
		
		return View::make('forum.create_topic', compact('category'));
	}
	
	public function save_reply()
	{
		if(Auth::check()) {
			$input = Input::all();
			$validation = Validator::make($input, ForumReply::$rules);

			if ($validation->passes())
			{
				$topic = ForumTopic::where('id', '=', Input::get('topic_id'))->first();
				$topic->updated_at = date('Y-m-d H:i:s');
				$topic->category->updated_at = date('Y-m-d H:i:s');
				$topic->category->save();
				$topic->save();
				
				$content = Input::get('content');
				$reply = new ForumReply;
				$reply->content = $content;
				$reply->forum_topic_id = $topic->id;
				$reply->user_id = Auth::user()->id;
				$reply->save();
				
				return Redirect::to("/forum/".$topic->category->url_name."/".$topic->url_name."/")->with('success', trans("forum.post_created"));
				
			} else {
				return Redirect::to("/forum/".$category_url_name."/".$url_name."/reply")->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
			}
		} else {
			return Redirect::to("/login");
		}
		
	}
	
	public function save_topic()
	{
		if(Auth::check()) {
			$input = Input::all();
			$validation = Validator::make($input, ForumTopic::$rules);
			$category = ForumCategory::where('id', '=', Input::get('category_id'))->first();
			
			if ($validation->passes())
			{
				$content = Input::get('content');
				$title =  urlencode(strtolower(Input::get('title')));
				$topic = new ForumTopic;
				$topic->content = $content;
				$topic->topic = Input::get('title');
				$topic->forum_category_id = $category->id;
				$topic->user_id = Auth::user()->id;
				$topic->url_name = $title;
				$topic->save();
				
				$topic->category->updated_at = date('Y-m-d H:i:s');
				$topic->category->save();
				
				return Redirect::to("/forum/".$topic->category->url_name)->with('success', trans("forum.topic_created"));
				
			} else {
				return Redirect::to("/forum/".$category->url_name."/create_topic/new")->withInput()
				->withErrors($validation)
				->with('error', 'There were validation errors.');
			}
		} else {
			return Redirect::to("/login");
		}
		
	}
}