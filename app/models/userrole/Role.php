<?php

class Role extends Eloquent {

    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $fillable = array('rolename', 'remarks');
    protected $guarded = array('role_id');
    public $timestamps = false;

    public function scopeConferenceChair() {
        # code...
        return $this->where('rolename', '=', 'Conference Chair')->first();
    }

    public function scopeConferenceStaff() {
        # code...
        return $this->where('rolename', '=', 'Conference Staff')->first();
    }

    public function scopeReviewer() {
        # code...
        return $this->where('rolename', '=', 'Reviewer')->first();
    }

    public function scopeParticipant() {
        # code...
        return $this->where('rolename', '=', 'Participant')->first();
    }

    public function scopeAuthor() {
        # code...
        return $this->where('rolename', '=', 'Author')->first();
    }

    public function scopeReviewPanel() {
        # code...
        return $this->where('rolename', '=', 'Review Panel')->first();
    }

}
