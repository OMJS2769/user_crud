require('./bootstrap');

Livewire.on('successNotification', text => { alertify.success(text); });
Livewire.on('errorNotification', text => { alertify.error(text);});
Livewire.on('dissmisCreateUserModal',() => $('#create_user_modal').modal('hide'));
Livewire.on('showEditUserModal',() => $('#edit_user_modal').modal());
Livewire.on('dissmisEditUserModal',() => $('#edit_user_modal').modal('hide'));

window.destroy = id => {
    alertify.confirm("",
            function() {
                Livewire.emit('destroy', id);
            },
            function() {})
        .set('labels', { ok: 'Si, eliminar!', cancel: 'Cancelar' })
        .set({ transition: 'flipx', title: 'Alto', message: 'Realmente desea eliminar el registro?' });
};