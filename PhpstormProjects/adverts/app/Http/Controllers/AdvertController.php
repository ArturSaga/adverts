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
    public function index(Request $request)
    {
        $user = User::get()->where('id', Auth::id())->first();
        if ($user) {
            if ($user->role == 'Blocked') {
                return view('adverts.blocked');
            } elseif ($user->role === 'Admin' or 'User') {
                if ($request->all == 'all' or '') {
                    $adverts = Advert::all();
                } else {
                    $adverts = Advert::get()->where('category', $request->all);
                }
                return view('adverts.index', ['adverts' => $adverts]);
            }
        } elseif ($user == null) {
            if ($request->all == 'all') {
                $adverts = Advert::all();
            } else {
                $adverts = Advert::get()->where('category', $request->all);
            }
            return view('adverts.index', ['adverts' => $adverts]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('adverts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        Advert::create($request->all());
        $request->validate([
            'category' => ['required'],
            'subcategory' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
        ]);

        $advert = new Advert();
        $advert->user_id = Auth::id();
        $advert->category = $request->category;
        $advert->subcategory = $request->subcategory;
        $advert->title = $request->title;
        $advert->description = $request->description;
        $advert->save();


        return redirect('/adverts/category/all')->with('success', 'Объявление успешно добавлено');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $advert)
    {
        return view('adverts.show', ['advert' => $advert]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Advert $advert)
    {
        return view('adverts.create', ['advert' => $advert]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Advert $advert)
    {
        $request->validate([
            'category' => ['required'],
            'subcategory' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
        ]);
        $advert->update($request->all());
        $advert->description = $request->description;
        $advert->save();

        return redirect('/admin')->with('success', 'Объявление успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        $advert->delete();

        return redirect('/admin')->with('success', 'Объявление успешно удалено');
    }
}
