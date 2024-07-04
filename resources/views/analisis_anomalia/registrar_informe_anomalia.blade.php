<button id="openModalBtn" onclick="addAnomalia()" class="custom-button btn btn-primary">Agregar</button>

            
            <h2>ID Data JSON:</h2>
    <p>{{ id_datajson }}</p>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
              
              
              function addAnomalia() {
                var idDataJson = "{{ id_datajson }}";
                var selectedRow = {{ selected_row | safe }};
                console.log(idDataJson)
                  Swal.fire({
                    
                      title: "Registrar Anomalía",
                      html: `
                          <style>
                              .swal2-popup {
                                  width: 80% !important;
                                  max-width: none !important;
                              }
                              .swal2-content {
                                  display: flex;
                                  flex-direction: column;
                                  align-items: flex-start;
                                  width: 100%;
                              }
                              .form-group {
                                  width: 100%;
                                  margin-bottom: 15px;
                              }
                              .form-group label {
                                  font-weight: bold;
                                  margin-bottom: 5px;
                                  display: block;
                              }
                              .form-group input, .form-group select, .form-group textarea {
                                  width: 100%;
                                  padding: 8px;
                                  border: 1px solid #ccc;
                                  border-radius: 4px;
                                  box-sizing: border-box;
                              }
                              .form-group textarea {
                                  resize: vertical;
                                  height: 100px;
                              }
                              .form-row {
                                  display: flex;
                                  flex-wrap: wrap;
                                  justify-content: space-between;
                              }
                              .form-column {
                                  flex: 1;
                                  margin-right: 10px;
                              }
                              .form-column:last-child {
                                  margin-right: 0;
                              }
                          </style>
                          <div class="form-row">
                              <div class="form-column">
                                  <div class="form-group">
                                      <label for="prioridadAnomalia">Prioridad de la Anomalía:</label>
                                      <select id="prioridadAnomalia" required>
                                        <option value="" disabled selected>Seleccione una opción</option>
                                        <option value="baja">Baja</option>
                                        <option value="media">Media</option>
                                        <option value="alta">Alta</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-column">
                                  <div class="form-group">
                                      <label for="estadoAnomalia">Estado de Anomalia:</label>
                                      <select id="estadoAnomalia" disabled>
                                        <option value="pendiente" selected>Pendiente</option>
                                        <option value="en_revision">En Revisión</option>
                                        <option value="resuelta">Resuelta</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="asunto">Asunto (*):</label>
                              <input id="asunto" type="text" placeholder="Asunto del Trámite" required>
                          </div>
                          <div class="form-group">
                              <label for="contenidoSolicitud">Respetuosamente expongo: (*):</label>
                              <textarea id="contenidoSolicitud" placeholder="Contenido de solicitud"></textarea>
                          </div>
                      `,
                      showCancelButton: true,
                      confirmButtonText: "Registrar",
                      cancelButtonText: "Cancelar",
                      preConfirm: () => {
                        
                          const prioridadAnomalia = document.getElementById("prioridadAnomalia").value;
                          const estadoAnomalia = document.getElementById("estadoAnomalia").value;
                          const asunto = document.getElementById("asunto").value;
                          const contenidoSolicitud = document.getElementById("contenidoSolicitud").value;

                          var selectedRow = {{ selected_row | safe }};
                          var allData = {{ all_data | safe }};

                          function arraysEqual(arr1, arr2) {
                            if (arr1.length !== arr2.length) return false;
                            for (let i = 0; i < arr1.length; i++) {
                                if (String(arr1[i]).trim() !== String(arr2[i]).trim()) return false;
                            }
                            return true;
                          }

                          // Buscar el índice de la fila seleccionada en allData.data
                          let rowIndex = -1;
                          for (let i = 0; i < allData.data.length; i++) {
                              if (arraysEqual(allData.data[i], selectedRow)) {
                                  rowIndex = i;
                                  break;
                              }
                          }

                          // Mostrar el índice de la fila en la consola
                          if (rowIndex !== -1) {
                              console.log("Row Index:", rowIndex);

                              // Modificar la fila en el índice encontrado
                              allData.data[rowIndex][16] = 9;

                              // Mostrar el objeto allData modificado en la consola
                              console.log("Modified All Data:", allData);
                          } else {
                              console.error("Selected Row not found in All Data.");
                          }
            
                          return {
                              prioridadAnomalia,
                              estadoAnomalia,
                              asunto,
                              contenidoSolicitud,
                              idDataJson,
                              selectedRow,
                              allData,
                              rowIndex
                          };
                      },
                  }).then((result) => {
                      if (result.isConfirmed) {
                          const tramiteData = result.value;
                          fetch("/api/registrar_tramite", {
                              method: "POST",
                              headers: {
                                  "Content-Type": "application/json",
                              },
                              body: JSON.stringify(tramiteData),
                          })
                          .then((response) => response.json())
                          .then((data) => {
                              Swal.fire("¡Registro exitoso!", data.mensaje, "success");
                              // Actualiza la tabla o realiza las acciones necesarias con la respuesta
                          })
                          .catch((error) => {
                              Swal.fire("¡Error!", error.message, "error");
                          });
                      }
                  });
              }
            </script>

