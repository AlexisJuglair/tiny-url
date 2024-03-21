<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LinkFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LinkController extends Controller
{
    /**
     * Afficher la liste des liens.
     */
    public function index()
    {
        return view('links.index', [
            'links' => Link::orderBy('name', 'asc')->paginate(10),
        ]);
    }

    /**
     * Afficher le formulaire de création d'un lien.
     */
    public function create()
    {
        $link = new Link();
        return view('links.form', [
            'link' => $link,
        ]);
    }

    /**
     * Enregistrer un nouveu lien.
     */
    public function store(LinkFormRequest $request)
    {
        $link = Link::create($request->validated());
        return to_route('link.index')->with('success', 'Le lien a bien été crée.');
    }

    /**
     * Se rendre sur un lien.
     */
    public function show(int $id, string $alias)
    {
        try {
            $link = Link::where('id', $id)
                        ->where('alias', $alias)
                        ->firstOrFail();
            
            if (!Auth::check()) {   
                $link->increment('nb_click');
            }
    
            return redirect($link->link, 301);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
    }

    /**
     * Afficher le formulaire d'édition d'un lien.
     */
    public function edit(Link $link)
    {
        return view('links.form', [
            'link' => $link,
        ]);
    }

    /**
     * Modifier un lien.
     */
    public function update(LinkFormRequest $request, Link $link)
    {
        $link->update($request->validated());
        return to_route('link.index')->with('success', 'Le lien a bien été modifié.');
    }

    /**
     * Supprimer un lien.
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return to_route('link.index')->with('success', 'Le lien a bien été supprimé.');
    }
}
