<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Todo;
use Illuminate\Http\Request;
use JamesMills\LaravelTimezone\Timezone;
use Stevebauman\Location\Facades\Location;
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
         $ip = $request->ip(); 
         $ip = '162.159.24.227'; /* Static IP address */
         $currentUserInfo = Location::get($ip);
//dd($currentUserInfo);
        $todos = Todo::all();
        return view('todo', compact('todos','currentUserInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
        $this->validate(request(), [
            'name' => ['required'],
            'date' => ['required','date'],
            'time' => ['required'],

        ]);
    } catch (ValidationException $e) {
        session()->flash('error', $e->getMessage());
        return redirect()->back();
    }



        $data = request()->all();

        try {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $todo = new Todo();
            //On the left is the field name in DB and on the right is field name in Form/view
            $todo->title = $data['name'];
            $todo->description = $data['description'];
            $todo->date = $date;
            $todo->time = $data['time'];
            $todo->status = "To Do";

            $todo->save();

            session()->flash('success', 'Todo created succesfully');

            return redirect('/');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('details');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
