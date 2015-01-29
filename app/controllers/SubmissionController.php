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
	 * Display the specified submission.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		$keywords = $submission->keywords()->get();
		$authors = $submission->authors()->get();
		return View::make('submission.show')->withSubmission($submission)->with('sub_authors', $authors)->withKeyword($keywords);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//TODO: get topics of current conference
		$topics = ConferenceTopic::all();
		return View::make('submission.create')->with('topics', $topics);
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
				'attachment_path' => 'required|mime:pdf',
				'sub_type' => 'required',
				'sub_title' => 'required|unique:submissions,sub_title',
				'sub_abstract' => 'required',
				'sub_topics' => 'required',
				'sub_keywords' => 'required'
			);

		$messages = array(
    		'sub_title.required' => 'Please input the <strong>title</strong> of your contribution',
    		'sub_abstract.required' => 'Please input the <strong>abstract</strong> of your contribution',
    		'sub_topics.required' => 'Please select the <strong>topics</strong> of your contribution',
    		'sub_keywords.required' => 'Please input the <strong>keywords</strong> of your contribution',
    		'attachment_path' => 'Please upload the anonymous version of your contribution file (PDF only)'
		);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules, $messages);

		// test if input fails
		if ($validator->fails()) {
			return Redirect::route('submission.create')->withErrors($validator)->withInput();
		}
		// TODO: Input submitting author id a.k.a USER ID
		if (Input::file('attachment_path')->isValid()) {
		
	      	$destinationPath = 'uploads'; // upload path
	      	$extension = Input::file('attachment_path')->getClientOriginalExtension(); // getting image extension
	      	$fileName = rand(111111,999999).'.'.$extension; // renaming image
	      	Input::file('attachment_path')->move($destinationPath, $fileName); // uploading file to given path
	     
	     	$submission = Submission::create(
			array('sub_type' => Input::get('sub_type'),
				'sub_title' => Input::get('sub_title'),
				'sub_abstract' => Input::get('sub_abstract'),
				'attachment_path' => $destinationPath . '/' . $fileName
				));
		

			// inputting keywords
			$keywords  = Input::get('sub_keywords');
			$keyword_array = explode(",", $keywords);
			foreach ($keyword_array as $keyword) {
				$sub_kw = new Keyword();
				$sub_kw->keyword_name = $keyword;
				$submission->keywords()->save($sub_kw);
			}

			// TODO: inputting topics
			
			// inputting authors
			$fname = Input::get('author_fname');
			$lname = Input::get('author_lname');
			$org = Input::get('author_org');
			$email = Input::get('author_email');
			$ispresenting = Input::get('author_ispresenting');

			for ($i = 0; $i < (count($fname) - 1); $i++) {
				$author = new Submission_Author();
				$author->first_name = $fname[$i];
				$author->last_name = $lname[$i];
				$author->organization = $org[$i];
				$author->email = $email[$i];
				$author->is_presenting = $ispresenting[$i];
				$submission->authors()->save($author);
			}

			return Redirect::route('submission.index')->withMessage('Thank you! Your Contribution has been Submitted');

		 } else {
		 	return Redirect::route('submission.create')->withErrors($validator)->withInput()->withMessage('Your file is invalid. Please upload in PDF format!');
		 }
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


}
