<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Submittedform;

class SubmissionComments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'submission_comments';

    public function submitted()
    {
       $this->belongsTo(Submittedform::class);
    }

   
}
