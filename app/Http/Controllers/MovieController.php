<?php
namespace App\Http\Controllers;

use App\Actor;
use App\AudioLanguage;
use App\Director;
use App\Genre;
use App\Menu;
use App\MenuVideo;
use App\Movie;
use App\MovieSeries;
use App\MultipleLinks;
use App\Subtitles;
use App\User;
use App\Videolink;
use App\WatchHistory;
use Auth;
use Avatar;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (Auth::user()->is_assistant == 1) {
            $movies = \DB::table('movies')->select('id', 'slug', 'title', 'thumbnail', 'poster', 'rating', 'tmdb', 'featured', 'status', 'created_by')
                ->where('live', 0)
                ->where('created_by', Auth::user()
                        ->id)
                    ->get();
        } else {
            $movies = \DB::table('movies')->select('id', 'slug', 'title', 'thumbnail', 'poster', 'rating', 'tmdb', 'featured', 'status', 'created_by')
                ->where('live', 0)
                ->get();
        }

        if ($request->ajax()) {
            return \Datatables::of($movies)->addIndexColumn()->addColumn('checkbox', function ($movies) {
                $html = '<div class="inline">
                <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $movies->id . '" id="checkbox' . $movies->id . '">
                <label for="checkbox' . $movies->id . '" class="material-checkbox"></label>
                </div>';

                return $html;
            })->addColumn('thumbnail', function ($movies) {
                if ($movies->thumbnail) {
                    $thumnail = '<img src="' . asset('/images/movies/thumbnails/' . $movies->thumbnail) . '" alt="Pic" width="70px" class="img-responsive">';
                } else if ($movies->poster) {
                    $thumnail = '<img src="' . asset('/images/movies/posters/' . $movies->poster) . '" alt="Pic" width="70px" class="img-responsive">';
                } else {
                    $thumnail = '<img  src=' . Avatar::create($movies->title)->toBase64() . ' alt="Pic" width="70px" class="img-responsive">';
                }

                return $thumnail;

            })->addColumn('rating', function ($movies) {

                return 'IMDB ' . $movies->rating;
            })->addColumn('featured', function ($movies) {
                if ($movies->featured == 1) {
                    $featured = 'Y';
                } else {
                    $featured = '-';
                }
                return $featured;
            })->addColumn('tmdb', function ($movies) {
                if ($movies->tmdb == 'Y') {
                    $tmdb = '<i class="material-icons done">done</i>';
                } else {
                    $tmdb = '-';
                }
                return $tmdb;
            })->addColumn('addedby', function ($movies) {
                $username = User::find($movies->created_by);

                if (isset($username)) {
                    return $username->name;
                } else {
                    return 'User deleted';
                }

            })->addColumn('status', function ($movies) {
                if (Auth::user()->is_assistant != 1) {
                    if ($movies->status == 1) {
                        return "<a href=" . route('quick.movie.status', $movies->id) . " class='btn btn-sm btn-success'>" . __('adminstaticwords.Active') . "</a>";
                    } else {
                        return "<a href=" . route('quick.movie.status', $movies->id) . " class='btn btn-sm btn-danger'>" . __('adminstaticwords.Deactive') ."</a>";
                    }
                } else {
                    if ($movies->status == 1) {
                        return "<a class='btn btn-sm btn-success'>".__('adminstaticwords.Active')."</a>";
                    } else {
                        return "<a class='btn btn-sm btn-danger'>".__('adminstaticwords.Deactive')."</a>";
                    }
                }
            })->addColumn('action', function ($movies) {
                if ($movies->status == 1) {
                    $btn = ' <div class="admin-table-action-block">
                      <a href="' . url('movie/detail', $movies->slug) . '" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>';
                } else {
                    $btn = ' <div class="admin-table-action-block">
                      <a style="cursor: not-allowed" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>';
                }
                $btn .= '<a href="' . route('movies.link', $movies->id) . '" data-toggle="tooltip" data-original-title="links"  class="btn-success btn-floating"><i class="material-icons">link</i></a>
                      <a href="' . route('movies.edit', $movies->id) . '" data-toggle="tooltip" data-original-title="' .__('adminstaticwords.Edit'). '" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $movies->id . '"><i class="material-icons">delete</i> </button></div>';

                $btn .= '<div id="deleteModal' . $movies->id . '" class="delete-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                      <!-- Modal content-->
                      <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                      </div>
                      <div class="modal-body text-center">
                      <h4 class="modal-heading">' .__('adminstaticwords.AreYouSure'). '</h4>
                      <p>' .__('adminstaticwords.DeleteWarrning'). '</p>
                      </div>
                      <div class="modal-footer">
                      <form method="POST" action="' . route("movies.destroy", $movies->id) . '">
                      ' . method_field("DELETE") . '
                      ' . csrf_field() . '
                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">'.__('adminstaticwords.No').'</button>
                      <button type="submit" class="btn btn-danger">'.__('adminstaticwords.Yes').'</button>
                      </form>
                      </div>
                      </div>
                      </div>
                      </div>';

                return $btn;
            })->rawColumns(['checkbox', 'rating', 'thumbnail', 'tmdb', 'rating', 'addedby', 'status', 'action'])
                ->make(true);
        }

        return view('admin.movie.index', compact('movies'));
    }

    public function addedMovies(Request $request)
    {

        $movies = \DB::table('movies')->select('id', 'slug', 'title', 'thumbnail', 'poster', 'rating', 'tmdb', 'featured', 'status', 'created_by')
            ->where('live', 0)
            ->where('status', '=', 0)
            ->get();

        if ($request->ajax()) {
            return \Datatables::of($movies)->addIndexColumn()->addColumn('checkbox', function ($movies) {
                $html = '<div class="inline">
                <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $movies->id . '" id="checkbox' . $movies->id . '">
                <label for="checkbox' . $movies->id . '" class="material-checkbox"></label>
                </div>';

                return $html;
            })->addColumn('thumbnail', function ($movies) {
                if ($movies->thumbnail) {
                    $thumnail = '<img src="' . asset('/images/movies/thumbnails/' . $movies->thumbnail) . '" alt="Pic" width="70px" class="img-responsive">';
                } else if ($movies->poster) {
                    $thumnail = '<img src="' . asset('/images/movies/posters/' . $movies->poster) . '" alt="Pic" width="70px" class="img-responsive">';
                } else {
                    $thumnail = '<img  src=' . Avatar::create($movies->title)->toBase64() . ' alt="Pic" width="70px" class="img-responsive">';
                }

                return $thumnail;

            })->addColumn('rating', function ($movies) {

                return 'IMDB ' . $movies->rating;
            })->addColumn('featured', function ($movies) {
                if ($movies->featured == 1) {
                    $featured = 'Y';
                } else {
                    $featured = '-';
                }
                return $featured;
            })->addColumn('tmdb', function ($movies) {
                if ($movies->tmdb == 'Y') {
                    $tmdb = '<i class="material-icons done">done</i>';
                } else {
                    $tmdb = '-';
                }
                return $tmdb;
            })->addColumn('addedby', function ($movies) {
                $username = User::find($movies->created_by);

                if (isset($username)) {
                    return $username->name;
                } else {
                    return 'User deleted';
                }

            })->addColumn('status', function ($movies) {
                if ($movies->status == 1) {
                    return "<a href=" . route('quick.movie.status', $movies->id) . " class='btn btn-sm btn-success'>". __('adminstaticwords.Active') ."</a>";
                } else {
                    return "<a href=" . route('quick.movie.status', $movies->id) . " class='btn btn-sm btn-danger'>". __('adminstaticwords.Deactive') ."</a>";
                }
            })->addColumn('action', function ($movies) {
                if ($movies->status == 1) {
                    $btn = ' <div class="admin-table-action-block">
                        <a href="' . url('movie/detail', $movies->slug) . '" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>';
                } else {
                    $btn = ' <div class="admin-table-action-block">
                        <a style="cursor: not-allowed" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>';
                }
                $btn .= '<a href="' . route('movies.link', $movies->id) . '" data-toggle="tooltip" data-original-title="links" class="btn-success btn-floating"><i class="material-icons">link</i></a>
                        <a href="' . route('movies.edit', $movies->id) . '" data-toggle="tooltip" data-original-title="'.__('adminstaticwords.Edit').'" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $movies->id . '"><i class="material-icons">delete</i> </button></div>';

                $btn .= '<div id="deleteModal' . $movies->id . '" class="delete-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                      <!-- Modal content-->
                      <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                      </div>
                      <div class="modal-body text-center">
                      <h4 class="modal-heading">'.__('adminstaticwords.AreYouSure').'</h4>
                      <p>'.__('adminstaticwords.DeleteWarrning').'</p>
                      </div>
                      <div class="modal-footer">
                      <form method="POST" action="' . route("movies.destroy", $movies->id) . '">
                      ' . method_field("DELETE") . '
                      ' . csrf_field() . '
                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">'.__('adminstaticwords.No').'</button>
                      <button type="submit" class="btn btn-danger">'.__('adminstaticwords.Yes').'</button>
                      </form>
                      </div>
                      </div>
                      </div>
                      </div>';

                return $btn;
            })->rawColumns(['checkbox', 'rating', 'thumbnail', 'tmdb', 'rating', 'addedby', 'status', 'action'])
                ->make(true);
        }

        return view('admin.movie.addedindex', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();

        $director_ls = Director::pluck('name', 'id')->all();
        $actor_ls = Actor::pluck('name', 'id')->all();
        $genre_ls = Genre::pluck('name', 'id')->all();
        $a_lans = AudioLanguage::pluck('language', 'id')->all();

        $all_movies = Movie::all();
        $series_list = MovieSeries::all();
        $movie_list_exc_series = collect();
        $movie_list_with_only_series = collect();
        if (count($series_list) > 0) {
            foreach ($series_list as $item) {
                $series = Movie::where('id', $item->series_movie_id)
                    ->first();
                $movie_list_with_only_series->push($series);
            }
            $movie_list_exc_series = $all_movies->toBase()
                ->diff($movie_list_with_only_series->toBase());
            $movie_list_exc_series = $movie_list_exc_series->flatten()
                ->pluck('title', 'id');
            $movie_list_exc_series = json_decode($movie_list_exc_series, true);
        } else {
            $movie_list_exc_series = Movie::pluck('title', 'id')->all();
        }

        return view('admin.movie.create', compact('menus', 'director_ls', 'a_lans', 'director_ls', 'actor_ls', 'genre_ls', 'movie_list_exc_series'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        //return $request;
        ini_set('max_execution_time', 120);

        if (isset($request->movie_by_id)) {
            $request->validate(['title' => 'required']);
        } else {
            $request->validate(['title2' => 'required'], ['title2.required' => 'Movie ID is required !']);
        }

        $menus = null;

        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
        }

        $input = $request->except('a_language', 'subtitle_list', 'movie_id');

        if (isset($request['is_protect'])) {
            $request->validate([
                'password' => 'required',
            ]);

            $input['is_protect'] = 1;
        } else {
            $input['is_protect'] = 0;
        }

        if ($request->slug != null) {
            $input['slug'] = $request->slug;
        } else {
            $slug = str_slug($request['title'], '-');
            $input['slug'] = $slug;
        }

        $TMDB_API_KEY = env('TMDB_API_KEY');

        $a_lans = $request->input('a_language');

        if ($a_lans) {
            $a_lans = implode(',', $a_lans);
            $input['a_language'] = $a_lans;
        } else {
            $input['a_language'] = null;
        }

        if ($input['tmdb'] != 'Y') {
            $request->validate([
                'genre_id' => 'required',
            ]);
        }

        $input['created_by'] = Auth::user()->id;

        if (Auth::user()->is_assistant == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $input['status'] = $status;

        if (isset($request->subtitle)) {
            $subtitle = 1;
        } else {
            $subtitle = 0;
        }

        if (!isset($input['featured'])) {
            $input['featured'] = 0;
        }
        if (!isset($input['series'])) {
            $input['series'] = 0;
        }
        if (isset($request->series)) {
            $request->validate([
                'movie_id' => 'required',
            ],
                [
                    'movie_id.required' => 'Forget to select movie of series',
                ]);
        }

        if ($input['tmdb'] == 'Y') {

            if ($TMDB_API_KEY == null || $TMDB_API_KEY == '') {
                return back()->with('deleted', 'Please provide your TMDB api key or add movie by custom fields');
            }

            $title = urlencode($input['title']);

            if (isset($request->movie_by_id)) {
                $search_data = @file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=' . $TMDB_API_KEY . '&query=' . $title);

                if ($search_data) {
                    $data = json_decode($search_data, true);
                }

                $input['fetch_by'] = "title";

            } else {
                $title2 = urlencode($request->title2);
                $search_data = @file_get_contents('https://api.themoviedb.org/3/movie/' . $title2 . '?api_key=' . $TMDB_API_KEY);

                $x2 = json_decode($search_data, true);
                $data2 = [];
                $data2[] = ['results' => [$x2]];
                $data = $data2[0];

                $input['title'] = $data['results'][0]['title'];

                $input['fetch_by'] = "byID";
            }

            if (isset($data) && $data['results'] == null) {
                return back()->with('deleted', 'Movie does not found by tmdb servers !');
            }

            if (Session::has('changed_language')) {
                $fetch_movie = @file_get_contents('https://api.themoviedb.org/3/movie/' . $data['results'][0]['id'] . '?api_key=' . $TMDB_API_KEY . '&language=' . Session::get('changed_language'));
                $fetch_movie_for_genres = @file_get_contents('https://api.themoviedb.org/3/movie/' . $data['results'][0]['id'] . '?api_key=' . $TMDB_API_KEY);
            } else {
                $fetch_movie = @file_get_contents('https://api.themoviedb.org/3/movie/' . $data['results'][0]['id'] . '?api_key=' . $TMDB_API_KEY);
                $fetch_movie_for_genres = @file_get_contents('https://api.themoviedb.org/3/movie/' . $data['results'][0]['id'] . '?api_key=' . $TMDB_API_KEY);
            }

            if (!$fetch_movie && !$fetch_movie_for_genres) {
                return back()->with('deleted', 'Movie does not found by tmdb servers !');
            }

            $tmdb_movie = json_decode($fetch_movie, true);

            // Only for genres
            $tmdb_movie_for_genres = json_decode($fetch_movie_for_genres, true);

            if ($tmdb_movie != null) {
                $input['tmdb_id'] = $tmdb_movie['id'];
            } else {
                return back()->with('deleted', 'Movie does not found by tmdb servers !');
            }

            if (!isset($input['trailer_url']) && $tmdb_movie != null && $TMDB_API_KEY != null) {

                if ($this->get_http_response_code('https://api.themoviedb.org/3/movie/' . $input['tmdb_id'] . '/videos?api_key=' . $TMDB_API_KEY) != "200") {
                    $input['trailer_url'] = null;
                } else {
                    $tmdb_trailers = @file_get_contents('https://api.themoviedb.org/3/movie/' . $input['tmdb_id'] . '/videos?api_key=' . $TMDB_API_KEY);
                    if ($tmdb_trailers) {
                        $tmdb_trailers = json_decode($tmdb_trailers, true);
                        if (isset($tmdb_trailers) && count($tmdb_trailers['results']) > 0) {
                            $input['trailer_url'] = 'https://youtu.be/' . $tmdb_trailers['results'][0]['key'];
                        }
                    } else {
                        $input['trailer_url'] = null;
                    }
                }
            }

            $thumbnail = null;
            $poster = null;

            if ($file = $request->file('thumbnail')) {
                 $request->validate([
                    'thumbnail'=>'sometimes|image|mimes:jpg,jpeg,png'
                 ]);
                $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
                $file->move('images/movies/thumbnails', $thumbnail);

            } else {

                $url = $tmdb_movie['poster_path'];
                $contents = @file_get_contents('https://image.tmdb.org/t/p/w300/' . $url);
                $name = substr($url, strrpos($url, '/') + 1);
                $name = 'tmdb_' . $name;
                if ($contents) {
                    $tmdb_img = Storage::disk('imdb_poster_movie')->put($name, $contents);
                    if ($tmdb_img) {
                        $thumbnail = $name;
                    }
                }
            }

            if ($file = $request->file('poster')) {
                $request->validate([
                    'poster'=>'sometimes|image|mimes:jpg,jpeg,png'
                 ]);
                $poster = 'poster_' . time() . $file->getClientOriginalName();
                $file->move('images/movies/posters', $poster);
            } else {

                $url_2 = $tmdb_movie['backdrop_path'];
                $contents_2 = @file_get_contents('https://image.tmdb.org/t/p/w300/' . $url_2);
                $name_2 = substr($url_2, strrpos($url_2, '/') + 1);

                $name_2 = 'tmdb_' . $name_2;

                if ($contents_2) {
                    $tmdb_img_2 = Storage::disk('imdb_backdrop_movie')->put($name_2, $contents_2);
                    if ($tmdb_img_2) {
                        $poster = $name_2;

                    }
                }
            }

            // Get Directors and create theme
            $tmdb_directors_id = collect();
            $get_tmdb_director_data = @file_get_contents('https://api.themoviedb.org/3/movie/' . $tmdb_movie['id'] . '/credits?api_key=' . $TMDB_API_KEY);
            if ($get_tmdb_director_data) {
                $get_tmdb_director_data = json_decode($get_tmdb_director_data, true);

                $get_tmdb_director_data = (object) $get_tmdb_director_data;
                // return $get_tmdb_director_data->crew;
                foreach ($get_tmdb_director_data->crew as $key => $item_dir) {

                    // if ($key <= 4) {
                    if ($item_dir['department'] == 'Directing') {

                        // getting director biography
                        $director_bio = null;
                        $director_birth = null;
                        $director_dob = null;
                        // getting actor id
                        $get_tmdb_director_biography = @file_get_contents('https://api.themoviedb.org/3/person/' . $item_dir['id'] . '?api_key=' . $TMDB_API_KEY);

                        if (isset($get_tmdb_director_biography)) {
                            $get_tmdb_director_biography = json_decode($get_tmdb_director_biography, true);

                            $director_bio = $get_tmdb_director_biography['biography'];
                            $director_birth = $get_tmdb_director_biography['place_of_birth'];
                            $director_dob = $get_tmdb_director_biography['birthday'];

                        }
                        $check_list = Director::where('name', $item_dir['name'])->first();

                        if (!isset($check_list)) {

                            // Director Image
                            $director_image = null;
                            $dir_image_url = $item_dir['profile_path'];
                            $dir_contents = @file_get_contents('https://image.tmdb.org/t/p/w300/' . $dir_image_url);
                            $dir_img_name = substr($dir_image_url, strrpos($dir_image_url, '/') + 1);
                            $dir_img_name = 'tmdb_' . $dir_img_name;
                            if ($dir_contents) {
                                $dir_created_img = Storage::disk('director_image_path')->put($dir_img_name, $dir_contents);
                                if ($dir_created_img) {
                                    $director_image = $dir_img_name;
                                }
                            }

                            $tmdb_director = Director::create(['name' => $item_dir['name'], 'image' => $director_image, 'biography' => $director_bio, 'place_of_birth' => $director_birth, 'DOB' => $director_dob]);

                            if (isset($tmdb_director)) {
                                $tmdb_directors_id->push($tmdb_director->id);
                            }

                        } else {
                            $tmdb_directors_id->push($check_list->id);
                        }
                    }
                    // }

                }
            }

            $tmdb_directors_id = $tmdb_directors_id->flatten();

            // get actors and create theme
            $tmdb_actors_id = collect();
            $get_tmdb_actors_data = @file_get_contents('https://api.themoviedb.org/3/movie/' . $tmdb_movie['id'] . '/credits?api_key=' . $TMDB_API_KEY);
            if ($get_tmdb_actors_data) {
                $get_tmdb_actors_data = json_decode($get_tmdb_actors_data, true);
                $get_tmdb_actors_data = (object) $get_tmdb_actors_data;

                if (count([$get_tmdb_actors_data]) > 0) {
                    foreach ($get_tmdb_actors_data->cast as $key => $item_act) {
                        if ($key <= 4) {
                            $actor_bio = null;
                            $actor_birth = null;
                            $actor_dob = null;
                            // getting actor id
                            $get_tmdb_actors_biography = @file_get_contents('https://api.themoviedb.org/3/person/' . $item_act['id'] . '?api_key=' . $TMDB_API_KEY);
                            if (isset($get_tmdb_actors_biography)) {
                                $get_tmdb_actors_biography = json_decode($get_tmdb_actors_biography, true);

                                $actor_bio = $get_tmdb_actors_biography['biography'];
                                $actor_birth = $get_tmdb_actors_biography['place_of_birth'];
                                $actor_dob = $get_tmdb_actors_biography['birthday'];

                            }

                            $check_list = Actor::where('name', $item_act['name'])->first();
                            // return $item_act['id'];
                            // if actor is not present already in our database
                            if (!isset($check_list)) {
                                // Actor Image
                                $actor_image = null;
                                $act_image_url = $item_act['profile_path'];
                                $act_contents = @file_get_contents('https://image.tmdb.org/t/p/w300/' . $act_image_url);
                                $act_img_name = substr($act_image_url, strrpos($act_image_url, '/') + 1);
                                $act_img_name = 'tmdb_' . $act_img_name;
                                if ($act_contents) {
                                    $dir_created_img = Storage::disk('actor_image_path')->put($act_img_name, $act_contents);
                                    if ($dir_created_img) {
                                        $actor_image = $act_img_name;
                                    }
                                }

                                $tmdb_actor = Actor::create(['name' => $item_act['name'], 'image' => $actor_image, 'biography' => $actor_bio, 'place_of_birth' => $actor_birth, 'DOB' => $actor_dob]);

                                if (isset($tmdb_actor)) {
                                    $tmdb_actors_id->push($tmdb_actor->id);
                                }

                            } else {

                                $tmdb_actors_id->push($check_list->id);

                            }
                        }
                    }
                }
            }
            $tmdb_actors_id = $tmdb_actors_id->flatten();

            // get Genres and create theme
            $tmdb_genres_id = collect();

            if (isset($tmdb_movie_for_genres) && $tmdb_movie_for_genres != null) {
                foreach ($tmdb_movie_for_genres['genres'] as $tmdb_genre) {

                    $tmdb_genre1 = $tmdb_genre['name'];
                    $check_list = Genre::where('name', 'LIKE', "%$tmdb_genre1%")->first();

                    if (!isset($check_list)) {
                        $created_genre = Genre::create(['name' => ['en' => $tmdb_genre['name']], 'position' => (Genre::count() + 1)]);
                        $tmdb_genres_id->push($created_genre->id);
                    } else {
                        $tmdb_genres_id->push($check_list->id);
                    }
                }
            }
            $tmdb_genres_id = $tmdb_genres_id->flatten();

            if ($tmdb_movie['release_date'] != '') {
                $publish_year = substr($tmdb_movie['release_date'], 0, 4);
            } else {
                $publish_year = null;
            }

            $tmdb_directors_id = substr($tmdb_directors_id, 1, -1);
            $tmdb_actors_id = substr($tmdb_actors_id, 1, -1);
            $tmdb_genres_id = substr($tmdb_genres_id, 1, -1);

            $keyword = $request->keyword;
            $description = $request->description;
            try{
                $created_movie = Movie::create(['title' => $input['title'], 'keyword' => $keyword, 'description' => $description, 'tmdb_id' => $tmdb_movie['id'], 'duration' => $tmdb_movie['runtime'], 'tmdb' => $input['tmdb'], 'director_id' => $tmdb_directors_id, 'actor_id' => $tmdb_actors_id, 'genre_id' => $tmdb_genres_id, 'trailer_url' => $input['trailer_url'], 'subtitle' => $subtitle, 'featured' => $input['featured'], 'series' => $input['series'], 'detail' => $tmdb_movie['overview'], 'rating' => $tmdb_movie['vote_average'], 'publish_year' => $publish_year, 'released' => $tmdb_movie['release_date'], 'maturity_rating' => $input['maturity_rating'], 'a_language' => $input['a_language'], 'thumbnail' => $thumbnail, 'poster' => $poster, 'fetch_by' => $input['fetch_by'], 'created_by' => Auth::user()->id, 'status' => $status, 'is_protect' => $input['is_protect'], 'password' => $input['password'], 'slug' => $input['slug']]);

                // subtitle add
                if (isset($request->subtitle)) {

                    if ($request->has('sub_t')) {
                        foreach ($request->file('sub_t') as $key => $image) {

                            $name = $image->getClientOriginalName();
                            $image->move(public_path() . '/subtitles/', $name);

                            $form = new Subtitles();
                            $form->sub_lang = $request->sub_lang[$key];
                            $form->sub_t = $name;
                            $form->m_t_id = $created_movie->id;
                            $form->save();
                        }
                    }

                }

                if ($input['series'] == 1) {

                    MovieSeries::create(['movie_id' => $request->movie_id, 'series_movie_id' => $created_movie->id]);
                }

                if ($request->selecturl == "iframeurl") {

                    VideoLink::create(['movie_id' => $created_movie->id, 'type' => 'iframeurl', 'iframeurl' => $input['iframeurl'], 'ready_url' => null, 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null]);

                } else {

                    if ($request->selecturl == "youtubeurl" || $request->selecturl == "vimeourl" || $request->selecturl == "customurl" || $request->selecturl == "vimeoapi" || $request->selecturl == "youtubeapi") {

                        VideoLink::create(['movie_id' => $created_movie->id, 'type' => 'readyurl', 'ready_url' => $input['ready_url'], 'iframeurl' => null, 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null]);

                    } elseif ($request->selecturl == 'multiqcustom') {

                        if ($file = $request->file('upload_video_360')) {
                            $name = time() . $file->getClientOriginalName();
                            $file->move('movies_upload', $name);
                            $url_360 = asset('movies_upload/' . $name);
                        } else {
                            $url_360 = $request->url_360;
                        }

                        if ($file = $request->file('upload_video_480')) {
                            $name = time() . $file->getClientOriginalName();
                            $file->move('movies_upload', $name);
                            $url_480 = asset('movies_upload/' . $name);
                        } else {
                            $url_480 = $request->url_480;
                        }

                        if ($file = $request->file('upload_video_720')) {
                            $name = time() . $file->getClientOriginalName();
                            $file->move('movies_upload', $name);
                            $url_720 = asset('movies_upload/' . $name);
                        } else {
                            $url_720 = $request->url_720;
                        }

                        if ($file = $request->file('upload_video_1080')) {
                            $name = time() . $file->getClientOriginalName();
                            $file->move('movies_upload', $name);
                            $url_1080 = asset('movies_upload/' . $name);
                        } else {
                            $url_1080 = $request->url_1080;
                        }

                        VideoLink::create(['movie_id' => $created_movie->id, 'type' => 'multiquality', 'url_360' => $url_360, 'url_480' => $url_480, 'url_720' => $url_720, 'url_1080' => $url_1080, 'iframeurl' => null, 'ready_url' => null]);

                    }
                }

                if ($menus != null) {
                    if (count($menus) > 0) {
                        foreach ($menus as $key => $value) {
                            MenuVideo::create(['menu_id' => $value, 'movie_id' => $created_movie->id]);
                        }
                    }
                }

                return back()->with('added', 'Movie has been added');
            }catch(\Exception $e){
                return back()->with('deleted',$e->getMessage());
            }
            
        }

        $director_ids = $request->input('director_id');
        if ($director_ids) {
            $director_ids = implode(',', $director_ids);
            $input['director_id'] = $director_ids;
        } else {
            $input['director_id'] = null;
        }

        $actor_ids = $request->input('actor_id');
        if ($actor_ids) {
            $actor_ids = implode(',', $actor_ids);
            $input['actor_id'] = $actor_ids;
        } else {
            $input['actor_id'] = null;
        }

        $genre_ids = $request->input('genre_id');
        if ($genre_ids) {
            $genre_ids = implode(',', $genre_ids);
            $input['genre_id'] = $genre_ids;
        } else {
            $input['genre_id'] = null;
        }

        if ($file = $request->file('thumbnail')) {
            $request->validate([
                    'thumbnail'=>'sometimes|image|mimes:jpg,jpeg,png'
                 ]);
            $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
            $file->move('images/movies/thumbnails', $thumbnail);
            $input['thumbnail'] = $thumbnail;
        }

        if ($file = $request->file('poster')) {
            $request->validate([
                    'poster'=>'sometimes|image|mimes:jpg,jpeg,png'
                 ]);
            $poster = 'poster_' . time() . $file->getClientOriginalName();
            $file->move('images/movies/posters', $poster);
            $input['poster'] = $poster;
        }

        $input['ready_url'] = $request->ready_url;

        if (isset($request->subtitle)) {
            $input['subtitle'] = 1;
        } else {
            $input['subtitle'] = 0;
        }

        if (isset($request['is_protect'])) {
            $input['is_protect'] = 1;
            $request->validate([
                'password' => 'required',
            ]);
        } else {
            $input['is_protect'] = 0;
        }
        if ($request->slug != null) {
            $input['slug'] = $request->slug;
        } else {
            $slug = str_slug($request->title, '-');
            $input['slug'] = $slug;
        }

        try{
            $created_movie = Movie::create($input);

            // subtitle add
            if (isset($request->subtitle)) {

                if ($request->has('sub_t')) {
                    foreach ($request->file('sub_t') as $key => $image) {

                        $name = $image->getClientOriginalName();
                        $image->move(public_path() . '/subtitles/', $name);

                        $form = new Subtitles();
                        $form->sub_lang = $request->sub_lang[$key];
                        $form->sub_t = $name;
                        $form->m_t_id = $created_movie->id;
                        $form->save();
                    }
                }

            }

            if ($input['series'] == 1) {
                MovieSeries::create(['movie_id' => $request->movie_id, 'series_movie_id' => $created_movie->id]);
            }

            if ($request->selecturl == "iframeurl") {

                VideoLink::create(['movie_id' => $created_movie->id, 'type' => 'iframeurl', 'iframeurl' => $input['iframeurl'], 'ready_url' => null, 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null]);

            } else if ($request->selecturl == "youtubeurl" || $request->selecturl == "vimeourl" || $request->selecturl == "customurl" || $request->selecturl == "vimeoapi" || $request->selecturl == "youtubeapi") {

                VideoLink::create(['movie_id' => $created_movie->id, 'type' => 'readyurl', 'ready_url' => $input['ready_url'], 'iframeurl' => null, 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null]);

            } elseif ($request->selecturl == 'multiqcustom') {
                if ($file = $request->file('upload_video_360')) {
                    $name = time() . $file->getClientOriginalName();
                    $file->move('movies_upload', $name);
                    $url_360 = asset('movies_upload/' . $name);
                } else {
                    $url_360 = $request->url_360;
                }

                if ($file = $request->file('upload_video_480')) {
                    $name = time() . $file->getClientOriginalName();
                    $file->move('movies_upload', $name);
                    $url_480 = asset('movies_upload/' . $name);
                } else {
                    $url_480 = $request->url_480;
                }

                if ($file = $request->file('upload_video_720')) {
                    $name = time() . $file->getClientOriginalName();
                    $file->move('movies_upload', $name);
                    $url_720 = asset('movies_upload/' . $name);
                } else {
                    $url_720 = $request->url_720;
                }

                if ($file = $request->file('upload_video_1080')) {
                    $name = time() . $file->getClientOriginalName();
                    $file->move('movies_upload', $name);
                    $url_1080 = asset('movies_upload/' . $name);
                } else {
                    $url_1080 = $request->url_1080;
                }

                VideoLink::create(['movie_id' => $created_movie->id, 'type' => 'multiquality', 'url_360' => $url_360, 'url_480' => $url_480, 'url_720' => $url_720, 'url_1080' => $url_1080]);

            }

            // return $input;
            if ($menus != null) {
                if (count($menus) > 0) {
                    foreach ($menus as $key => $value) {
                        MenuVideo::create(['menu_id' => $value, 'movie_id' => $created_movie->id]);
                    }
                }
            }

            return back()->with('added', 'Movie has been added');
        }catch(\Exception $e){
            return back()->with('deleted',$e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $url
     * @return \Illuminate\Http\Response
     */
    public function get_http_response_code($url)
    {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menus = Menu::all();
        $director_ls = Director::all();
        $actor_ls = Actor::all();
        $genre_ls = Genre::all();
        $all_languages = AudioLanguage::all();
        $movie = Movie::findOrFail($id);

        $all_movies = Movie::all();
        $series_list = MovieSeries::all();
        $movie_list_exc_series = collect();
        $movie_list_with_only_series = collect();
        if (count($series_list) > 0) {
            foreach ($series_list as $item) {
                $series = Movie::where('id', $item->series_movie_id)
                    ->first();
                $movie_list_with_only_series->push($series);
            }

            $movie_list_exc_series = $all_movies->toBase()
                ->diff($movie_list_with_only_series->toBase());
            $movie_list_exc_series = $movie_list_exc_series->flatten()
                ->pluck('title', 'id');
            $movie_list_exc_series = json_decode($movie_list_exc_series, true);

        } else {
            $movie_list_exc_series = Movie::pluck('title', 'id')->all();
        }
        // get old audio language values
        $old_lans = collect();
        $a_lans = collect();
        if ($movie->a_language != null) {
            $old_list = explode(',', $movie->a_language);
            for ($i = 0; $i < count($old_list); $i++) {
                $old = AudioLanguage::find(trim($old_list[$i]));
                if (isset($old)) {
                    $old_lans->push($old);
                }
            }
        }
        $a_lans = $a_lans->filter(function ($value, $key) {
            return $value != null;
        });
        $a_lans = $all_languages->diff($old_lans);

        // get old subtitle language values
        $old_subtitles = collect();
        $a_subs = collect();
        if ($movie->subtitle == 1) {
            if ($movie->subtitle_list != null) {
                $old_list = explode(',', $movie->subtitle_list);
                for ($i = 0; $i < count($old_list); $i++) {
                    $old2 = AudioLanguage::find(trim($old_list[$i]));
                    if (isset($old2)) {
                        $old_subtitles->push($old2);
                    }
                }
            }
        }
        $a_subs = $a_subs->filter(function ($value, $key) {
            return $value != null;
        });
        $a_subs = $all_languages->diff($old_subtitles);

        // get old director list
        $old_director = collect();
        if ($movie->director_id != null) {
            $old_list = explode(',', $movie->director_id);
            for ($i = 0; $i < count($old_list); $i++) {
                $old3 = Director::find(trim($old_list[$i]));
                if (isset($old3)) {
                    $old_director->push($old3);
                }
            }
        }
        $director_ls = $director_ls->filter(function ($value, $key) {
            return $value != null;
        });
        $director_ls = $director_ls->diff($old_director);

        // get old actor list
        $old_actor = collect();
        if ($movie->actor_id != null) {
            $old_list = explode(',', $movie->actor_id);
            for ($i = 0; $i < count($old_list); $i++) {
                $old4 = Actor::find(trim($old_list[$i]));
                if (isset($old4)) {
                    $old_actor->push($old4);
                }
            }
        }
        $old_actor = $old_actor->filter(function ($value, $key) {
            return $value != null;
        });
        $actor_ls = $actor_ls->diff($old_actor);

        // get old genre list
        $old_genre = collect();
        if ($movie->genre_id != null) {
            $old_list = explode(',', $movie->genre_id);
            for ($i = 0; $i < count($old_list); $i++) {
                $old5 = Genre::find(trim($old_list[$i]));
                if (isset($old5)) {
                    $old_genre->push($old5);
                }
            }
        }
        $genre_ls = $genre_ls->filter(function ($value, $key) {
            return $value != null;
        });

        $genre_ls = $genre_ls->diff($old_genre);

        $this_movie_series = MovieSeries::where('series_movie_id', $id)->get();
        if (count($this_movie_series) > 0) {
            $this_movie_series_detail = Movie::where('id', $this_movie_series[0]->movie_id)
                ->get();
        }

        $video_link = Videolink::where('movie_id', $id)->first();

        return view('admin.movie.edit', compact('movie', 'director_ls', 'actor_ls', 'genre_ls', 'movie_list_exc_series', 'a_lans', 'old_lans', 'a_subs', 'video_link', 'old_subtitles', 'old_director', 'old_actor', 'old_genre', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
       if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        // ini_set('max_execution_time', 120);
        if (isset($request->series)) {
            $request->validate([
                'movie_id' => 'required',
            ],
                [
                    'movie_id.required' => 'Forget to select movie',
                ]);
        }
        $movie = Movie::findOrFail($id);

        if (isset($request->subtitle)) {
            $subtitle = 1; //for custom

            if ($request->has('sub_t')) {
                foreach ($request->file('sub_t') as $key => $image) {

                    $name = $image->getClientOriginalName();
                    $image->move(public_path() . '/subtitles/', $name);

                    $form = new Subtitles();
                    $form->sub_lang = $request->sub_lang[$key];
                    $form->sub_t = $name;
                    $form->m_t_id = $movie->id;
                    $form->save();
                }
            }
        } else {
            $subtitle = 0;

        }

        $menus = null;

        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
        }

        $input = $request->except('a_language', 'director_id', 'actor_id', 'genre_id', 'subtitle_list', 'movie_id');

        $TMDB_API_KEY = env('TMDB_API_KEY');

        $a_lans = $request->input('a_language');
        if ($a_lans) {
            $a_lans = implode(',', $a_lans);
            $input['a_language'] = $a_lans;
        } else {
            $input['a_language'] = null;
        }

        if ($input['tmdb'] != 'Y') {
            $request->validate(['genre_id' => 'required']);
        }

        if (!isset($input['featured'])) {
            $input['featured'] = 0;
        }
        if (!isset($input['series'])) {
            $input['series'] = 0;
        }

        if (isset($request['is_protect'])) {
            $input['is_protect'] = 1;
        } else {
            $input['is_protect'] = 0;
        }

        if ($input['is_protect'] == 1) {
            $request->validate([
                'password' => 'required',
            ]);
        }
        if ($request->slug != null) {
            $input['slug'] = $request->slug;
        } else {
            $slug = str_slug($input['title'], '-');
            $input['slug'] = $slug;
        }

        if ($input['tmdb'] == 'Y') {

            if ($TMDB_API_KEY == null || $TMDB_API_KEY == '') {
                return back()->with('deleted', 'Please provide your TMDB api key or add movie by custom fields');
            }

            $title = urlencode($input['title']);

            if (isset($request->movie_by_id)) {
                $search_data = @file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=' . $TMDB_API_KEY . '&query=' . $title);

                if ($search_data) {
                    $data = json_decode($search_data, true);
                }

                $input['fetch_by'] = "title";

            } else {
                $title2 = urlencode($request->title2);
                $search_data = @file_get_contents('https://api.themoviedb.org/3/movie/' . $title2 . '?api_key=' . $TMDB_API_KEY);

                $x2 = json_decode($search_data, true);
                $data2 = [];
                $data2[] = ['results' => [$x2]];
                $data = $data2[0];

                $input['title'] = $data['results'][0]['title'];

                $input['fetch_by'] = "byID";
            }

            if (isset($data) && $data['results'] == null) {
                return back()->with('deleted', 'Movie does not found by tmdb servers !');
            }

            if (Session::has('changed_language')) {
                $fetch_movie = @file_get_contents('https://api.themoviedb.org/3/movie/' . $data['results'][0]['id'] . '?api_key=' . $TMDB_API_KEY . '&language=' . Session::get('changed_language'));
                $fetch_movie_for_genres = @file_get_contents('https://api.themoviedb.org/3/movie/' . $data['results'][0]['id'] . '?api_key=' . $TMDB_API_KEY);
            } else {
                $fetch_movie = @file_get_contents('https://api.themoviedb.org/3/movie/' . $data['results'][0]['id'] . '?api_key=' . $TMDB_API_KEY);
                $fetch_movie_for_genres = @file_get_contents('https://api.themoviedb.org/3/movie/' . $data['results'][0]['id'] . '?api_key=' . $TMDB_API_KEY);
            }

            if (!$fetch_movie && !$fetch_movie_for_genres) {
                return back()->with('deleted', 'Movie does not found by tmdb servers !');
            }

            $tmdb_movie = json_decode($fetch_movie, true);
            // Only for genres
            $tmdb_movie_for_genres = json_decode($fetch_movie_for_genres, true);

            if ($tmdb_movie != null) {
                $input['tmdb_id'] = $tmdb_movie['id'];
            } else {
                return back()->with('deleted', 'Movie does not found by tmdb servers !');
            }

            if (!isset($input['trailer_url']) && $tmdb_movie != null && $TMDB_API_KEY != null) {
                if ($this->get_http_response_code('https://api.themoviedb.org/3/movie/' . $input['tmdb_id'] . '/videos?api_key=' . $TMDB_API_KEY) != "200") {
                    $input['trailer_url'] = null;
                } else {
                    $tmdb_trailers = @file_get_contents('https://api.themoviedb.org/3/movie/' . $input['tmdb_id'] . '/videos?api_key=' . $TMDB_API_KEY);
                    if ($tmdb_trailers) {
                        $tmdb_trailers = json_decode($tmdb_trailers, true);
                        if ($tmdb_trailers['results'] != null) {
                            $input['trailer_url'] = 'https://youtu.be/' . $tmdb_trailers['results'][0]['key'];
                        }
                    } else {
                        $input['trailer_url'] = null;
                    }
                }
            }

            $thumbnail = null;
            $poster = null;

            if ($file = $request->file('thumbnail')) {
                $request->validate([
                    'thumbnail'=>'sometimes|image|mimes:jpg,jpeg,png'
                 ]);

                $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
                if ($movie->thumbnail != null) {
                    $content = @file_get_contents(public_path() . '/images/movies/thumbnails/' . $movie->thumbnail);
                    if ($content) {
                        unlink(public_path() . "/images/movies/thumbnails/" . $movie->thumbnail);
                    }
                }
                $file->move('images/movies/thumbnails', $thumbnail);
            } else {

                $url = $tmdb_movie['poster_path'];
                $contents = @file_get_contents('https://image.tmdb.org/t/p/w300/' . $url);
                $name = substr($url, strrpos($url, '/') + 1);
                $name = 'tmdb_' . $name;
                if ($contents) {
                    $tmdb_img = Storage::disk('imdb_poster_movie')->put($name, $contents);
                    if ($tmdb_img) {
                        $thumbnail = $name;
                    }
                }
            }

            if ($file = $request->file('poster')) {
                $request->validate([
                    'poster'=>'sometimes|image|mimes:jpg,jpeg,png'
                 ]);
                $poster = 'poster_' . time() . $file->getClientOriginalName();
                if ($movie->poster != null) {
                    $content = @file_get_contents(public_path() . '/images/movies/posters/' . $movie->poster);
                    if ($content) {
                        unlink(public_path() . "/images/movies/posters/" . $movie->poster);
                    }
                }
                $file->move('images/movies/posters', $poster);
            } else {

                $url_2 = $tmdb_movie['backdrop_path'];
                $contents_2 = @file_get_contents('https://image.tmdb.org/t/p/w300/' . $url_2);
                $name_2 = substr($url_2, strrpos($url_2, '/') + 1);
                $name_2 = 'tmdb_' . $name_2;
                if ($contents_2) {
                    $tmdb_img_2 = Storage::disk('imdb_backdrop_movie')->put($name_2, $contents_2);
                    if ($tmdb_img_2) {
                        $poster = $name_2;
                    }
                }
            }

            // Get Directors and create theme
            $tmdb_directors_id = collect();
            $get_tmdb_director_data = @file_get_contents('https://api.themoviedb.org/3/movie/' . $tmdb_movie['id'] . '/credits?api_key=' . $TMDB_API_KEY);
            if ($get_tmdb_director_data) {
                $get_tmdb_director_data = json_decode($get_tmdb_director_data, true);
                $get_tmdb_director_data = (object) $get_tmdb_director_data;
                foreach ($get_tmdb_director_data->crew as $key => $item_dir) {

                    if ($item_dir['department'] === 'Directing') {
                        // getting director biography
                        $director_bio = null;
                        $director_birth = null;
                        $director_dob = null;
                        // getting Director id
                        $get_tmdb_director_biography = @file_get_contents('https://api.themoviedb.org/3/person/' . $item_dir['id'] . '?api_key=' . $TMDB_API_KEY);

                        if (isset($get_tmdb_director_biography)) {
                            $get_tmdb_director_biography = json_decode($get_tmdb_director_biography, true);

                            $director_bio = $get_tmdb_director_biography['biography'];
                            $director_birth = $get_tmdb_director_biography['place_of_birth'];
                            $director_dob = $get_tmdb_director_biography['birthday'];

                        }
                        $check_list = Director::where('name', $item_dir['name'])->first();

                        if (!isset($check_list)) {

                            // Director Image
                            $director_image = null;
                            $dir_image_url = $item_dir['profile_path'];
                            $dir_contents = @file_get_contents('https://image.tmdb.org/t/p/w500/' . $dir_image_url);
                            $dir_img_name = substr($dir_image_url, strrpos($dir_image_url, '/') + 1);
                            $dir_img_name = 'tmdb_' . $dir_img_name;
                            if ($dir_contents) {
                                $dir_created_img = Storage::disk('director_image_path')->put($dir_img_name, $dir_contents);
                                if ($dir_created_img) {
                                    $director_image = $dir_img_name;
                                }
                            }

                            $tmdb_director = Director::create(['name' => $item_dir['name'], 'image' => $director_image, 'biography' => $director_bio, 'place_of_birth' => $director_birth, 'DOB' => $director_dob]);

                            if (isset($tmdb_director)) {
                                $tmdb_directors_id->push($tmdb_director->id);
                            }

                        } else {
                            $tmdb_directors_id->push($check_list->id);
                        }
                    }

                }
            }
            $tmdb_directors_id = $tmdb_directors_id->flatten();

            // get actors and create theme
            $tmdb_actors_id = collect();
            $get_tmdb_actors_data = @file_get_contents('https://api.themoviedb.org/3/movie/' . $tmdb_movie['id'] . '/credits?api_key=' . $TMDB_API_KEY);
            if ($get_tmdb_actors_data) {
                $get_tmdb_actors_data = json_decode($get_tmdb_actors_data, true);
                // $get_tmdb_actors_data = (object) $get_tmdb_actors_data;
                if (count($get_tmdb_actors_data) > 0) {
                    foreach ($get_tmdb_actors_data['cast'] as $key => $item_act) {
                        if ($key <= 4) {
                            $actor_bio = null;
                            $actor_birth = null;
                            $actor_dob = null;
                            // getting actor id
                            $get_tmdb_actors_biography = @file_get_contents('https://api.themoviedb.org/3/person/' . $item_act['id'] . '?api_key=' . $TMDB_API_KEY);
                            if (isset($get_tmdb_actors_biography)) {
                                $get_tmdb_actors_biography = json_decode($get_tmdb_actors_biography, true);

                                $actor_bio = $get_tmdb_actors_biography['biography'];
                                $actor_birth = $get_tmdb_actors_biography['place_of_birth'];
                                $actor_dob = $get_tmdb_actors_biography['birthday'];

                            }

                            $check_list = Actor::where('name', $item_act['name'])->first();

                            if (!isset($check_list)) {

                                // Actor Image
                                $actor_image = null;
                                $act_image_url = $item_act['profile_path'];
                                $act_contents = @file_get_contents('https://image.tmdb.org/t/p/w500/' . $act_image_url);
                                $act_img_name = substr($act_image_url, strrpos($act_image_url, '/') + 1);
                                $act_img_name = 'tmdb_' . $act_img_name;
                                if ($act_contents) {
                                    $dir_created_img = Storage::disk('actor_image_path')->put($act_img_name, $act_contents);
                                    if ($dir_created_img) {
                                        $actor_image = $act_img_name;
                                    }
                                }

                                $tmdb_actor = Actor::create(['name' => $item_act['name'], 'image' => $actor_image, 'biography' => $actor_bio, 'place_of_birth' => $actor_birth, 'DOB' => $actor_dob]);

                                if (isset($tmdb_actor)) {
                                    $tmdb_actors_id->push($tmdb_actor->id);
                                }

                            } else {

                                $tmdb_actors_id->push($check_list->id);

                            }
                        }
                    }
                }
            }
            $tmdb_actors_id = $tmdb_actors_id->flatten();

            // get Genres and create theme
            $tmdb_genres_id = collect();
            if (isset($tmdb_movie_for_genres) && $tmdb_movie_for_genres != null) {
                foreach ($tmdb_movie_for_genres['genres'] as $tmdb_genre) {

                    $tmdb_genre1 = $tmdb_genre['name'];
                    $check_list = Genre::where('name', 'LIKE', "%$tmdb_genre1%")->first();

                    if (!isset($check_list)) {
                        $created_genre = Genre::create(['name' => ['en' => $tmdb_genre['name']], 'position' => (Genre::count() + 1)]);

                        $tmdb_genres_id->push($created_genre->id);
                    } else {
                        $tmdb_genres_id->push($check_list->id);
                    }
                }
            }
            $tmdb_genres_id = $tmdb_genres_id->flatten();

            if ($tmdb_movie['release_date'] != '') {
                $publish_year = substr($tmdb_movie['release_date'], 0, 4);
            } else {
                $publish_year = null;
            }
            // $publish_year = substr($tmdb_movie['release_date'], 0, 4);
            $tmdb_directors_id = substr($tmdb_directors_id, 1, -1);
            $tmdb_actors_id = substr($tmdb_actors_id, 1, -1);
            $tmdb_genres_id = substr($tmdb_genres_id, 1, -1);

            if ($input['series'] == 1 && $movie->series == 1) { //return $request->movie_id;
                $movie_series = MovieSeries::where('series_movie_id', $movie->id);
                $movie_series->update(['movie_id' => $request->movie_id, 'series_movie_id' => $movie->id]);
            }

            if ($input['series'] == 1 && $movie->series != 1) {
                MovieSeries::create(['movie_id' => $request->movie_id, 'series_movie_id' => $movie->id]);
            }

            $keyword = $request->keyword;
            $description = $request->description;

            if (isset($request->movie_by_id)) {
                $input['fetch_by'] = 'title';
            } else {
                $input['fetch_by'] = 'byID';
            }

           try{
                 $movie->update(['title' => $input['title'], 'tmdb_id' => $tmdb_movie['id'], 'keyword' => $keyword, 'description' => $description, 'duration' => $tmdb_movie['runtime'], 'tmdb' => $input['tmdb'], 'director_id' => $tmdb_directors_id, 'actor_id' => $tmdb_actors_id, 'genre_id' => $tmdb_genres_id, 'trailer_url' => $input['trailer_url'], 'subtitle' => $subtitle, 'featured' => $input['featured'], 'series' => $input['series'], 'detail' => $tmdb_movie['overview'], 'rating' => $tmdb_movie['vote_average'], 'publish_year' => $publish_year, 'released' => $tmdb_movie['release_date'], 'maturity_rating' => $input['maturity_rating'], 'a_language' => $input['a_language'], 'thumbnail' => $thumbnail, 'poster' => $poster, 'fetch_by' => $input['fetch_by'], 'is_protect' => $input['is_protect'], 'password' => $input['password'], 'slug' => $input['slug']]);

                if (isset($movie->video_link)) {

                    if ($request->selecturl == "iframeurl") {

                        $movie->video_link->update(['iframeurl' => $input['iframeurl'], 'type' => 'iframeurl', 'ready_url' => null, 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null]);

                    } else {

                        if ($request->selecturl == "youtubeurl" || $request->selecturl == "vimeourl" || $request->selecturl == "customurl" || $request->selecturl == "vimeoapi" || $request->selecturl == "youtubeapi") {

                            $movie->video_link->update(['type' => 'readyurl', 'iframeurl' => null, 'ready_url' => $input['ready_url'], 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null]);

                        } elseif ($request->selecturl == 'multiqcustom') {

                            $url = url('/movies_upload');

                            if ($file = $request->file('upload_video_360')) {
                                $file_360 = trim($movie
                                        ->video_link->url_360, $url);

                                    if ($movie->video_link->url_360 != '') {
                                    if (file_exists('movies_upload/' . $file_360)) {
                                        unlink('movies_upload/' . $file_360);
                                    }
                                }

                                $name = time() . $file->getClientOriginalName();
                                $file->move('movies_upload', $name);
                                $url_360 = asset('movies_upload/' . $name);

                            } else {

                                if ($movie
                                    ->video_link->url_360 != $request->url_360) {

                                    $file_360 = trim($movie
                                            ->video_link->url_360, $url);

                                        if ($movie->video_link->url_360 != '') {
                                        if (file_exists('movies_upload/' . $file_360)) {
                                            $file_360 = trim($movie
                                                    ->video_link->url_360, $url);
                                                unlink('movies_upload/' . $file_360);
                                        }
                                    }

                                    $url_360 = $request->url_360;

                                } else {
                                    $url_360 = $request->url_360;
                                }

                            }

                            if ($file = $request->file('upload_video_480')) {
                                $file_480 = trim($movie
                                        ->video_link->url_480, $url);

                                    if ($movie->video_link->url_480 != '') {
                                    if (file_exists('movies_upload/' . $file_480)) {
                                        unlink('movies_upload/' . $file_480);
                                    }
                                }

                                $name = time() . $file->getClientOriginalName();
                                $file->move('movies_upload', $name);
                                $url_480 = asset('movies_upload/' . $name);

                            } else {

                                if ($movie
                                    ->video_link->url_480 != $request->url_480) {

                                    $file_480 = trim($movie
                                            ->video_link->url_480, $url);

                                        if ($movie->video_link->url_480 != '') {
                                        if (file_exists('movies_upload/' . $file_480)) {
                                            $file_480 = trim($movie
                                                    ->video_link->url_480, $url);
                                                unlink('movies_upload/' . $file_360);
                                        }
                                    }

                                    $url_480 = $request->url_480;

                                } else {
                                    $url_480 = $request->url_480;
                                }

                            }

                            if ($file = $request->file('upload_video_720')) {

                                $file_720 = trim($movie
                                        ->video_link->url_720, $url);

                                    if ($movie->video_link->url_720 != '') {
                                    if (file_exists('movies_upload/' . $file_720)) {
                                        unlink('movies_upload/' . $file_720);
                                    }
                                }

                                $name = time() . $file->getClientOriginalName();
                                $file->move('movies_upload', $name);
                                $url_720 = asset('movies_upload/' . $name);

                            } else {

                                if ($movie
                                    ->video_link->url_720 != $request->url_720) {

                                    $file_720 = trim($movie
                                            ->video_link->url_720, $url);

                                        if ($movie->video_link->url_720 != '') {
                                        if (file_exists('movies_upload/' . $file_720)) {
                                            $file_720 = trim($movie
                                                    ->video_link->url_720, $url);
                                                unlink('movies_upload/' . $file_720);
                                        }
                                    }

                                    $url_720 = $request->url_720;

                                } else {
                                    $url_720 = $request->url_720;
                                }

                            }

                            if ($file = $request->file('upload_video_1080')) {
                                $file_1080 = trim($movie
                                        ->video_link->url_1080, $url);

                                    if ($movie->video_link->url_1080 != '') {
                                    if (file_exists('movies_upload/' . $file_1080)) {
                                        unlink('movies_upload/' . $file_1080);
                                    }
                                }

                                $name = str_random(5) . time() . $file->getClientOriginalName();
                                $file->move('movies_upload', $name);
                                $url_1080 = asset('movies_upload/' . $name);

                            } else {

                                if ($movie
                                    ->video_link->url_1080 != $request->url_1080) {

                                    $file_1080 = trim($movie
                                            ->video_link->url_1080, $url);

                                        if ($movie->video_link->url_1080 != '') {
                                        if (file_exists('movies_upload/' . $file_1080)) {
                                            $file_1080 = trim($movie
                                                    ->video_link->url_1080, $url);
                                                unlink('movies_upload/' . $file_1080);
                                        }
                                    }

                                    $url_1080 = $request->url_1080;

                                } else {
                                    $url_1080 = $request->url_1080;
                                }

                            }

                            $movie->video_link->update(['url_360' => $url_360, 'type' => 'multiquality', 'url_480' => $url_480, 'url_720' => $url_720, 'url_1080' => $url_1080, 'iframeurl' => null, 'ready_url' => null]);

                        }
                    }

                } else {

                    if ($request->selecturl == "youtubeurl" || $request->selecturl == "vimeourl" || $request->selecturl == "customurl" || $request->selecturl == "vimeoapi" || $request->selecturl == "youtubeapi") {

                        VideoLink::create(['movie_id' => $movie->id, 'type' => 'readyurl', 'ready_url' => $input['ready_url'], 'iframeurl' => null, 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null]);

                    }

                }

                if ($menus != null) {
                    if (count($menus) > 0) {
                        if (isset($movie->menus) && count($movie->menus) > 0) {
                            foreach ($movie->menus as $key => $value) {
                                $value->delete();
                            }
                        }
                        foreach ($menus as $key => $value) {
                            MenuVideo::create(['menu_id' => $value, 'movie_id' => $movie->id]);
                        }
                    }
                } else {
                    if (isset($movie->menus) && count($movie->menus) > 0) {
                        foreach ($movie->menus as $key => $value) {
                            $value->delete();
                        }
                    }
                }

                return redirect('/admin/movies')->with('updated', 'Movie has been updated');
           }catch(\Exception $e){
                return back()->with('deleted',$e->getMessage());
           }
        }

        $director_ids = $request->input('director_id');
        if ($director_ids) {
            $director_ids = implode(',', $director_ids);
            $input['director_id'] = $director_ids;
        } else {
            $input['director_id'] = null;
        }

        $actor_ids = $request->input('actor_id');
        if ($actor_ids) {
            $actor_ids = implode(',', $actor_ids);
            $input['actor_id'] = $actor_ids;
        } else {
            $input['actor_id'] = null;
        }

        $genre_ids = $request->input('genre_id');
        if ($genre_ids) {
            $genre_ids = implode(',', $genre_ids);
            $input['genre_id'] = $genre_ids;
        } else {
            $input['genre_id'] = null;
        }

        if ($file = $request->file('thumbnail')) {
            $request->validate([
                    'thumbnail'=>'sometimes|image|mimes:jpg,jpeg,png'
                 ]);
            $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
            if ($movie->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/movies/thumbnails/' . $movie->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/movies/thumbnails/" . $movie->thumbnail);
                }
            }
            $file->move('images/movies/thumbnails', $thumbnail);
            $input['thumbnail'] = $thumbnail;
        }

        if ($file = $request->file('poster')) {
            $request->validate([
                    'poster'=>'sometimes|image|mimes:jpg,jpeg,png'
                 ]);
            $poster = 'thumb_' . time() . $file->getClientOriginalName();
            if ($movie->poster != null) {
                $content = @file_get_contents(public_path() . '/images/movies/posters/' . $movie->poster);
                if ($content) {
                    unlink(public_path() . "/images/movies/posters/" . $movie->poster);
                }
            }
            $file->move('images/movies/posters', $poster);
            $input['poster'] = $poster;
        }

        if ($input['series'] == 1 && $movie->series == 1) {
            $movie_series = MovieSeries::where('series_movie_id', $movie->id);
            $movie_series->update(['movie_id' => $request->movie_id, 'series_movie_id' => $movie->id]);
        }

        if ($input['series'] == 1 && $movie->series != 1) {
            MovieSeries::create(['movie_id' => $request->movie_id, 'series_movie_id' => $movie->id]);
        }

        if (isset($request->subtitle)) {
            $input['subtitle'] = 1;
        } else {

            $input['subtitle'] = 0;
        }
        if (isset($request['is_protect'])) {
            $request->validate([
                'password' => 'required',
            ]);

            $input['is_protect'] = 1;
        } else {
            $input['is_protect'] = 0;
        }

        try{
            $movie->update($input);

            if (isset($movie->video_link)) {

                if ($request->selecturl == "iframeurl") {

                    $movie->video_link->update(['iframeurl' => $input['iframeurl'], 'type' => 'iframeurl', 'ready_url' => null, 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null]);

                } else {

                    if ($request->selecturl == "youtubeurl" || $request->selecturl == "vimeourl" || $request->selecturl == "customurl" || $request->selecturl == "vimeoapi" || $request->selecturl == "youtubeapi") {

                        $movie->video_link->update(['iframeurl' => null, 'type' => 'readyurl', 'ready_url' => $input['ready_url'], 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null,

                        ]);

                    } elseif ($request->selecturl == 'multiqcustom') {

                        $url = url('/movies_upload');

                        if ($file = $request->file('upload_video_360')) {
                            $file_360 = trim($movie->video_link->url_360, $url);

                            if ($movie->video_link->url_360 != '') {
                                if (file_exists('movies_upload/' . $file_360)) {
                                    unlink('movies_upload/' . $file_360);
                                }
                            }

                            $name = time() . $file->getClientOriginalName();
                            $file->move('movies_upload', $name);
                            $url_360 = asset('movies_upload/' . $name);

                        } else {

                            if ($movie->video_link->url_360 != $request->url_360) {

                                $file_360 = trim($movie
                                        ->video_link->url_360, $url);

                                    if ($movie->video_link->url_360 != '') {
                                    if (file_exists('movies_upload/' . $file_360)) {
                                        $file_360 = trim($movie
                                                ->video_link->url_360, $url);
                                            unlink('movies_upload/' . $file_360);
                                    }
                                }

                                $url_360 = $request->url_360;

                            } else {
                                $url_360 = $request->url_360;
                            }

                        }

                        if ($file = $request->file('upload_video_480')) {
                            $file_480 = trim($movie->video_link->url_480, $url);

                            if ($movie->video_link->url_480 != '') {
                                if (file_exists('movies_upload/' . $file_480)) {
                                    unlink('movies_upload/' . $file_480);
                                }
                            }

                            $name = time() . $file->getClientOriginalName();
                            $file->move('movies_upload', $name);
                            $url_480 = asset('movies_upload/' . $name);

                        } else {

                            if ($movie->video_link->url_480 != $request->url_480) {

                                $file_480 = trim($movie
                                        ->video_link->url_480, $url);

                                    if ($movie->video_link->url_480 != '') {
                                    if (file_exists('movies_upload/' . $file_480)) {
                                        $file_480 = trim($movie
                                                ->video_link->url_480, $url);
                                            unlink('movies_upload/' . $file_360);
                                    }
                                }

                                $url_480 = $request->url_480;

                            } else {
                                $url_480 = $request->url_480;
                            }

                        }

                        if ($file = $request->file('upload_video_720')) {

                            $file_720 = trim($movie->video_link->url_720, $url);

                            if ($movie->video_link->url_720 != '') {
                                if (file_exists('movies_upload/' . $file_720)) {
                                    unlink('movies_upload/' . $file_720);
                                }
                            }

                            $name = time() . $file->getClientOriginalName();
                            $file->move('movies_upload', $name);
                            $url_720 = asset('movies_upload/' . $name);

                        } else {

                            if ($movie->video_link->url_720 != $request->url_720) {

                                $file_720 = trim($movie->video_link->url_720, $url);

                                if ($movie->video_link->url_720 != '') {
                                    if (file_exists('movies_upload/' . $file_720)) {
                                        $file_720 = trim($movie
                                                ->video_link->url_720, $url);
                                            unlink('movies_upload/' . $file_720);
                                    }
                                }

                                $url_720 = $request->url_720;

                            } else {
                                $url_720 = $request->url_720;
                            }

                        }

                        if ($file = $request->file('upload_video_1080')) {
                            $file_1080 = trim($movie->video_link->url_1080, $url);

                            if ($movie->video_link->url_1080 != '') {
                                if (file_exists('movies_upload/' . $file_1080)) {
                                    unlink('movies_upload/' . $file_1080);
                                }
                            }

                            $name = str_random(5) . time() . $file->getClientOriginalName();
                            $file->move('movies_upload', $name);
                            $url_1080 = asset('movies_upload/' . $name);

                        } else {

                            if ($movie->video_link->url_1080 != $request->url_1080) {

                                $file_1080 = trim($movie->video_link->url_1080, $url);

                                if ($movie->video_link->url_1080 != '') {
                                    if (file_exists('movies_upload/' . $file_1080)) {
                                        $file_1080 = trim($movie
                                                ->video_link->url_1080, $url);
                                            unlink('movies_upload/' . $file_1080);
                                    }
                                }

                                $url_1080 = $request->url_1080;

                            } else {
                                $url_1080 = $request->url_1080;
                            }

                        }

                        $movie->video_link->update(['url_360' => $url_360, 'url_480' => $url_480, 'url_720' => $url_720, 'url_1080' => $url_1080, 'type' => 'multiquality', 'iframeurl' => null, 'ready_url' => null]);

                    }

                }
            } else {

                if ($request->selecturl == "youtubeurl" || $request->selecturl == "vimeourl" || $request->selecturl == "customurl" || $request->selecturl == "vimeoapi" || $request->selecturl == "youtubeapi") {

                    VideoLink::create(['movie_id' => $created_movie->id, 'type' => 'readyurl', 'ready_url' => $input['ready_url'], 'iframeurl' => null, 'url_360' => null, 'url_480' => null, 'url_720' => null, 'url_1080' => null]);

                }

            }

            if ($menus != null) {
                if (count($menus) > 0) {
                    if (isset($movie->menus) && count($movie->menus) > 0) {
                        foreach ($movie->menus as $key => $value) {
                            $value->delete();
                        }
                    }
                    foreach ($menus as $key => $value) {
                        MenuVideo::create(['menu_id' => $value, 'movie_id' => $movie->id]);
                    }
                }
            } else {
                if (isset($movie->menus) && count($movie->menus) > 0) {
                    foreach ($movie->menus as $key => $value) {
                        $value->delete();
                    }
                }
            }

            return redirect('/admin/movies')->with('updated', 'Movie has been updated');
        }catch(\Exception $e){
            return back()->with('deleted',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $movie = Movie::findOrFail($id);

        $watched = WatchHistory::where('movie_id', $id)->delete();

        foreach ($movie->multilinks as $multilink) {
            $multilink->delete();
        }

        $movie_series = MovieSeries::where('movie_id', $id)->orwhere('series_movie_id', $id)->first();

        $url = url('movies_upload');

        if (isset($movie->video_link->url_360) && $movie->video_link->url_360 != '') {
            $file_360 = trim($movie->video_link->url_360, $url);

            if (file_exists('movies_upload/' . $file_360)) {
                unlink('movies_upload/' . $file_360);
            }
        }

        if (isset($movie->video_link->url_480) && $movie->video_link->url_480 != '') {
            $file_480 = trim($movie->video_link->url_480, $url);

            if (file_exists('movies_upload/' . $file_480)) {
                unlink('movies_upload/' . $file_480);
            }
        }

        if (isset($movie->video_link->url_720) && $movie->video_link->url_720 != '') {

            $file_720 = trim($movie->video_link->url_720, $url);

            if (file_exists('movies_upload/' . $file_720)) {
                unlink('movies_upload/' . $file_720);
            }

        }

        if (isset($movie->video_link->url_1080) && $movie->video_link->url_1080 != '') {
            $file_1080 = trim($movie->video_link->url_1080, $url);

            if (file_exists('movies_upload/' . $file_1080)) {
                unlink('movies_upload/' . $file_1080);
            }
        }

        if ($movie->thumbnail != null) {
            $content = @file_get_contents(public_path() . '/images/movies/thumbnails/' . $movie->thumbnail);
            if ($content) {
                unlink(public_path() . "/images/movies/thumbnails/" . $movie->thumbnail);
            }
        }
        if ($movie->poster != null) {
            $content = @file_get_contents(public_path() . '/images/movies/posters/' . $movie->poster);
            if ($content) {
                unlink(public_path() . "/images/movies/posters/" . $movie->poster);
            }
        }
        if ($movie->subtitle_files != null) {
            $content = @file_get_contents(public_path() . '/subtitles/' . $movie->subtitle_files);
            if ($content) {
                unlink(public_path() . "/subtitles/" . $movie->subtitle_files);
            }
        }
        $videolink = VideoLink::where('movie_id', $id)->first();

        if (isset($videolink)) {
            $videolink->delete();
        }
        if (isset($movie_series)) {
            $movie_series->delete();
        }

        $movie->delete();

        return back()->with('deleted', 'Movie has been deleted');
    }

    public function bulk_delete(Request $request)
    {
       if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $validator = Validator::make($request->all(), ['checked' => 'required']);

        if ($validator->fails()) {

            return back()
                ->with('deleted', 'Please check one of them to delete');
        }

        foreach ($request->checked as $checked) {

            $movie = Movie::findOrFail($checked);
            $watched = WatchHistory::where('movie_id', $checked)->delete();
            $movie_series = MovieSeries::where('movie_id', $checked)->orwhere('series_movie_id', $checked)->get();
            foreach ($movie->multilinks as $multilink) {
                $multilink->delete();
            }

            if ($movie->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/movies/thumbnails/' . $movie->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/movies/thumbnails/" . $movie->thumbnail);
                }
            }
            if ($movie->poster != null) {
                $content = @file_get_contents(public_path() . '/images/movies/posters/' . $movie->poster);
                if ($content) {
                    unlink(public_path() . "/images/movies/posters/" . $movie->poster);
                }
            }
            if ($movie->subtitle_files != null) {
                $content = @file_get_contents(public_path() . '/subtitles/' . $movie->subtitle_files);
                if ($content) {
                    unlink(public_path() . "/subtitles/" . $movie->subtitle_files);
                }
            }
            $id = $checked;
            $videolink = VideoLink::where('movie_id', $id)->first();

            $url = url('movies_upload');

            if ($movie->video_link->url_360 != '') {
                $file_360 = trim($movie->video_link->url_360, $url);

                if (file_exists('movies_upload/' . $file_360)) {
                    unlink('movies_upload/' . $file_360);
                }
            }

            if ($movie->video_link->url_480 != '') {
                $file_480 = trim($movie->video_link->url_480, $url);

                if (file_exists('movies_upload/' . $file_480)) {
                    unlink('movies_upload/' . $file_480);
                }
            }

            if ($movie->video_link->url_720 != '') {

                $file_720 = trim($movie->video_link->url_720, $url);

                if (file_exists('movies_upload/' . $file_720)) {
                    unlink('movies_upload/' . $file_720);
                }

            }

            if ($movie->video_link->url_1080 != '') {
                $file_1080 = trim($movie->video_link->url_1080, $url);

                if (file_exists('movies_upload/' . $file_1080)) {
                    unlink('movies_upload/' . $file_1080);
                }
            }

            if (isset($videolink)) {
                $videolink->delete();
            }
            if (isset($movie_series)) {
                MovieSeries::destroy($checked);
            }
            Movie::destroy($checked);
        }

        return back()->with('deleted', 'Movies has been deleted');
    }

    /**
     * Translate the specified resource from storage.
     * Translate all tmdb movies on one click
     * @return \Illuminate\Http\Response
     */
    public function tmdb_translations()
    {
        ini_set('max_execution_time', 1000);
        $all_movies = Movie::where('tmdb', 'Y')->get();
        $TMDB_API_KEY = env('TMDB_API_KEY');

        if ($TMDB_API_KEY == null || $TMDB_API_KEY == '') {
            return back()->with('deleted', 'Please provide your TMDB api key to translate');
        }

        if (isset($all_movies) && count($all_movies) > 0) {
            foreach ($all_movies as $key => $movie) {
                if (Session::has('changed_language')) {
                    $fetch_movie = @file_get_contents('https://api.themoviedb.org/3/movie/' . $movie->tmdb_id . '?api_key=' . $TMDB_API_KEY . '&language=' . Session::get('changed_language'));
                } else {
                    return back()->with('updated', 'Please Choose a language by admin panel top right side language menu');
                }

                $tmdb_movie = json_decode($fetch_movie, true);
                if (isset($tmdb_movie) && $tmdb_movie != null) {
                    $movie->update(['detail' => $tmdb_movie['overview']]);
                }
            }
            return back()->with('added', 'All Movies (only by TMDB) has been translated');
        } else {
            return back()
                ->with('updated', 'Please create at least one movie by TMDB option to translate');
        }
    }

    public function multiplelinks($id)
    {
        $links = MultipleLinks::orderBy('id', 'desc')->where('movie_id', $id)->get();
        $language = AudioLanguage::all();
        $link = MultipleLinks::where('movie_id', $id)->get();
        return view('admin.movie.link', compact('links', 'id', 'language', 'link'));

    }

    public function storelink(Request $request, $id)
    {
       if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        if (isset($request->download)) {
            $request->validate([
                'quality' => 'required',
                'size' => 'required',
                'language' => 'required',
                'url' => 'required',
            ]);
        }

        $input = $request->all();
        if (isset($request->download)) {
            $input['download'] = 1;
        } else {
            $input['download'] = 0;
        }
        $input['movie_id'] = $id;
        try{
            $data = MultipleLinks::create($input);
             return back()->with('added', 'Multiple links has been added');
        }catch(\Exception $e){
            return back()->with('deleted',$e->getMessage());
        }
        
    }

    public function editlink(Request $request, $id)
    {
       if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $data = MultipleLinks::findorFail($id);

        if (isset($request->download)) {
            $request->validate([
                'quality' => 'required',
                'size' => 'required',
                'language' => 'required',
                'url' => 'required',
            ]);
        }

        $input = $request->all();
        if (isset($request->download)) {
            $input['download'] = 1;
        } else {
            $input['download'] = 0;
        }

        try{
            $data->update($input);

            return back()->with('added', 'Multiple links has been updated');
        }catch(\Exception $e){
            return back()->with('deleted',$e->getMessage());
        }
    }

    public function deletelink($id)
    {
       if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $delete_link = MultipleLinks::findorFail($id);
        try{
            $delete_link->delete();

            return back()->with('deleted', 'Multiple links has been deleted');
        }catch(\Exception $e){
            return back()->with('deleted',$e->getMessage());
        }
    }

}
