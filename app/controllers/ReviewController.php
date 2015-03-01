<?php

class ReviewController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//get the conf_id in which the user is a reviewer
		$confs = DB::table('confuserrole')
		->select('conf_id')
		->where('user_id', '=', Auth::user()->user_id)
		->where('role_id', '=', 7)
		->get();

		//set just the conf ID into array, 
		$conf_ids = array();
		foreach ($confs as $conf) {
			array_push($conf_ids, $conf->conf_id);
		}

		$submission = DB::table('submissions')
            ->join('conference', 'submissions.conf_id', '=', 'conference.conf_id')
            ->select('conference.conf_id', 'conference.title', 'submissions.sub_type', 'submissions.sub_title', 'submissions.sub_id', 'submissions.created_at', 'submissions.updated_at', 'submissions.status')
            ->whereIn('submissions.conf_id', $conf_ids)
            // ->whereNotIn('submissions.status', array(1, 9))
            ->orderBy('submissions.updated_at', 'desc')->get();

        $reviews = DB::table('reviews')
        	->select('review_id', 'sub_id')
        	->where('user_id', '=', Auth::user()->user_id)
        	->get();

        //set just the conf ID into array, 
		$review_ids = array();
		foreach ($reviews as $rev) {
			$review_ids[$rev->review_id] = $rev->sub_id;
		}

            // var_dump($review_ids);

		return View::make('reviews.index')->with('submissions', $submission)->with('reviews', $review_ids);
		
	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function add($id)
	{
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		$conf = $submission->Conference()->first();
		$is_reviewer = DB::table('confuserrole')
						->select('role_id')
						->where('conf_id', '=', $conf->conf_id)
						->where('role_id', '=', 7)
						->where('user_id', '=', Auth::user()->user_id)
						->first();
		
		if ($is_reviewer != null) {
			//check if submissions status = on review
			if ($submission->status == 0 ) {
				$keywords = $submission->keywords()->get();
				$topics = DB::table('submission_topic')
				->leftJoin('conference_topic', 'submission_topic.topic_id', '=', 'conference_topic.topic_id')
				->select('submission_topic.topic_id', 'conference_topic.topic_name')->where('submission_topic.sub_id', '=', $id)->get();

				return View::make('reviews.create')->withSubmission($submission)
				->with('sub_topics', $topics)
				->withKeyword($keywords);
			} else {
				return Redirect::route('reviews.index')->withMessage('Sorry! You can no longer review this submission. The committe decision has been finalized!');
			}
		} else {
			return Redirect::route('reviews.index')->withMessage('You do not have the rights to review this submission!');
		}
		
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

		//update total score in submission table
		UtilsController::updateScore(Input::get('hidden_sub_id'));

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
		if ($review->user_id == Auth::user()->user_id) {
			//check if submissions status = on review
			if ($submission->status == 0 ) {
				$keywords = $submission->keywords()->get();
				$topics = DB::table('submission_topic')
				->leftJoin('conference_topic', 'submission_topic.topic_id', '=', 'conference_topic.topic_id')
				->select('submission_topic.topic_id', 'conference_topic.topic_name')->where('submission_topic.sub_id', '=', $sub_id)->get();


				return View::make('reviews.edit')->withSubmission($submission)
				->with('sub_topics', $topics)
				->with('review', $review)
				->withKeyword($keywords);
			} else {
				return Redirect::route('review.show', $id)->withMessage('Sorry! You can no longer edit this review. The committe decision has been finalized!');
			}
		} else {
			return Redirect::route('reviews.index')->withMessage('You do not have access to this page!');
		}
		
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

		//update total score in submission table
		UtilsController::updateScore(Input::get('hidden_sub_id'));

		return Redirect::route('reviews.index')->withMessage('Thank you! Your review for the contribution has been updated!');
	}

	/**
	*  Show all reviews of submissions passed in
	**/
	public function show($id)
	{
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();

		$conf = $submission->Conference()->first();
		$is_reviewer = DB::table('confuserrole')
						->select('role_id')
						->where('conf_id', '=', $conf->conf_id)
						->whereIn('role_id', array(7, 4))
						->where('user_id', '=', Auth::user()->user_id)
						->first();
		if ($is_reviewer != null) {
			$keywords = $submission->keywords()->get();
			$authors = $submission->authors()->get();
			// $reviews = $submission->reviews()->get();
			$reviews = DB::table('reviews')->join('users', 'reviews.user_id', '=', 'users.user_id')
						->select('users.firstname', 'users.lastname', 'reviews.comment', 'reviews.internal_comment', 'reviews.quality_score', 'reviews.significance_score', 'reviews.presentation_score', 'reviews.relevance_score', 'reviews.originality_score')->get();
			$sub_topics = DB::table('submission_topic')
			->leftJoin('conference_topic', 'submission_topic.topic_id', '=', 'conference_topic.topic_id')
			->select('submission_topic.topic_id', 'conference_topic.topic_name')->where('submission_topic.sub_id', '=', $id)->get();

			return View::make('reviews.reviews')->withSubmission($submission)
			->with('sub_authors', $authors)
			->with('sub_topics', $sub_topics)
			->withReviews($reviews)
			->withKeyword($keywords);
		} else {
			return Redirect::route('reviews.index')->withMessage('You do not have access to this page!');
		}				
		
	}

	// Function to save reviewer's preferred topics
	// public function topics() 
	// {
	// 	//TODO: get all preferred topics of current users based on current conference ID
	// 	$conf_topics = ConferenceTopic::all();
	// 	$topics = DB::table('user_preferred_topic')
 //            ->select('user_preferred_topic.topic_ids')
 //            ->where('user_preferred_topic.user_id' , '=', Auth::user()->user_id)
 //            ->get();           

 //        //set just the topic ID of selected topic into array, for checking purpose
 //        $selected_topic = array();
 //        if (!empty($topics)) {
 //        	$selected_topic = explode(",", $topics[0]->topic_ids);	
 //        }
				
	// 	return View::make('reviews.topics')
	// 	->with('selection', $selected_topic)
	// 	->with('topics', $conf_topics);
	// }

	// public function save_topics() 
	// {
	// 	// define rules
	// 	$rules = array('sub_topics' => 'required');
	// 	$messages = array('sub_topics.required' => 'Please select the <strong>topics</strong> that you prefer to review!');

	// 	// pass input to validator
	// 	$validator = Validator::make(Input::all(), $rules, $messages);

	// 	// test if input fails
	// 	if ($validator->fails()) {
	// 		return Redirect::route('review.topics')->withErrors($validator)->withInput();
	// 	}

	// 	$sub_topics = Input::get('sub_topics');
	// 	$new_data = implode(",", $sub_topics);
		
	// 	$user = DB::table('user_preferred_topic')->select('topic_ids')->where('user_id', Auth::user()->user_id)->get();
		
	// 	if (!empty($result)) {
	// 		//row exists, update
	// 		DB::table('user_preferred_topic')
 //            ->where('user_id', Auth::user()->user_id)
 //            ->update(array('topic_ids' => $new_data));
	// 	} else {
	// 		DB::table('user_preferred_topic')
	// 		->insert(array('topic_ids' => $new_data, 'user_id' => Auth::user()->user_id));
	// 	}
		
	// 	return Redirect::route('review.topics')->with('message', 'Preference Updated!');
	// }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){}
	public function create(){return View::make('reviews.create');}
	
}
