<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Project;
use Storage;
use Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();

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
        $file_name = $request->media->getClientOriginalName();

        if (empty($project_id) || empty($project = Project::find($project_id))) {
            redirect('activities.index')->with('status', 'error');
        }

        $validator = Validator::make($request->all(), [
            'release_date' => 'required|date',
            'type' => 'required|in:'.implode(',', Activity::getTypes()),
            'category' => 'required',
            'text' => 'required',
            'media' => 'required|file|mimes:jpeg,png,avi',
            'text_validation' => 'required|in:'.implode(',', Activity::getValidationTypes()),
            'media_validation' => 'required|in:'.implode(',', Activity::getValidationTypes())
        ]);

        if ($validator->fails()) {
            return redirect('activities.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $activity =  new Activity([
            'release_date' => $request->release_date,
            'type' => $request->type,
            'category' => $request->category,
            'text' => $request->text,
            'media' => $file_name,
            'text_validation' => $request->text_validation,
            'media_validation' => $request->media_validation
        ]);

        $activity->project()->associate($project);
        $activity->save();

        Storage::disk('public')->put('media/'.$file_name, file_get_contents($request->media));

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
        $validator = Validator::make($request->all(), [
            'release_date' => 'sometimes|required|date',
            'type' => 'sometimes|required|in:'.implode(',', Activity::getTypes()),
            'category' => 'sometimes|required',
            'text' => 'sometimes|required',
            'media' => 'sometimes|required|file|mimes:jpeg,png,avi',
            'text_validation' => 'sometimes|required|in:'.implode(',', Activity::getValidationTypes()),
            'media_validation' => 'sometimes|required|in:'.implode(',', Activity::getValidationTypes())
        ]);

        if ($validator->fails()) {
            return redirect('activities.index')
                        ->withErrors($validator)
                        ->withInput();
        }

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

        Storage::disk('public')->delete($activity->media);

        return redirect('activities.index')->with('status', 'success');
    }

    /**
     * Download the specified resource media from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadMedia($id)
    {
        $activity = Activity::find($id);
        $file_path = storage_path('app/public/media/'.$activity->media);

        return response()->download($file_path);
    }
}
