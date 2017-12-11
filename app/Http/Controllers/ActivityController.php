<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Project;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all()

        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project_id = $request->input('project_id');

        if (empty($project_id) || empty($project = Project::find($project_id))) {
            redirect('activities.index')->with('status', 'error');
        }

        $request->validate([
            'release_date' => 'required|date',
            'type' => 'required|in',
            'category' => 'required',
            'text' => 'required',
            'media' => 'required|mimes:jpg,png,avi',
            'text_validation' => 'required',
            'media_validation' => 'required'
        ]);

        $activity = Activity::create($request->all());
        $activity->project()->associate($project);
        $activity->save();

        return redirect('projects.index')->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);

        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);

        return view('activities.edit', compact('activity'));
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
            'release_date' => 'sometimes|required|date',
            'type' => 'sometimes|required|in',
            'category' => 'sometimes|required',
            'text' => 'sometimes|required',
            'media' => 'sometimes|required|mimes:jpg,png,avi',
            'text_validation' => 'sometimes|required',
            'media_validation' => 'sometimes|required'
        ]);

        $activity = Activity::find($id);
        $activity->update($request->all());

        return redirect('activities.index')->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        $activity->delete();

        return redirect('activities.index')->with('status', 'success');
    }
}
