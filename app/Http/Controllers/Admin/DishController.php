<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Dish;
use RealRashid\SweetAlert\Facades\Alert;


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
        $dishes = Dish::where('user_id', $user->id)->paginate(10);

        $data = [
            'dishes' => $dishes,
        ];
        return view('admin.dishes.index', $data);
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
        $user = auth()->user();
        $request->validate($this->getValidationRules());
        $form_data = $request->all();
        $new_dish = new Dish();
        $new_dish->user_id = $user->id;
        if(isset($form_data['dish_image'])) {
            $img_path = Storage::put('dish_image', $form_data['dish_image']);
            $form_data['dish_image'] = $img_path;
        }
        $new_dish->fill($form_data);
        $new_dish->slug = $this->slugControls($new_dish->name);

        $new_dish->save();

        Alert::success('Nuovo piatto creato!', 'Continua nella sezione I miei Piatti');

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
        $user = auth()->user();
        $dish = Dish::find($id);
        if($user->id === $dish->user_id){
            return view('admin.dishes.show',compact('dish',$dish));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $dish = Dish::findOrFail($id);
        
        if($user->id === $dish->user_id){
            return view('admin.dishes.edit', compact('dish', $dish));
        }else{
            abort(404);
        }
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
        $request->validate($this->getValidationRules());
        $form_data = $request->all();
        $dish_to_update = Dish::findOrFail($id);

        if (isset($form_data['is_visible'])) {
            $form_data['is_visible'] = false;
        }else {
            $form_data['is_visible'] = true;
        }

        if(isset($form_data['dish_image'])) {
            $img_path = Storage::put('dish_image', $form_data['dish_image']);
            $form_data['dish_image'] = $img_path;
        }
        $dish_to_update->fill($form_data);

        if($dish_to_update->name !== $form_data['name']) {
            $form_data['slug'] = $this->slugControls($form_data['name']);
        } else {
            $form_data['slug'] = $dish_to_update->slug;
        }

        $dish_to_update->update($form_data);

        Alert::success('Piatto modificato con successo!');

        return redirect()->route('admin.dishes.show', $dish_to_update->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish_to_destroy = Dish::findOrFail($id);
        if($dish_to_destroy->dish_image) {
            Storage::delete($dish_to_destroy->dish_image);
        }
        $dish_to_destroy->delete();

        Alert::success('Piatto Eliminato con successo!');

        return redirect()->route('admin.dishes.index');
    }
    

    protected function getValidationRules(){
        
        return [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'ingredients' => 'required',
            'price' => 'required|numeric',
            'dish_image' => 'nullable'
        ];
    }


    protected function slugControls($title){
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        $existing_slug_dish = Dish::where('slug','=', $slug_to_save)->first();
        $i = 1;
        while($existing_slug_dish){
            $slug_to_save = $slug_base . '-' . $i;

            $existing_slug_dish = Dish::where('slug', '=', $slug_to_save)->first();

            $i++;
        }
        return $slug_to_save;
    }
}
