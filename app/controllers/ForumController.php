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
		//$topics = $category->topics();
		$topics = ForumTopic::where('forum_category_id', '=', $category->id)->get();
		
		return View::make('forum.category', compact('category', 'topics'));
	}

	
	public function topic($category_url_name, $url_name)
	{
		$category = ForumCategory::where('url_name', '=', $category_url_name)->first();
		$topic = ForumTopic::where('url_name', '=', $url_name)->first();
		$replies = ForumReply::where('forum_topic_id', '=', $topic->id)->get();
		
		return View::make('forum.topic', compact('category', 'topic', 'replies'));
	}
}