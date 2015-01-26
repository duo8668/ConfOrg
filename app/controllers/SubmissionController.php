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
				'attachment_path' => 'required',
				'sub_type' => 'required',
				'sub_title' => 'required|alpha_dash|unique:submissions,sub_title',
				'sub_abstract' => 'required|alpha_dash',
				'sub_topics' => 'required',
				'sub_keywords' => 'required'
			);

		$messages = array(
    		'sub_title.required' => 'Please input the <strong>title</strong> of your contribution',
    		'sub_abstract.required' => 'Please input the <strong>abstract</strong> of your contribution',
    		'sub_topics.required' => 'Please select the <strong>topics</strong> of your contribution',
    		'sub_keywords.required' => 'Please input the <strong>keywords</strong> of your contribution',
    		'attachment_path.required' => 'Please upload the anonymous version of your contribution file (PDF only)',
    		'sub_title.alpha_dash' => 'The <strong>title</strong> may only contain letters, numbers, and dashes.',
    		'sub_abstract.alpha_dash' => 'The <strong>abstract</strong> may only contain letters, numbers, and dashes.',
		);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules, $messages);

		// test if input fails
		if ($validator->fails()) {
			return Redirect::route('submission.create')->withErrors($validator)->withInput();
		}

		$submission = Submission::create(
			array('sub_type' => Input::get('sub_type'),
				'sub_title' => Input::get('sub_title'),
				'sub_abstract' => Input::get('sub_abstract'),
				));
		

		// inputting keywords
		$keywords  = Input::get('sub_keywords');
		$keyword_array = explode(",", $keywords);
		foreach ($keyword_array as $keyword) {
			$sub_kw = new Keyword();
			$sub_kw->keyword_name = $keyword;
			$submission->keywords()->save($sub_kw);
		}

		// inputting topics

		// inputting authors


		return Redirect::route('submission.index')->withMessage('Thank you! Your Contribution has been Submitted');
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
