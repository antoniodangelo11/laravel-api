<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    private $validations = [
        "name"            => "required|string|max:50",
        "description"     => "required|string|max:5000",
    ];

    private $validation_messages = [
        'required'  => 'Il campo :attribute è obbligatorio',
        'min'       => 'Il campo :attribute deve avere almeno :min caratteri',
        'max'       => 'Il campo :attribute non può superare i :max caratteri',
        'url'       => 'Il campo deve essere un url valido',
        'exists'    => 'Valore non valido'
    ];

    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index', compact('technologies'));
    }


    public function create()
    {
        return view('admin.technologies.create');
    }


    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // salvare i dati nel db
        $newTechnology = new Technology();

        $newTechnology->name          = $data['name'];
        $newTechnology->description   = $data['description'];

        $newTechnology->save();

        // rotta di tipo get
        return to_route('admin.technology.show', ['technology' => $newTechnology]);
    }

    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }


    public function update(Request $request, Technology $technology)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // aggiornare i dati nel db
        $technology->name         = $data['name'];
        $technology->description  = $data['description'];

        $technology->update();

        // rotta di tipo get
        return to_route('admin.technology.show', ['technology' => $technology->id]);
    }

    public function destroy(Technology $technology)
    {
        $technology->projects()->detach();
        $technology->delete();

        return to_route('admin.technology.index')->with('delete_success', $technology);
    }
}
