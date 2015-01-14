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
		return View::make('submission.addnew');
	}

	/**
	 * Show review results.
	 *
	 * @return Response
	 */
	public function results()
	{
		return View::make('submission.results');
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
				'title' => array('required')
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
		$submission = TodoList::findOrFail($id);
		return View::make('submissions.edit')->withAuthor($submission);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// define rules
		$rules = array(
				'title' => array('required')
			);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules);

		// test if input fails
		if ($validator->fails()) {
			return Redirect::route('submissions.create')->withErrors($validator)->withInput();
		}

		$name = Input::get('title');
		$submission = Submission::findOrFail($id);
		$submission->name = $name;
		$submission->update();
		return Redirect::route('submissions.index')->withMessage('Thank you! Your Contribution has been Updated');
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


}
