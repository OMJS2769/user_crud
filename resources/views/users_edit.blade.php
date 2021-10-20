<div wire:ignore.self class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container form">
            <div class="row">
                <div class="col-md 12">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input wire:model="name" type="text" class="form-control">
                        @error('name') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md 12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input wire:model="email" type="text" class="form-control">
                        @error('email') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md 12">
                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input wire:model="image" type="file" class="form-control">
                        @error('image') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" wire:click = "update" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>