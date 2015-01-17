<?php

class SubmissionController extends \BaseController {

	/**
	 * Laravel's built in CRSF protection
	 */
	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => ['post', 'put', 'delete']));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//TODO: get all submission submitted by current user
		$submission = Submission::all();
		return View::make('submission.index')->with('submissions', $submission);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('submission.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// define rules
		$rules = array(
				'sub_title' => array('required')
			);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules);

		// test if input fails
		if ($validator->fails()) {
			return Redirect::route('submissions.create')->withErrors($validator)->withInput();
		}

		$name = Input::get('title');
		$submission = new Submission();
		$submission->name = $name;
		$submission->save();
		return Redirect::route('submissions.index')->withMessage('Thank you! Your Contribution has been Submitted');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		return View::make('submission.edit')->withSubmission($submission);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($sub_id)
	{
		// define rules
		$rules = array(
				'sub_title' => array('required')
			);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules);

		// test if input fails
		if ($validator->fails()) {
			return Redirect::route('submission.edit')->withErrors($validator)->withInput();
		}

		$sub_title = Input::get('sub_title');
		$submission = Submission::where('sub_id' , '=', $sub_id);
		$submission->sub_title = $name;
		$submission->update();
		return Redirect::route('submission.index')->withMessage('Thank you! Your Contribution has been Updated');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$submission = Submission::where('sub_id' , '=', $id)->delete();
		return Redirect::route('submission.index')->withMessage('Submission withdrawn!');
	}


	/**
	 * Show review results.
	 *
	 * @return Response
	 */
	public function reviews($id)
	{
		$sub = Submission::where('sub_id' , '=', $id)->get()->first();
		$reviews = $sub->reviews()->get();
		return View::make('submission.reviews')->withSubmission($sub)->withReviews($reviews);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		return View::make('submission.show')->withSubmission($submission);
	}


}
