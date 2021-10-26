
<h3>CRUD USUARIOS</h3>
<a href="javascript:void(0)" onclick ="$('#create_user_modal').modal();" class="btn btn-primary" style="float:right">Agregar nuevo</a>
<br>
{{ $users->links('pagination-links') }}
<br>
<input wire:model ="search" type="text" class="form-control" placeholder="Buscar">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Email</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>
                @if($user->image == 'perfil.png')
                <img src="{{ asset('img/'.$user->image) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                @else
                <img src="{{ asset('storage/user_images/'.$user->image) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                @endif
            </td>
            <td>
            <a href="{{ route('show_user',md5($user->id).'somewere'.$user->id.'somewere'.md5($user->id)) }}">{{ $user->name }}</a></td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="javascript:void(0)" wire:click = "edit({{ $user->id }})" class ="btn btn-warning">Editar</a>
            </td>
            <td>
            <a href="javascript:void(0)" onclick ="destroy({{ $user->id }})" class ="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach
        @if(count($users) <= 0)
        <tr>
            <td colspan="5" class ="text-center">Sin registros</td>
        </tr>
        @endif
    </tbody>
</table>