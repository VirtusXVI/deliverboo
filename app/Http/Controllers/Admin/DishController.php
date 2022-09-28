<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Dish;

use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $dishes = Dish::where('user_id', '=', $user->id);

        return view('admin.dishes.index',compact('dishes',$dishes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());
        $form_data = $request->all();
        $new_dish = new Dish();
        if(isset($form_data['dish_image'])) {
            $img_path = Storage::put('dish_image', $form_data['dish_image']);
            $form_data['dish_image'] = $img_path;
        }
        $new_dish->fill($form_data);
        $new_dish->slug = $this->slugControls($new_dish->name);

        $new_dish->save();

        return redirect()->route('admin.dishes.show', $new_dish->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::find($id);
        return view('admin.dishes.show',compact('dish',$dish));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    

    protected function getValidationRules(){
        
        return [
            'name' => 'required|unique:dishes,name|max:255',
            'description' => 'nullable',
            'ingredients' => 'nullable',
            'price' => 'required|numeric',
            'dish_image' => 'nullable'
        ];
    }


    protected function slugControls($title){
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        $existing_slug_post = Dish::where('slug','=', $slug_to_save)->first();
        $i = 1;
        while($existing_slug_post){
            $slug_to_save = $slug_base . '-' . $i;

            $existing_slug_post = Dish::where('slug', '=', $slug_to_save)->first();

            $i++;
        }
        return $slug_to_save;
    }
}
