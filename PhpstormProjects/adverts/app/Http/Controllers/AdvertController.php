<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $adverts=Advert::all();

        return view('adverts.index', compact('adverts'));
    }

    public function indexClothis()
    {
        $adverts=Advert::get()->where('category', 'Clothis');
        return view('adverts.clothis', compact('adverts'));
    }

    public function indexAuto()
    {
        $adverts=Advert::get()->where('category', 'Auto');
        return view('adverts.auto', compact('adverts'));
    }

    public function indexHome()
    {
        $adverts=Advert::get()->where('category', 'Home');
        return view('adverts.home', compact('adverts'));
    }

    public function indexSport()
    {
        $adverts=Advert::get()->where('category', 'Sport');
        return view('adverts.sport', compact('adverts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Advert $adverts)
    {
        $adverts=Advert::all();
        return view('adverts.create', compact('adverts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Advert $advert)
    {
//        Advert::create($request->all());

        $advert = new Advert();
        $advert->user_id = Auth::id();
        $advert->category = $request->category;
        $advert->subcategory = $request->subcategory;
        $advert->title = $request->title;
        $advert->description = $request->description;
        $advert->save();


        return redirect()->route('adverts.index')->with('success', 'Объявление успешно доавблено');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $advert)
    {
        return view('adverts.show', compact('advert'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Advert $advert)
    {
        return view('adverts.edit', compact('advert'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Advert $advert)
    {
//        $advert->update($request->all());

        $advert->category = $request->category;
        $advert->subcategory = $request->subcategory;
        $advert->title = $request->title;
        $advert->description = $request->description;
        $advert->save();

        return redirect()->route('adverts.index')->with('success', 'Объявление успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        $advert->delete();

        return redirect()->route('adverts.index')->with('success', 'Объявление успешно удалено');
    }
}
