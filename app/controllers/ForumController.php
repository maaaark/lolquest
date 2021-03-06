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
	
	public function category($category_id, $url_name)
	{
		
		$category = ForumCategory::where('id', '=', $category_id)->first();
		if(Auth::check() && Auth::user()->hasRole('admin')) {
			$topics = ForumTopic::where('forum_category_id', '=', $category->id)
				->orderBy('updated_at', 'desc')->paginate(15);
		} else {
			$topics = ForumTopic::where('forum_category_id', '=', $category->id)
				->where('deleted','=',"0")
				->orderBy('updated_at', 'desc')->paginate(15);
		}
		
		
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$last_reads = ForumLastRead::where("user_id", "=", $user->id)->get();
		} else {
			$last_reads = array();
		}
		//var_dump($last_reads);
		$last_reads_arr = [];
		foreach($last_reads as $read) {
		//var_dump($read->forum_topic_id);
			$last_reads_arr[$read->forum_topic_id] = $read->updated_at;
		}
		//var_dump($last_reads_arr);
		$last_reads = $last_reads_arr;
		
		return View::make('forum.category', compact('category', 'topics','last_reads'));
	}

	
	public function topic($category_id, $topic_id)
	{
		$category = ForumCategory::where('id', '=', $category_id)->first();
		$topic = ForumTopic::where('id', '=', $topic_id)->first();
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
	
	
	public function reply($category_id, $topic_id)
	{
		$category = ForumCategory::where('id', '=', $category_id)->first();
		$topic = ForumTopic::where('id', '=', $topic_id)->first();
		
		return View::make('forum.reply', compact('category', 'topic'));
	}
	
	public function create_topic($category_id)
	{
		$category = ForumCategory::where('id', '=', $category_id)->first();
		
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
				
				return Redirect::to("/forum/".$topic->category->id."/topic/".$topic->id)->with('success', trans("forum.post_created"));
				
			} else {
				return Redirect::to("/forum/reply/".$category_id."/".Input::get('topic_id'))->withInput()
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
				
				return Redirect::to("/forum/".$category->id."/".$topic->category->url_name)->with('success', trans("forum.topic_created"));
				
			} else {
				return Redirect::to("/forum/create_topic/".$category->id."/new")->withInput()
				->withErrors($validation)
				->with('error', 'There were validation errors.');
			}
		} else {
			return Redirect::to("/login");
		}
		
	}
	
	public function close_topic($topicID)
	{
		if(Auth::check()) {
			if(Auth::user()->hasRole('admin')) {
				//var_dump($topicID);
				DB::table('forum_topics')
					->where('id', $topicID)
					->update(array('status' => 1));
					
				return Redirect::to("/forum/")->with('message', 'Topic has been closed!');
			}
		}
		
	}
	
	public function open_topic($topicID)
	{
		if(Auth::check()) {
			if(Auth::user()->hasRole('admin')) {
				//var_dump($topicID);
				DB::table('forum_topics')
					->where('id', $topicID)
					->update(array('status' => 0));
					
				return Redirect::to("/forum/")->with('message', 'Topic has been re-opened!');
			}
		}
		
	}
	
	public function edit_reply($replayID, $userID)
	{
		if(Auth::check()) {
			$replies = ForumReply::where('id', '=', $replayID)->first();
			
			if(Auth::user()->id === $replies->user_id || Auth::user()->hasRole("admin")) {
				return View::make('forum.edit_reply', compact('replies'));
			} else {
                return Redirect::to("/403");
            }
		}
		
	}
	
	public function editsave_reply()
	{
		if(Auth::check()) {
			$input = Input::all();
			//var_dump($input);
			//die("qwe");
			$validation = Validator::make($input, ForumReply::$rules);

			if ($validation->passes())
			{
				$topic = ForumTopic::where('id', '=', Input::get('forum_topic_id'))->first();
				$content = Input::get('content');
				DB::table('forum_replies')
					->where('id', $input["reply_id"])
					->where('user_id', $input["user_id"])
					->update(array('content' => $content));
				
				return Redirect::to("/forum/".$topic->category->id."/".$topic->id."/".$topic->url_name."/")->with('success', trans("forum.post_created"));
				
			} else {
				return Redirect::to("/forum/".$category_id."/".$category_url_name."/".Input::get('topic_id')."/".$url_name."/reply")->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
			}
		} else {
			return Redirect::to("/login");
		}
		
	}
	
	public function delete_topic($topicID)
	{
		if(Auth::check()) {
			if(Auth::user()->hasRole('admin')) {
				//var_dump($topicID);
				DB::table('forum_topics')
					->where('id', $topicID)
					->update(array('deleted' => 1));
					
				return Redirect::to("/forum/")->with('message', 'Topic has been deleted!');
			}
		}
		
	}
	
	public function edit_topic($topicID, $userID)
	{
		$topic = ForumTopic::where('id', '=', $topicID)->first();
		$category = ForumCategory::where('id', '=', $topic->forum_category_id)->first();
		
		return View::make('forum.edit_topic', compact('category', 'topic'));
	}
	
	public function editsave_topic()
	{
		if(Auth::check()) {
				$input = Input::all();
				$topic = ForumTopic::where('id', '=', $input["topic_id"])->first();
				//var_dump($topic);die("qwe");
				DB::table('forum_topics')
					->where('id', $input["topic_id"])
					->update(array('topic' => $input["title"], 'content' => $input["content"]));
					
				return Redirect::to("/forum/".$topic->forum_category_id."/".$topic->id."/".$topic->url_name."/")->with('message', 'Topic has been updated!');
		}
		
	}
}