<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Requests\FoodRequest;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = Food::paginate(10);
        return view('food.index',[
            'food' => $food
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $data = $request->all();
        $data['picturePath'] = $request->file('picturePath')->store('assets/food','public');

        Food::create($data);

        return redirect()->route('foods.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        return view('food.edit',[
            'item' => $food
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        $data =  $request->validate([
            'name' => ['required','max:255'],
            'description' => ['required'],
            'ingredients' => ['required'],
            'price' => ['required','integer'],
            'rate' => ['required','numeric'],
            'types' => [''],
        ]);
        
        if($request->picturePath)
        {
            $data['picturePath'] = $request->file('picturePath')->store('app/assets/food','public');
        }

        $food->update($data);

        return redirect()->route('foods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->delete();

        return redirect()->route('foods.index');
    }
}
