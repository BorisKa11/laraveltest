<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\User;

class UserController extends Controller
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->model->paginate(10);
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.form');
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
        $user = $this->model->find($id);
        
        if (!$user)
            return redirect('/users')->with('error', 'Пользователь с ID = ' . $id . ' не найден');
        
        return view('users.form', compact('user'));
    }

    /**
     * Update or create the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        // валидация
        $validationFields = [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'required|min:6|regex:/[\w\-]+/'
        ];

        $messages = [
            'name.required' => 'Необходимо указать имя',
            'name.min' => 'Для имени минимум 5 символов',
            'email.required' => 'Необходимо ввести email-адрес',
            'email.unique' => 'Данный email уже используется',
            'email.email' => 'Неверный формат email',
            'password.min' => 'Пароль должен быть длиннее 5 символов',
            'password.required' => 'Необходимо указать пароль',
            'password.regex' => 'Пароль должен содержать символы латинского алфавита, цифры 0-9, или знак тире'
        ];
        $this->validate($request, $validationFields, $messages);
        
        if ($request->id != 0)
            $user = $this->model->find($request->id);
        else
            $user = $this->model->make();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        
        return redirect('/users')->with('success', 'Пользователь ' . $user->name . ' сохранён');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->model->find($id);
        if (!$user)
            return redirect('/users')->with('error', 'Пользователь с ID = ' . $id . ' не найден');
        
        $user->delete();
        
        return redirect('/users')->with('success', 'Пользователь удалён');
    }
}
