<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    public function edit(Request $request) {
        $request->validate([
            'conference_id' => ['required'],
            'category_id' => ['required'],
            'leader_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_time' => ['required', 'date_format:Y-m-d H:i:s']
        ]);

        if($request->input('category_id') == 0) {
            $category = new Category();
            $category->leader_id = $request->input('leader_id');
            $category->conference_id = $request->input('conference_id');
            $category->name = $request->input('name');
            $category->start_time = $request->input('start_time');
            $category->end_time = $request->input('end_time');
            if($category->save()) {
                return Redirect::back()->with('success', 'Sekcija sėkmingai pridėta');
            } else {
                return Redirect::back()->with('error', 'Nepavyko pridėti sekcijos')->withInput();
            }
        } else {
            if(Category::where('id', $request->input('category_id'))
                ->update([
                    'leader_id' => $request->input('leader_id'),
                    'name' => $request->input('name'),
                    'start_time' => $request->input('start_time'),
                    'end_time' => $request->input('end_time')
                ])) {
                return Redirect::back()->with('success', 'Sekcija sėkmingai atnaujinta');
            } else {
                return Redirect::back()->with('error', 'Nepavyko atnaujinti sekcijos informacijos')->withInput();
            }
        }
    }

    public function delete($id) {
        if(Category::where('id', $id)->update(['status' => 0])) {
            return Redirect::back()->with('success', 'Sekcija sėkmingai ištrinta');
        } else {
            return Redirect::back()->with('error', 'Nepavyko ištrinti sekcijos')->withInput();
        }
    }
}
