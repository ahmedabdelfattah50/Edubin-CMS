<?php

namespace App\Console\Commands;

use App\Mail\WriterAlertMail;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class WriterAutoMail extends Command
{
    protected $signature = 'writer:autoMail';


    protected $description = 'Writer Auto Mail';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        // ####### get all writers in the database
        $users = User::where('role' , 'writer')->get();

        foreach ($users as $user){
            $userPosts = Post::where('user_id', $user->id)->get();

            foreach ($userPosts as $userPost){
                if( $userPost == $userPosts->last() ){
                    $userLastPost = $userPosts->last();

                    $currentDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                    $postCreatedDate = Carbon::createFromFormat('Y-m-d', $userLastPost->created_at->format('Y-m-d'));
                    $diff_in_days = $currentDate->diffInDays($postCreatedDate);
                    $userEmail = $user->email;

//                    echo "<br>" . "user Id: " . $user->id . " last Post Id: " . $userLastPost->id . " >>>>> " . $diff_in_days;

                    // #### if the user last blog created since one week the task scheduler send him a notify email
                    if($diff_in_days > 7){
                        // #### send the email to the user

                          $user->update(['name' => $user->name . " - last post since " . $diff_in_days . " days"]);
//                        Mail::To($userEmail)->send(new WriterAlertMail($user));
                    }
                }
            }
        }
    }
}
