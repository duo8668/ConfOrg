<?php

class ReviewController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//TODO: Get all submissions based on preferred topic of current user
		$submission = Submission::all();
		return View::make('reviews.index')->withSubmission($submission);
	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function add($id)
	{
		$sub = Submission::where('sub_id' , '=', $id)->get()->first();
		return View::make('reviews.create')->withSubmission($sub);
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

		$submission = Submission::find(Input::get('hidden_sub_id'));

		$review = $submission->reviews()->save($review);

		return Redirect::route('reviews.index')->withMessage('Thank you! Your review for the contribution has been submitted!');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	
	public function create(){return View::make('reviews.create');}
}
