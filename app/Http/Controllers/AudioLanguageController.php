<?php

namespace App\Http\Controllers;

use App\AudioLanguage;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AudioLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $audio_languages = \DB::table('audio_languages')->select('id', 'language', 'created_at', 'updated_at')->get();

        if ($request->ajax()) {
            return \Datatables::of($audio_languages)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $html = '<div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $row->id . '" id="checkbox' . $row->id . '">
                    <label for="checkbox' . $row->id . '" class="material-checkbox"></label>
                  </div>';

                    return $html;
                })
                ->addColumn('name', function ($row) {

                    return substr($row->language, 7, -2);

                })

                ->addColumn('created_at', function ($row) {
                    return date('F d, Y',strtotime($row->created_at));

                })
                ->addColumn('updated_at', function ($row) {
                    return date('F d, Y',strtotime($row->updated_at));

                })

                ->addColumn('action', function ($row) {
                    $btn = ' <div class="admin-table-action-block">

                    <a href="' . route('audio_language.edit', $row->id) . '" data-toggle="tooltip" data-original-title="'.__('adminstaticwords.Edit').'" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $row->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $row->id . '" class="delete-modal modal fade" role="dialog">
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
                      <form method="POST" action="' . route("audio_language.destroy", $row->id) . '">
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
                })
                ->rawColumns(['checkbox', 'name', 'created_at', 'action', 'updated_at'])
                ->make(true);
        }

        $a_lans = AudioLanguage::all();
        return view('admin.audio_language.index', compact('a_lans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.audio_language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
        ]);
        $input = $request->all();
        AudioLanguage::create($input);
        return back()->with('added', 'language has been added');
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
    public function edit($id)
    {
        $a_lan = AudioLanguage::findOrFail($id);
        return view('admin.audio_language.edit', compact('a_lan'));
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
        $request->validate([
            'language' => 'required',
        ]);
        $a_lan = AudioLanguage::findOrFail($id);
        $input = $request->all();
        $a_lan->update($input);
        return redirect('/admin/audio_language')->with('updated', 'Language has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $a_lan = AudioLanguage::findOrFail($id);
        $a_lan->delete();
        return back()->with('deleted', 'Language has been deleted');
    }

    public function bulk_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checked' => 'required',
        ]);

        if ($validator->fails()) {

            return back()->with('deleted', 'Please select one of them to delete');
        }

        foreach ($request->checked as $checked) {
            AudioLanguage::destroy($checked);
        }

        return back()->with('deleted', 'Audio Languages has been deleted');
    }
}
