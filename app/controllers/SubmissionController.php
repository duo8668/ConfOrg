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
		//get all submission by current logged-in user
		$submission = DB::table('conference')
            ->join('submissions', 'submissions.conf_id', '=', 'conference.conf_id')
            ->select('conference.conf_id', 'conference.title', 'submissions.sub_type', 'submissions.sub_title', 'submissions.sub_id', 'submissions.created_at')
            ->where('submissions.user_id' , '=', Auth::user()->user_id)
            ->orderBy('submissions.created_at', 'desc')->distinct()->get();
		return View::make('submission.index')->with('submissions', $submission);
		
		// return var_dump($submission);
	}

	/**
	 * Display the specified submission.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) 
	{
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		$keywords = $submission->keywords()->get();
		$authors = $submission->authors()->get();
		$sub_topics = DB::table('submission_topic')
		->leftJoin('conference_topic', 'submission_topic.topic_id', '=', 'conference_topic.topic_id')
		->select('submission_topic.topic_id', 'conference_topic.topic_name')->where('submission_topic.sub_id', '=', $id)->get();

		return View::make('submission.show')->withSubmission($submission)
		->with('sub_authors', $authors)
		->with('sub_topics', $sub_topics)
		->withKeyword($keywords);
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
				'attachment_path' => 'required|mimes:pdf',
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
    		'attachment_path' => 'Please upload the anonymous version of your contribution file (PDF only)',
    		'sub_keywords.required' => 'Please input the <strong>keywords</strong> of your contribution'
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
				'sub_remarks' => Input::get('sub_remarks'),
				'attachment_path' => $destinationPath . '/' . $fileName,
				'user_id' => Auth::user()->user_id
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
			$sub_topics = Input::get('sub_topics');
			foreach ($sub_topics as $sub_topic) {
				$topic = new Submission_Topic();
				$topic->topic_id = (int)$sub_topic;
				$submission->topics()->save($topic);
			}
			
			// inputting authors
			$fname = Input::get('author_fname');
			$lname = Input::get('author_lname');
			$org = Input::get('author_org');
			$email = Input::get('author_email');
			$ispresenting = Input::get('author_ispresenting');

			for ($i = 0; $i < count($fname); $i++) {
				$author = new Submission_Author();
				$author->first_name = $fname[$i];
				$author->last_name = $lname[$i];
				$author->organization = $org[$i];
				$author->email = $email[$i];
				if (!empty($ispresenting[$i])) {
					$author->is_presenting = $ispresenting[$i];
				} else {
					$author->is_presenting = '0';
				}
				
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
		$keywords = $submission->keywords()->get();

		//TODO: get topics of current conference
		$conf_topics = ConferenceTopic::all();
		$topics = DB::table('submission_topic')
		->leftJoin('conference_topic', 'submission_topic.topic_id', '=', 'conference_topic.topic_id')
		->select('submission_topic.topic_id')->where('submission_topic.sub_id', '=', $id)->get();

		//set just the topic ID of selected topic into array, for checking purpose
		$selected_topic = array();
		foreach ($topics as $topic) {
			array_push($selected_topic, $topic->topic_id);
		}

		return View::make('submission.edit')->withSubmission($submission)
		->with('sub_topics', $selected_topic)
		->with('conf_topics', $conf_topics)
		->withKeyword($keywords);
	}

	public function edit_authors($id)
	{
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		$authors = $submission->authors()->get();

		return View::make('submission.edit_authors')->withSubmission($submission)
		->with('authors', $authors);
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
				'sub_type' => 'required',
				'sub_title' => 'required|unique:submissions,sub_title,10',
				'sub_abstract' => 'required',
				'sub_topics' => 'required'
			);

		$messages = array(
    		'sub_title.required' => 'Please input the <strong>title</strong> of your contribution',
    		'sub_abstract.required' => 'Please input the <strong>abstract</strong> of your contribution',
    		'sub_topics.required' => 'Please select the <strong>topics</strong> of your contribution'
		);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules, $messages);

		// test if input fails
		if ($validator->fails()) {
			return Redirect::route('submission.edit', $sub_id)->withErrors($validator)->withInput();
		}

		//updating submission object
		$submission = Submission::where('sub_id' , '=', $sub_id)->get()->first();
		$submission->sub_type = Input::get('sub_type');
		$submission->sub_title = Input::get('sub_title');
		$submission->sub_abstract = Input::get('sub_abstract');
		$submission->sub_remarks = Input::get('sub_remarks');
		$submission->save();

		// updating keywords
		//delete existing keywords
		$submission->keywords()->delete();
		//add new keywords
		$keywords  = Input::get('sub_keywords');
		$keyword_array = explode(",", $keywords);
		foreach ($keyword_array as $keyword) {
			$sub_kw = new Keyword();
			$sub_kw->keyword_name = $keyword;
			$submission->keywords()->save($sub_kw);
		}
	
		// updating topics
		// delete existing topics
		$submission->topics()->delete();
		//add new topics
		$sub_topics = Input::get('sub_topics');
		foreach ($sub_topics as $sub_topic) {
			$topic = new Submission_Topic();
			$topic->topic_id = (int)$sub_topic;
			$submission->topics()->save($topic);
		}

		//if a new file is uploaded
		if (Input::hasFile('attachment_path')) {

			$rules = array(
				'attachment_path' => 'required|mimes:pdf'
			);

			$messages = array(
	    		'attachment_path' => 'Please upload the anonymous version of your contribution file (PDF only)'
			);

			// pass input to validator
			$validator = Validator::make(Input::only('attachment_path'), $rules, $messages);

			// test if input fails
			if ($validator->fails()) {
				return Redirect::route('submission.edit', $sub_id)->withErrors($validator)->withInput();
			}

		    //upload new file
			$destinationPath = 'uploads'; // upload path
	      	$extension = Input::file('attachment_path')->getClientOriginalExtension(); // getting file extension
	      	$fileName = rand(111111,999999).'.'.$extension; // renaming file
	      	Input::file('attachment_path')->move($destinationPath, $fileName); // uploading file to given path

		    //delete old file
	      	File::delete($submission->attachment_path);

		    //update database
	      	$submission->attachment_path = $destinationPath . '/' . $fileName;
	      	$submission->save();
		}

		return Redirect::route('submission.show', $sub_id)->withMessage('Thank you! Your Contribution Information has been Updated');
	}

	public function update_authors($sub_id)
	{
		//Get submission object
		$submission = Submission::where('sub_id' , '=', $sub_id)->get()->first();

		// updating authors
		// delete existing authors
		$submission->authors()->delete();
		// add new authors
		// inputting authors
			$fname = Input::get('author_fname');
			$lname = Input::get('author_lname');
			$org = Input::get('author_org');
			$email = Input::get('author_email');
			$ispresenting = Input::get('author_ispresenting');

			// return var_dump($ispresenting);

			for ($i = 0; $i < count($fname); $i++) {
				$author = new Submission_Author();
				$author->first_name = $fname[$i];
				$author->last_name = $lname[$i];
				$author->organization = $org[$i];
				$author->email = $email[$i];
				if (!empty($ispresenting[$i])) {
					$author->is_presenting = $ispresenting[$i];
				} else {
					$author->is_presenting = '0';
				}
				
				$submission->authors()->save($author);
			}

		return Redirect::route('submission.show', $sub_id)->withMessage('Thank you! Your Contribution Authors Information has been Updated');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		$submission->topics()->delete();
		$submission->keywords()->delete();
		$submission->authors()->delete();
		File::delete($submission->attachment_path);
		$submission->delete();

		return Redirect::route('submission.index')->withMessage('Submission withdrawn!');
	}


	/**
	 * Show review results.
	 *
	 * @return Response
	 */
	public function reviews($id)
	{
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		$keywords = $submission->keywords()->get();
		$authors = $submission->authors()->get();
		$reviews = $submission->reviews()->get();
		$sub_topics = DB::table('submission_topic')
		->leftJoin('conference_topic', 'submission_topic.topic_id', '=', 'conference_topic.topic_id')
		->select('submission_topic.topic_id', 'conference_topic.topic_name')->where('submission_topic.sub_id', '=', $id)->get();

		return View::make('submission.reviews')->withSubmission($submission)
		->with('sub_authors', $authors)
		->with('sub_topics', $sub_topics)
		->withReviews($reviews)
		->withKeyword($keywords);
		
	}


}
