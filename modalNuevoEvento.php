<!-- Modal para Registrar Nuevo Evento -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 15px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);">
      <div class="modal-header" style="background-color: #007bff; color: white; border-radius: 15px 15px 0 0;">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="NuevoEvento1.php" method="POST">
          <!-- Nombre del Evento -->
          <div class="mb-3">
            <label for="evento" class="form-label" style="font-weight: bold;">
              <i class="fa fa-calendar"></i> Nombre del Evento
            </label>
            <input type="text" id="evento" name="evento" class="form-control" placeholder="Ejemplo: Cita Psicopedagógica" required style="border-radius: 10px; border: 1px solid #ddd;">
          </div>

          <!-- Fecha de Inicio -->
          <div class="mb-3">
            <label for="fecha_inicio" class="form-label" style="font-weight: bold;">
              <i class="fa fa-clock-o"></i> Fecha de Inicio
            </label>
            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" required style="border-radius: 10px; border: 1px solid #ddd;">
          </div>

          <!-- Fecha de Fin -->
          <div class="mb-3">
            <label for="fecha_fin" class="form-label" style="font-weight: bold;">
              <i class="fa fa-clock-o"></i> Fecha de Fin
            </label>
            <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control" required style="border-radius: 10px; border: 1px solid #ddd;">
          </div>

          <!-- Color del Evento -->
          <div class="mb-3">
            <label for="color_evento" class="form-label" style="font-weight: bold;">
              <i class="fa fa-paint-brush"></i> Color del Evento
            </label>
            <input type="color" id="color_evento" name="color_evento" class="form-control form-control-color" value="#ff0000" title="Elige un color" style="height: 45px; width: 100%; border-radius: 10px;">
          </div>

          <!-- Observaciones -->
          <div class="mb-3">
            <label for="observaciones" class="form-label" style="font-weight: bold;">
              <i class="fa fa-comment"></i> Observaciones
            </label>
            <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Observaciones" style="border-radius: 10px; border: 1px solid #ddd;"></textarea>
          </div>

          <!-- Psicopedagogo -->
          <div class="mb-3">
            <label for="psicopedagogo" class="form-label" style="font-weight: bold;">
              <i class="fa fa-user"></i> Psicopedagogo
            </label>
            <input type="text" id="psicopedagogo" name="psicopedagogo" class="form-control" placeholder="Nombre del psicopedagogo" required style="border-radius: 10px; border: 1px solid #ddd;">
          </div>

         

          <!-- Estado -->
          <div class="mb-3">
            <label for="estado" class="form-label" style="font-weight: bold;">
              <i class="fa fa-check-circle"></i> Estado
            </label>
            <select id="estado" name="estado" class="form-control" required style="border-radius: 10px; border: 1px solid #ddd;">
              <option value="confirmada">Confirmada</option>
              <option value="cancelada">Cancelada</option>
              <option value="completada">Completada</option>
            </select>
          </div>

          <!-- Botones -->
          <div class="modal-footer" style="border-top: none;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 20px;">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-radius: 20px;">Guardar</button>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
