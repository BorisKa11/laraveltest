<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class SectionsController extends Controller
{
    private $model;
    private $user;

    public function __construct(Section $section, User $user)
    {
        $this->model = $section;
        $this->user = $user;
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = $this->model->paginate(4);
        
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = $this->model->find($id);
    
        if (!$section)
            return redirect('/')->with('error', 'Отдел с ID = ' . $id . ' не найден');
        
        $users = $this->user->all();
        
        return view('sections.form', compact('section', 'users'));
    }

    /**
     * Update or create the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        // валидация
        $validationFields = [
            'name' => 'required|min:5',
            'description' => 'nullable|min:20',
            'logo' => 'nullable|mimes:jpeg,jpg,png,gif|max:5120'
        ];

        $messages = [
            'name.required' => 'Необходимо указать название',
            'name.min' => 'Для названия минимум 5 символов',
            'description.min' => 'Для описания минимум 20 символов',
            'logo.mimes' => 'Формат файла jpeg, jpg, png или gif',
            'logo.max' => 'Максимальный размер изображения 5Мб'
        ];
        $this->validate($request, $validationFields, $messages);
        
        if ($request->id != 0)
            $section = $this->model->find($request->id);
        else
            $section = $this->model->make();
        
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imagename = $section->id . '.' . $image->getClientOriginalExtension();
            
            Storage::disk('public')->putFileAs(
                '', $request->file('logo'), $imagename
            );
            
            $section->logo = $imagename;
        }
        
        $section->name = $request->name;
        $section->description = $request->description;
        $section->save();
        
        if ($request->has('users')) {
            $section->users()->detach();
            
            foreach ($request->users as $user) {
                $userModel = $this->user->find($user);
                $section->users()->save($userModel);
            }
//            $section->users()->sync($request->get('users'));
        }
            
        return redirect('/sections')->with('success', 'Данные по отделу "' . $section->name . '" сохранёны');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = $this->model->find($id);
        if (!$section)
            return redirect('/sections')->with('error', 'Отдел с ID = ' . $id . ' не найден');
        
        Storage::disk('public')->delete($section->logo);
        
        $section->delete();
        
        return redirect('/sections')->with('success', 'Отдел удалён');
    }
}
