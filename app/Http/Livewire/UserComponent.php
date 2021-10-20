<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;

class UserComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];

    public 
    $search,
    $user_id,
    $name,
    $email,
    $image,
    $password,
    $password_confirmation
    ;

    public function render()
    {
        if (strlen($this->search) > 0) {
            $users = User::where('name','LIKE','%'.$this->search.'%')->orderBy('name')->paginate(5);
        }else{
            $users = User::orderBy('name')->paginate(5);
        }
        return view('livewire.user-component',['users' => $users]);
    }
    public function store()
    {
        $this->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed',
        ],[
            'name.required' => 'El nombre esobligatorio',
            'name.min' => 'El nombre debe contener por lo menos 3 caracteres',
            'name.max' => 'El nombre no debe ser mayor a 50 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'Este email ya se encuentra en nuestros registros',
            'email.email' => 'El email ingresado no cumple con el formato requerido',
            'password.required' => 'Debe crear un password para el usuario',
            'password.confirmed' => 'El password no coincide con la confirmación',
            'password.min' => 'Su password debe contener por lo menos 6 caracteres'
        ]);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);
        if(!empty($this->image)){
            $imageName = 'UserImage['.$user->id.'].png';
            $this->image->storeAs('user_images',$imageName);
            $user->image = $imageName;
            $user->save();
        }
        $this->emit('dissmisCreateUserModal');
        $this->emit('successNotification','Usuario creado');
        $this->default();
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image = $user->image;
        $this->emit('showEditUserModal');
    }

    public function update()
    {
        $user = User::find($this->user_id);
        $this->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'unique:users,email,'.$user->id
        ],[
            'name.required' => 'El nombre esobligatorio',
            'name.min' => 'El nombre debe contener por lo menos 3 caracteres',
            'name.max' => 'El nombre no debe ser mayor a 50 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'Este email ya se encuentra en nuestros registros',
            'email.email' => 'El email ingresado no cumple con el formato requerido',
        ]);
        
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();
        if(!empty($this->image)){
            $imageName = 'UserImage['.$user->id.'].png';
            $this->image->storeAs('user_images',$imageName);
            $user->image = $imageName;
            $user->save();
        }
        $this->emit('dissmisEditUserModal');
        $this->emit('successNotification','Usuario  actualizado');
        $this->default();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        \Storage::disk('public')->delete('/user_images/'.$user->image); 
        $user->delete();
        $this->emit('successNotification','Usuario  eliminado');
        $this->default();
    }

    public function default()
    {
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->image = null;
        $this->password = null;
        $this->password_confirmation = null;
    }
}
