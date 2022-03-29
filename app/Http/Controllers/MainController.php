<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class MainController extends Controller
{

    function start(){
        if(session()->has('LoggedUser')) {
            return redirect('/ousama/public/auth/home');
        }
        else return redirect('/ousama/public/auth/login');
    }
    function login(){
        return view('auth.login');
    }
    function register(){
        return view('auth.register');
    }
    function save(Request $request){
        $request->validate([
            'fullname'=>'required',
            'user'=>'required|unique:users',
            'pwd'=>'required|min:5|max:12',
        ]);

        //insert data into database
        $user = new User;
        $user->fullname = $request->fullname;
        $user->user = $request->user;
        $user->pwd = Hash::make($request->pwd);
        $save = $user->save();
        if($save) {
            return back()->with('success','New User has been successfully added to database');
        }
        else {
            return back()->with('fail','something went wrong, try again later');
        }
    }
    function check(Request $request)
    {
        // validate requests
        $request->validate([
            'user' => 'required',
            'pwd' => 'required|min:5|max:12'
        ]);

        $userInfo = User::where('user' , '=' , $request->user)->first();

        if(!$userInfo){
            return back()->with('fail' , 'we do not recognize your username');
        }
        else{
            //check password
            if(Hash::check($request->pwd, $userInfo->pwd)){
                $request->session()->put('LoggedUser', $userInfo->userid);
                return redirect('/ousama/public/auth/home');
            }
            else{
                return back()->with('fail' , 'incorrect password');
            }
        }
    }
    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/ousama/public/auth/login');
        }
    }

    function home(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.home' , $data);
    }

    public function years(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];

        return view('auth.years' , $data);
    }

    function sources(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.sources' , $data);
    }

    function locations(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.locations' , $data);
    }

    function works(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.works' , $data);
    }

    function types(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.types' , $data);
    }

    function event(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.events' , $data);
    }

    function analysis(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.analysis' , $data);
    }

    function extract(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.extracts' , $data);
    }

    function annales(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.annales' , $data);
    }

    function report(){
        $data = ['LoggedUserInfo'=>User::where('userid','=',session('LoggedUser'))->first()];
        return view('auth.report' , $data);
    }

    function getLocation() {
        $id = $_POST['loc'];
        $location = DB::table('events')
            ->join('locations', 'events.locationid', '=', 'locations.locationid')
            ->join('eventtypes', 'eventtypes.typeid','=', 'events.typeid' )
            ->where('locations.location','=',$id)
            ->select('events.eventid','locations.location','events.year', 'eventtypes.type_desc')
            ->orderBy('events.year', 'asc')
            ->get();
        return view('auth.locations')->with('location',$location);
    }

    function getYear() {
        $id = $_POST['year'];
        $year = DB::table('events')
            ->join('locations', 'events.locationid', '=', 'locations.locationid')
            ->join('eventtypes', 'eventtypes.typeid','=', 'events.typeid' )
            ->where('events.year','=',$id)
            ->select('events.eventid', 'eventtypes.type_desc', 'locations.location', 'events.year')
            ->get();
        return view('auth.years')->with('year',$year);
    }

    function getWork() {
        $id = $_POST['works'];
        $work = DB::table('events')
            ->join('locations', 'events.locationid', '=', 'locations.locationid')
            ->join('eventtypes', 'eventtypes.typeid','=', 'events.typeid' )
            ->join('onreports', 'onreports.eventid', '=', 'events.eventid')
            ->join('analyses', 'analyses.analysisid','=', 'onreports.analysisid')
            ->join('works', 'analyses.workid','=', 'works.workid')
            ->where('works.workid','=',$id)
            ->select('events.eventid', 'events.year','eventtypes.type_desc', 'locations.location')
            ->orderBy('events.year')
            ->distinct()
            ->get();
        $ana = DB::table('analyses')
            ->join('works', 'analyses.workid','=', 'works.workid')
            ->join('worktypes', 'worktypes.typeid','=','works.typeid')
            ->where('analyses.workid', '=', $id)
            ->select('analyses.info_work', 'analyses.comment','analyses.analysisid','works.title','worktypes.type_desc','analyses.info_work','analyses.comment')
            ->get();
        return view('auth.works')->with('work',$work)->with('ana', $ana);
    }

    function getType() {
        $id = $_POST['type'];
        $type = DB::table('events')
            ->join('locations', 'events.locationid', '=', 'locations.locationid')
            ->join('eventtypes', 'eventtypes.typeid','=', 'events.typeid' )
            ->where('eventtypes.type_desc','=',$id)
            ->select('events.eventid','events.year', 'locations.location', 'eventtypes.type_desc')
            ->orderBy('events.year', 'asc')
            ->get();

        return view('auth.types')->with('type',$type);
    }

    function getSource() {
        $id = $_POST['source'];
        $source = DB::table('events')
            ->join('locations', 'events.locationid', '=', 'locations.locationid')
            ->join('eventtypes', 'eventtypes.typeid','=', 'events.typeid' )
            ->join('onreports', 'onreports.eventid', '=', 'events.eventid')
            ->join('extracts', 'extracts.extractid', '=', 'onreports.extractid')
            ->join('sources', 'sources.sourceid', '=', 'extracts.sourceid')
            ->where('sources.source','=',$id)
            ->select('events.eventid','events.year','eventtypes.type_desc', 'locations.location')
            ->orderBy('events.year','asc')
            ->orderBy('eventtypes.type_desc','asc')
            ->get();
        $link = DB::table('events')
            ->join('onreports', 'onreports.eventid', '=', 'events.eventid')
            ->join('extracts', 'extracts.extractid', '=', 'onreports.extractid')
            ->join('sources', 'sources.sourceid', '=', 'extracts.sourceid')
            ->join('links', 'links.sourceid', '=', 'sources.sourceid')
            ->where('sources.source','=',$id)
            ->select('links.link', 'links.name', 'links.site')
            ->distinct()
            ->get();

        return view('auth.sources')->with('source',$source)->with('link',$link);
    }

    function getEvent()
    {
        $id = $_POST['event'];
        $event = explode('//-',$id);

        $analysis = DB::table('events')
            ->join('onreports', 'onreports.eventid', '=', 'events.eventid')
            ->join('analyses', 'analyses.analysisid','=', 'onreports.analysisid')
            ->join('works', 'analyses.workid','=', 'works.workid')
            ->join('worktypes', 'worktypes.typeid','=','works.typeid')
            ->join('authorof','authorof.workid', '=','works.workid')
            ->join('authors', 'authors.authorid','=','authorof.authorid')
            ->where('events.eventid','=',$event[0])
            ->select('analyses.analysisid','authors.author','works.date','works.title','analyses.info_work','works.info','analyses.comment', 'worktypes.type_desc' )
            ->distinct()
            ->get();

        $extracts = DB::table('events')
            ->join('onreports','onreports.eventid','=','events.eventid')
            ->join('extracts', 'extracts.extractid', '=', 'onreports.extractid')
            ->join('sources', 'sources.sourceid', '=', 'extracts.sourceid')
            ->where('events.eventid','=', $event[0])
            ->select('sources.source', 'extracts.extract', 'extracts.extractid','extracts.extract_info','sources.sourceid')
            ->orderBy('sources.source', 'asc')
            ->get();

        return view('auth.events')->with('analysis', $analysis)->with('event',$event)->with('extracts', $extracts);
    }

    function editAnalysis()
    {
        $id = $_POST['analysis'];
        $ana = explode('//-',$id);
        $works = DB::table('works')
            ->join('worktypes', 'worktypes.typeid','=','works.typeid')
            ->select('works.title','worktypes.type_desc')
            ->get();
        $intensity = DB::table('onreports')
            ->join('analyses', 'analyses.analysisid','=', 'onreports.analysisid')
            ->where('analyses.analysisid', '=', $ana[0])
            ->select('onreports.intensity','onreports.certainty_location')
            ->get();
        $event = DB::table('events')
            ->join('locations', 'events.locationid', '=', 'locations.locationid')
            ->join('eventtypes', 'eventtypes.typeid','=', 'events.typeid')
            ->where('events.eventid','=',$ana[5])
            ->select('events.eventid','events.year','eventtypes.type_desc','locations.location')
            ->get();
        $extracts = DB::table('events')
            ->join('onreports','onreports.eventid','=','events.eventid')
            ->join('extracts', 'extracts.extractid', '=', 'onreports.extractid')
            ->join('sources', 'sources.sourceid', '=', 'extracts.sourceid')
            ->where('events.eventid','=', $ana[5])
            ->select('sources.source', 'extracts.extract', 'extracts.extractid','extracts.extract_info','sources.sourceid')
            ->get();

        return view('auth.analysis')->with('ana', $ana)->with('works',$works)->with('intensity',$intensity)->with('event', $event)
            ->with('extracts',$extracts);
    }
    function editExtract()
    {
        $id = $_POST['extracts'];
        $extract = explode('//-',$id);
        $event = DB::table('events')
            ->join('locations', 'events.locationid', '=', 'locations.locationid')
            ->join('eventtypes', 'eventtypes.typeid','=', 'events.typeid')
            ->join('onreports','onreports.eventid','=','events.eventid')
            ->join('extracts', 'extracts.extractid', '=', 'onreports.extractid')
            ->where('extracts.extractid','=',$extract[0])
            ->select('events.eventid','events.year','eventtypes.type_desc','locations.location')
            ->orderBy('events.year', 'asc')
            ->orderBy('eventtypes.type_desc','asc')
            ->get();
        return view('auth.extracts')->with('extract', $extract)->with('event', $event);
    }

    function editAnnales()
    {
        $analysis = [];
        if(isset($_POST['source']))
        {
            $id = $_POST['source'];
            $source = explode('//-',$id);
        }
        if(isset($_POST['extra'])){
            $id2 = $_POST['extra'];
            $extra = explode('//-',$id2);
            $source = [$extra[1], $extra[2]];

            $analysis = DB::table('analyses')
                ->join('onreports','onreports.analysisid','=','analyses.analysisid')
                ->join('extracts', 'extracts.extractid', '=', 'onreports.extractid')
                ->join('sources', 'sources.sourceid', '=', 'extracts.sourceid')
                ->join('works', 'analyses.workid','=', 'works.workid')
                ->join('worktypes', 'worktypes.typeid','=','works.typeid')
                ->join('authorof','authorof.workid', '=','works.workid')
                ->join('authors', 'authors.authorid','=','authorof.authorid')
                ->where('extracts.extractid', '=', $extra[0])
                ->select('analyses.analysisid','authors.author','works.date','works.title','analyses.info_work','works.info','analyses.comment', 'worktypes.type_desc', 'onreports.eventid' )
                ->get();

        }
        $extracts = DB::table('extracts')
            ->join('sources','sources.sourceid', '=', 'extracts.sourceid')
            ->join('onreports','onreports.extractid','=','extracts.extractid')
            ->where('sources.source','=', $source[0])
            ->select('extracts.extract', 'extracts.extractid','extracts.extract_info','onreports.eventid')
            ->get();

        $link = DB::table('sources')
            ->join('links', 'links.sourceid', '=', 'sources.sourceid')
            ->where('sources.source','=',$source[0])
            ->select('links.link', 'links.name', 'links.site')
            ->distinct()
            ->get();

        return view('auth.annales')->with('source',$source)->with('extracts', $extracts)->with('analysis', $analysis)->with('link',$link);
    }

    function editReport()
    {
        $id = null;
        if(isset($_POST['report1'])) {
            $id = $_POST['report1'];
        }
        if(isset($_POST['report2'])){
            $id = $_POST['report2'];
        }
        $report = explode('//-',$id);

        if($report[1]==0)
        {
            $report[1] = 'No particular Extract';
        }

        $extracts = DB::table('sources')
            ->join('extracts','sources.sourceid', '=', 'extracts.sourceid')
            ->where('sources.source','=', $report[0])
            ->select('extracts.extract')
            ->orderBy('extracts.extract','asc')
            ->get();
        $event = DB::table('events')
            ->join('locations', 'events.locationid', '=', 'locations.locationid')
            ->join('eventtypes', 'eventtypes.typeid','=', 'events.typeid')
            ->where('events.eventid','=',$report[2])
            ->select('events.eventid','events.year','eventtypes.type_desc','locations.location')
            ->first();

        $info = DB::table('onreports')
            ->where('onreports.extractid','=',$report[3])
            ->select('onreports.intensity','onreports.certainty_location', 'onreports.certainty_date',
                'onreports.original_date', 'onreports.computeid')
            ->first();

        if($info->computeid == null)
            $computeid = 1;
        else $computeid = $info->computeid;


        $comp = DB::table('yearcomputation')
            ->where('yearcomputation.computeid','=',$computeid)
            ->select('yearcomputation.method')
            ->first();

        return view('auth.report')->with('report',$report)->with('extracts',$extracts)->with('event', $event)->with('info',$info)->with('comp',$comp);
    }
}


















