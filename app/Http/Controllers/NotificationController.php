<?php

namespace App\Http\Controllers;

use App\Director;
use App\Notifications\MyNotification;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Notification;
use Kreait\Firebase;

use Kreait\Firebase\Factory;

use Kreait\Firebase\ServiceAccount;

use Kreait\Firebase\Database;

use Kutia\Larafirebase\Facades\Larafirebase;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directors = Director::all();
        return view('admin.director.index', compact('directors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        /*echo"<pre>";

        print_r($newPost->getvalue());exit; */
        // return $request;
        $request->validate([
            'title' => 'required',
        ]);
        /*if ($request->movie_id == "" && $request->tv_id == "" && $request->livetv == "") {

            $request->validate([
                'movie_id' => 'required',
                'tv_id' => 'required',
                'livetv' => 'required',
            ],
                [
                    'movie_id.required' => 'Please select at least one',
                    'tv_id.required' => 'Please select at least one tv series',
                    'livetv.required' => 'Please select at least one livetv',
                ]);
            return back()->with('deleted', 'Notification has not been Sent. Please select atleast one movie,tvserie and live tv.');
        } else {
*/
            $user = User::all();
            $input = $request->all();

            $title = $request->title;
            $desc = $request->description;
            if ($request->movie_id != "") {
                $movie_id = $request->movie_id;
            } else {
                $movie_id = $request->livetv;
            }
            $radio_id = $request->radio_id;
            $tvid = $request->tv_id;

            $alluser[] = $input['user_id'];

            if (in_array("0", $input['user_id'])) {
                foreach ($user as $key => $value) {
                    $alluser[] = $value->id;
                    //User::find($value->id)->notify(new MyNotification($title, $desc, $movie_id, $tvid, $alluser,$radio_id));
                    if(env('PUSH_AUTH_KEY') != NULL){
                        $deviceTokens = env('PUSH_AUTH_KEY');
                        if($deviceTokens != NULL){
                            return Larafirebase::withTitle($title)
                            ->withBody($desc)
                            // ->withImage('https://miro.medium.com/max/256/1*d69DKqFDwBZn_23mizMWcQ.png')
                            ->withClickAction('admin/notifications')
                            ->withPriority('high')
                            ->sendNotification(env('PUSH_AUTH_KEY'));
                        }

                    }
                    $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/alphatv-584b0-firebase-adminsdk-800v9-bf8c62c7c9.json');

                    $firebase         = (new Factory)->withServiceAccount($serviceAccount)->withDatabaseUri('https://alphatv-584b0-default-rtdb.firebaseio.com')->create();

                    $database       = $firebase->getDatabase();

                    $newPost          = $database->getReference('messages/'.$value->id.'/')->push(['title'=> $title,'desc'=> $desc, 'movie_id' => $movie_id, 'tvid' => $tvid,'radio_id'=>$radio_id,'read' => 0]);
                    
                }
                array_shift($alluser);
                $input['user_id'] = $alluser;

            } else {
                
                foreach ($input['user_id'] as $singleuser) {
                    //User::find($singleuser)->notify(new MyNotification($title, $desc, $movie_id, $tvid, $alluser,$radio_id));
                   
                    if(env('PUSH_AUTH_KEY') != NULL){
                        $deviceTokens = env('PUSH_AUTH_KEY');
                        if($deviceTokens != NULL){
                            return Larafirebase::withTitle($title)
                            ->withBody($desc)
                            // ->withImage('https://miro.medium.com/max/256/1*d69DKqFDwBZn_23mizMWcQ.png')
                            ->withClickAction('admin/notifications')
                            ->withPriority('high')
                            ->sendNotification(env('PUSH_AUTH_KEY'));
                        }

                    }
                    $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/alphatv-584b0-firebase-adminsdk-800v9-bf8c62c7c9.json');

                    $firebase         = (new Factory)->withServiceAccount($serviceAccount)->withDatabaseUri('https://alphatv-584b0-default-rtdb.firebaseio.com')->create();

                    $database       = $firebase->getDatabase();
                    
                    $newPost          = $database->getReference('messages/'.$singleuser.'/')->push(['title'=> $title,'desc'=> $desc, 'movie_id' => $movie_id, 'tvid' => $tvid,'radio_id'=>$radio_id,'read' => 0]);
                }
                $input['user_id'] = $alluser;
            }


            return back()->with('added', 'Notification has been Sent');
        /*}*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function sendNotification()
    {
        $user = User::first();

        $details = [
            'title' => 'title',
            'description' => 'description',

        ];

        Notification::send($user, new MyNotification($details));
        return back()->with('added', 'Notification is Sent');

    }

    public function notificationread($id)
    {

        $userunreadnotification = auth()->
            user()->unreadNotifications->
            where('id', $id)->first();

        if ($userunreadnotification) {
            $userunreadnotification->markAsRead();
        }

        return 'Done';

    }

     public function notificationreadAll(Request $request)
    {
        $id = $request->id;
        foreach ($id as $key => $value) {
            # code...
            $userunreadnotification = auth()->
                user()->unreadNotifications->
                where('id', $value)->first();

            if ($userunreadnotification) {
                $userunreadnotification->markAsRead();
            }
        }

        return 'Done';

    }

    public function FirebaseNofication($user_id,$title='',$desc="",$movie_id="",$tvid="",$radio_id="")
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/alphatv-584b0-firebase-adminsdk-800v9-bf8c62c7c9.json');

        $firebase         = (new Factory)->withServiceAccount($serviceAccount)->withDatabaseUri('https://alphatv-584b0-default-rtdb.firebaseio.com')->create();

        $database       = $firebase->getDatabase();

        $newPost          = $database->getReference('messages/'.$user_id.'/')->push(['title'=> $title,'desc'=> $desc, 'movie_id' => $movie_id, 'tvid' => $tvid,'radio_id'=>$radio_id,'read' => 0]);
    }

}
