require('./bootstrap');
require('./alertify')
window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('articulo-component', require('./components/ArticuloComponent.vue').default);

if(document.getElementById("app"))
{
    const app = new Vue({
        el: '#app',
    });
}
if(typeof livewire != 'undefined'){
Livewire.on('successNotification', text => { alertify.success(text); });
Livewire.on('errorNotification', text => { alertify.error(text);});
Livewire.on('dissmisCreateUserModal',() => $('#create_user_modal').modal('hide'));
Livewire.on('showEditUserModal',() => $('#edit_user_modal').modal());
Livewire.on('dissmisEditUserModal',() => $('#edit_user_modal').modal('hide'));
}

window.destroy = id => {
    alertify.confirm("",
            function() {
                Livewire.emit('destroy', id);
            },
            function() {})
        .set('labels', { ok: 'Si, eliminar!', cancel: 'Cancelar' })
        .set({ transition: 'flipx', title: 'Alto', message: 'Realmente desea eliminar el registro?' });
};