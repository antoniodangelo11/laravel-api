<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    private $validations = [
        "title"            => "required|string|max:50",      
        "creation_date"    => "required|date",
        "last_update"      => "required|date",
        "author"           => "required|string|max:30",
        "collaborators"    => "nullable|string|max:150",
        "description"      => "nullable|string|max:2000",
        'image'            => 'nullable|image|max:1024',  
        "link_github"      => "required|string|url|max:150",
        'technologies'     => 'nullable|array',
        "type_id"          => "required|integer|exists:types,id",
    ];

    private $validation_messages = [
        'required'  => 'Il campo :attribute è obbligatorio',
        'min'       => 'Il campo :attribute deve avere almeno :min caratteri',
        // 'max'       => 'Il campo :attribute non può superare i :max caratteri',
        'url'       => 'Il campo deve essere un url valido',
        'exists'    => 'Valore non valido'
    ];

    public function index()
    {
        $projects = Project::paginate(4);

        return view('admin.projects.index', compact('projects'));
    }


    public function create()
    {
        $types = Type::All();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }


    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        $imagePath = Storage::put('uploads', $data['image']);

        // salvare i dati nel db
        $newProject = new Project();
        
        $newProject->title         = $data['title'];
        $newProject->slug          = Project::slugger($data['title']);
        $newProject->creation_date = $data['creation_date'];
        $newProject->last_update   = $data['last_update'];
        $newProject->author        = $data['author'];
        $newProject->collaborators = $data['collaborators'];
        $newProject->description   = $data['description'];
        $newProject->image         = $imagePath;
        $newProject->link_github   = $data['link_github'];
        $newProject->type_id       = $data['type_id'];

        $newProject->save();

        $newProject->technologies()->sync($data['technologies'] ?? []);

        // rotta di tipo get
        return to_route('admin.project.show', ['project' => $newProject]);
    }


    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.show', compact('project'));
    }


    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        
        $types = Type::all();
        $technologies = Technology::all();
        
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }


    public function update(Request $request, $slug)
    {

        $project = Project::where('slug', $slug)->firstOrFail();

        // validare i dati del form
        $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        if ($data['image']) {
            // salvo la nuova immagine
            $imagePath = Storage::put('uploads', $data['image']);

            // elimino la vecchia immagine
            if ($project->image) {
                Storage::delete($project->image);
            }

            // aggiorno l'indirizzo della nuova immagine
            $project->image = $imagePath;
        }

        // aggiornare i dati nel db
        $project->title         = $data['title'];
        $project->creation_date = $data['creation_date'];
        $project->last_update   = $data['last_update'];
        $project->author        = $data['author'];
        $project->collaborators = $data['collaborators'];
        $project->description   = $data['description'];
        $project->image         = $imagePath;
        $project->link_github   = $data['link_github'];
        $project->type_id       = $data['type_id'];
        
        $project->update();

        // associare le technologies
        $project->technologies()->sync($data['technologies'] ?? []);

        // rotta di tipo get
        return to_route('admin.project.show', ['project' => $project]);
    }

    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        $project->delete();

        return to_route('admin.project.index')->with('delete_success', $project);
    }

    public function restore($slug)
    {
        // Questo è l'ordine giusto e non deve essere diverso, per vedere il messaggio di ripristino
        $project = Project::find($slug);
        
        Project::withTrashed()->where('slug', $slug)->restore();
        $project = Project::where('slug', $slug)->firstOrFail();
        
        return to_route('admin.project.trashed')->with('restore_success', $project);
    }

    public function trashed()
    {
        $trashedProjects = Project::onlyTrashed()->all();

        return view('admin.projects.trashed', compact('trashedProjects'));
    }

    public function harddelete($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->first();

        // Cancella l'immagine dalla cartella
        if ($project->image) {
            Storage::delete($project->image);
        }

        // se ho il trashed il detach lo inserisco nel harddelete
        $project->technologies()->detach();
        $project->forceDelete();
        return to_route('admin.project.trashed')->with('delete_success', $project);
    }
}
