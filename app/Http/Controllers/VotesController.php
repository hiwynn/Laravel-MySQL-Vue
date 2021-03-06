<?php

namespace App\Http\Controllers;

use Auth;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Loader\ProtectedPhpFileLoader;

class VotesController extends Controller
{
    protected $answer;

    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function users($id)
    {
        $user = user('api');
        if ($user->hasVotedFor($id)) {
            return response()->json(['voted' => true]);
        }
        return response()->json(['voted' => false]);
    }

    public function vote()
    {
        $answer = $this->answer->byId(request('answer'));
        $voted = user('api')->voteFor(request('answer'));
        if (count($voted['attached']) > 0) {
            $answer->increment('votes_count');
            return response()->json(['voted' => true]);
        }
        $answer->decrement('votes_count');
        return response()->json(['voted' => false]);
    }
}
