<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">Lista de artículos vue</h1>
                <hr />
                <button
                    class="btn btn-primary float-right"
                    data-toggle="modal"
                    data-target="#create_modal"
                >
                    Nuevo
                </button>
                <br />
                <br />
                <hr />
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Stock</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in articulos" :key="item.id">
                            <td scope="row">{{ item.id }}</td>
                            <td>{{ item.nombre }}</td>
                            <td>{{ item.descripcion }}</td>
                            <td>{{ item.stock }}</td>
                            <td>
                                <button
                                    v-on:click="edit(item)"
                                    class="btn btn-warning"
                                    data-toggle="modal"
                                    data-target="#edit_modal"
                                >
                                    Editar
                                </button>
                            </td>
                            <td>
                                <button
                                    v-on:click="destroy(item.id)"
                                    class="btn btn-danger"
                                >
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--Create Modal -->
        <div
            class="modal fade"
            id="create_modal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Nuevo artículo
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input
                                    v-model="articulo.nombre"
                                    type="text"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea
                                    v-model="articulo.descripcion"
                                    class="form-control"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input
                                    v-model="articulo.stock"
                                    type="number"
                                    class="form-control"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cancelar
                        </button>
                        <button
                            v-on:click="store()"
                            type="button"
                            class="btn btn-primary"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--Edit Modal -->
        <div
            class="modal fade"
            id="edit_modal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Editar artículo
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input
                                    v-model="articulo.nombre"
                                    type="text"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea
                                    v-model="articulo.descripcion"
                                    class="form-control"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input
                                    v-model="articulo.stock"
                                    type="number"
                                    class="form-control"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cancelar
                        </button>
                        <button
                            v-on:click="update()"
                            type="button"
                            class="btn btn-primary"
                        >
                            Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            articulos: [],
            articulo: {
                id: 0,
                nombre: "",
                descripcion: "",
                stock: 0
            }
        };
    },
    mounted: () => {
        console.log("Component mounted.");
    },
    created: function() {
        this.index();
    },
    methods: {
        async index() {
            const res = await axios.get("/articulo");
            this.articulos = res.data;
        },
        async store() {
            const res = await axios.post("/articulo", this.articulo);
            if (res.data.id > 0) {
                alertify.success("Registro almacenado");
                $("#create_modal").modal("hide");
                this.index();
                this.default();
            }
        },
        edit(item) {
            this.articulo.id = item.id;
            this.articulo.nombre = item.nombre;
            this.articulo.descripcion = item.descripcion;
            this.articulo.stock = item.stock;
        },
        async update() {
            const res = await axios.put(
                "/articulo/" + this.articulo.id,
                this.articulo
            );
            if (res.data.id > 0) {
                alertify.success("Registro actualizado");
                $("#edit_modal").modal("hide");
                this.index();
                this.default();
            }
        },
        destroy(id) {
            const self = this;
            alertify
                .confirm(
                    "",
                    async function() {
                        const res = await axios.delete("/articulo/" + id);
                        console.log("Registro eliminado");
                        self.index();
                    },
                    function() {}
                )
                .set("labels", { ok: "Si, eliminar!", cancel: "Cancelar" })
                .set({
                    transition: "flipx",
                    title: "Alto",
                    message: "Realmente desea eliminar el registro?"
                });
        },
        default() {
            this.articulo.id = 0;
            this.articulo.nombre = "";
            this.articulo.descripcion = "";
            this.articulo.stock = 0;
        }
    }
};
</script>
