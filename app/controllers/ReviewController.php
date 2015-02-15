<?php

class ReviewController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//TODO: Get all submissions based on current user's preferred topic of current conference
		$submission = DB::table('conference')
            ->join('submissions', 'submissions.conf_id', '=', 'conference.conf_id')
            ->leftJoin('reviews', 'reviews.sub_id', '=', 'submissions.sub_id')
            ->select('conference.conf_id', 'conference.title', 'submissions.sub_type', 'submissions.sub_title', 'submissions.sub_id', 'submissions.created_at', 'reviews.review_id')
            ->orderBy('submissions.created_at', 'desc')->distinct()->get();
		return View::make('reviews.index')->with('submissions', $submission);

		// return var_dump($submission);
		
	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function add($id)
	{
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		$keywords = $submission->keywords()->get();
		$topics = DB::table('submission_topic')
		->leftJoin('conference_topic', 'submission_topic.topic_id', '=', 'conference_topic.topic_id')
		->select('submission_topic.topic_id', 'conference_topic.topic_name')->where('submission_topic.sub_id', '=', $id)->get();

		return View::make('reviews.create')->withSubmission($submission)
		->with('sub_topics', $topics)
		->withKeyword($keywords);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
				'quality_score' => 'required|between:0,10',
				'originality_score' => 'required|between:0,10',
				'relevance_score' => 'required|between:0,10',
				'significance_score' => 'required|between:0,10',
				'presentation_score' => 'required|between:0,10',
				'comment' => 'required'
			);

		$messages = array(
    		'between' => 'The assigned score must be between :min to :max.',
    		'comment.required' => 'Please input your <strong>comment</strong> about the current contribution.',
		);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules, $messages);

		// test if input fails
		if ($validator->fails()) {
			return Redirect::route('reviews.add', [Input::get('hidden_sub_id')])->withErrors($validator)->withInput();
		}

		$review = new Review();
		$review->originality_score = Input::get('originality_score');
		$review->quality_score = Input::get('quality_score');
		$review->relevance_score = Input::get('relevance_score');
		$review->significance_score = Input::get('significance_score');
		$review->presentation_score = Input::get('presentation_score');
		$review->comment = Input::get('comment');
		$review->internal_comment = Input::get('internal_comment');
		$review->user_id = Auth::user()->user_id;

		$submission = Submission::find(Input::get('hidden_sub_id'));

		$review = $submission->reviews()->save($review);

		return Redirect::route('reviews.index')->withMessage('Thank you! Your review for the contribution has been submitted!');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// edit user's own review to current submission
		$review = Review::where('review_id', '=', $id)->get()->first();

		$sub_id = $review->sub_id;
		// return var_dump($review->sub_id);
		$submission = Submission::where('sub_id' , '=', $sub_id)->get()->first();
		$keywords = $submission->keywords()->get();
		$topics = DB::table('submission_topic')
		->leftJoin('conference_topic', 'submission_topic.topic_id', '=', 'conference_topic.topic_id')
		->select('submission_topic.topic_id', 'conference_topic.topic_name')->where('submission_topic.sub_id', '=', $sub_id)->get();


		return View::make('reviews.edit')->withSubmission($submission)
		->with('sub_topics', $topics)
		->with('review', $review)
		->withKeyword($keywords);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
				'quality_score' => 'required|between:0,10',
				'originality_score' => 'required|between:0,10',
				'relevance_score' => 'required|between:0,10',
				'significance_score' => 'required|between:0,10',
				'presentation_score' => 'required|between:0,10',
				'comment' => 'required'
			);

		$messages = array(
    		'between' => 'The assigned score must be between :min to :max.',
    		'comment.required' => 'Please input your <strong>comment</strong> about the current contribution.',
		);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules, $messages);

		// test if input fails
		if ($validator->fails()) {
			return Redirect::route('reviews.edit', $id)->withErrors($validator)->withInput();
		}

		$review = Review::where('review_id', '=', $id)->get()->first();
		$review->originality_score = Input::get('originality_score');
		$review->quality_score = Input::get('quality_score');
		$review->relevance_score = Input::get('relevance_score');
		$review->significance_score = Input::get('significance_score');
		$review->presentation_score = Input::get('presentation_score');
		$review->comment = Input::get('comment');
		$review->internal_comment = Input::get('internal_comment');
		$review->user_id = Auth::user()->user_id;

		$submission = Submission::where('sub_id' , '=', Input::get('hidden_sub_id'))->get()->first();

		$review = $submission->reviews()->save($review);

		return Redirect::route('reviews.index')->withMessage('Thank you! Your review for the contribution has been updated!');
	}

	/**
	*  Show all reviews of submissions passed in
	**/
	public function show($id)
	{
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		$keywords = $submission->keywords()->get();
		$authors = $submission->authors()->get();
		$reviews = $submission->reviews()->get();
		$sub_topics = DB::table('submission_topic')
		->leftJoin('conference_topic', 'submission_topic.topic_id', '=', 'conference_topic.topic_id')
		->select('submission_topic.topic_id', 'conference_topic.topic_name')->where('submission_topic.sub_id', '=', $id)->get();

		return View::make('reviews.reviews')->withSubmission($submission)
		->with('sub_authors', $authors)
		->with('sub_topics', $sub_topics)
		->withReviews($reviews)
		->withKeyword($keywords);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){}
	public function create(){return View::make('reviews.create');}
	
}
