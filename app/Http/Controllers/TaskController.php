<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class TaskController extends Controller
{   // fetches all records from the database
    public function index() {
        // get data ordered by id
        $data = Tasks::orderBy('id', 'asc')->get();

        return view('tasks', ['data' => $data]);
    }

    // create a new task in database
    public function create(Request $request) {
        //vaidate parameters
        $validated = $request->validate([
            'task' => 'required|string|max:255',
        ]);

        // add complete field as null
        $validated['complete'] = null;

        try {
            //run update rows
            $addRecord = Tasks::create($validated);

            // if no rows have been updated
            if ($addRecord === 0) {
                // throw expception
                throw new Exception('Task not added');
            }

            // refresh page and pass success message
            return redirect()->route('tasks.index')->with('success', 'Task added!');

        } catch (Exception $e) {
            // log error
            Log::error('Failed to create task: ' . $e->getMessage());
            // return errors
            return redirect()->route('tasks.index')->withErrors('Failed to create task: ' . $e->getMessage());
        }
        
    }

    //update task in database
    public function update(Request $request, $id) {
        //vaidate parameters
        $validated = $request->validate([
            'status' => 'required|string'
        ]);
        // count to see if there is a record for this id 
        $count = Tasks::where('id', $id)->count();
        
        // check if count is 0
        if ($count === 0) {
            // return errors
            return redirect()->route('tasks.index')->withErrors('No tasks found for id passed.');
        }

        //convert status variable to boolean
        $status = filter_var($validated['status'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        // check convert failed
        if ($status === null) {
            // return errors
            return redirect()->route('tasks.index')->withErrors('true/false not passed for status');
        }

        // add record
        try {
            //run update rows
            $updatedRows = Tasks::where('id', $id)->update(['completed' => $status]);

            // if no rows have been updated
            if ($updatedRows === 0) {
                // throw expception
                throw new Exception('Task not found or update failed.');
            }

            // refresh page and pass success message
            return redirect()->route('tasks.index')->with('success', 'Task updated!');

        } catch (Exception $e) {
            // log error
            Log::error('Failed to update task: ' . $e->getMessage());
            // return errors
            return redirect()->route('tasks.index')->withErrors('Failed to update task: ' . $e->getMessage());
        }
        
    }

     //update task in database
    public function delete($id) {

        // count to see if there is a record for this id 
        $count = Tasks::where('id', $id)->count();
        
        // check if count is 0
        if ($count === 0) {
            // return errors
            return redirect()->route('tasks.index')->withErrors('No tasks found for id passed.');
        }

        // add record
        try {
            //run update rows
            $deletedRows = Tasks::where('id', $id)->delete();

            // if no rows have been updated
            if ($deletedRows === 0) {
                // throw expception
                throw new Exception('Task not found or delete failed.');
            }

            // refresh page and pass success message
            return redirect()->route('tasks.index')->with('success', 'Task deleted!');

        } catch (Exception $e) {
            // log error
            Log::error('Failed to delete task: ' . $e->getMessage());
            // return errors
            return redirect()->route('tasks.index')->withErrors('Failed to delete task: ' . $e->getMessage());
        }
        
    }
}
