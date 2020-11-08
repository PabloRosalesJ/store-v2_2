<template>
  <div>
    <div
      v-if="errorToStored"
      class="alert alert-danger alert-dismissible fade show"
      role="alert"
    >
      <strong>No se pudo almacenar el registro, debido a:</strong>
      <ul>
        <li v-for="error of errorToStored" :key="error.id">
          {{ error }}
        </li>
      </ul>
      <button
        type="button"
        class="close"
        data-dismiss="alert"
        aria-label="Close"
      >
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div id="basic-btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
      <div class="table-responsive">
        <table
          id="clients-table"
          class="table table-bordered table-striped table-sm m-0 p-0"
        >
          <thead>
            <tr>
              <th>Id</th>
              <!-- <th>Avatar</th> -->
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Telefono</th>
              <th class="text-center"><i class="fas fa-cash-register"></i></th>
              <th>Desde</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(client, index) of clients" :key="client.id">
              <td>
                <router-link
                  :to="{ name: 'client', params: { id: client.id } }"
                >
                  <span class="btn btn-outline-primary btn-sm text-sm m-0 p-1">
                    {{ client.id }}
                  </span>
                </router-link>
              </td>
              <td>{{ client.name }} {{ client.l_name }}</td>
              <td v-text="client.address"></td>
              <td v-text="client.phone"></td>
              <td class="text-center">
                <div v-if="!client.can_buy_credit">
                  <span class="badge badge-light-danger">
                    <i class="fas fa-sad-cry"></i>
                  </span>
                </div>
                <div v-else>
                  <span class="badge badge-light-primary">
                    <i class="fas fa-laugh-squint"></i>
                  </span>
                </div>
              </td>
              <td v-text="client.created_at"></td>
              <td>
                <button class="btn btn-info btn-sm" @click="edit(client)">
                  Edit
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="remove(client.id, index)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="modal-client"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myExtraLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cliente</h5>
            <button
              @click="clean"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form v-on:submit.prevent="onSubmit">
              <div class="row">
                <div class="col-12">
                  <h5>Información personal</h5>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="floating-label" for="Name">Nombre(s)</label>
                    <input
                      v-model="client.name"
                      type="text"
                      class="form-control"
                      id="name"
                      placeholder=""
                      required
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group fill">
                    <label class="floating-label" for="l_name"
                      >Apellido paterno</label
                    >
                    <input
                      v-model="client.l_name"
                      type="text"
                      class="form-control"
                      id="l_name"
                      placeholder=""
                      required
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group fill">
                    <label class="floating-label" for="s_name"
                      >Apellido materno</label
                    >
                    <input
                      v-model="client.s_name"
                      type="text"
                      class="form-control"
                      id="s_name"
                      placeholder=""
                      required
                    />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="floating-label" for="address"
                      >Dirección</label
                    >
                    <textarea
                      v-model="client.address"
                      class="form-control"
                      id="address"
                      rows="3"
                      required
                    ></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <h5>Información adicional</h5>
                </div>
                <div class="col-sm-4">
                  <div class="form-group fill">
                    <label class="floating-label" for="phone">Teléfono</label>
                    <input
                      v-model="client.phone"
                      type="text"
                      class="form-control"
                      id="phone"
                      placeholder=""
                      required
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group fill">
                    <label class="floating-label" for="email">e-mail</label>
                    <input
                      v-model="client.email"
                      type="text"
                      class="form-control"
                      id="email"
                      placeholder=""
                    />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group fill">
                    <input
                      type="file"
                      class="form-control"
                      id="avatar"
                      placeholder=""
                      accept="image/x-png,image/gif,image/jpeg"
                    />
                  </div>
                </div>
              </div>
              <div class="row align-items-center">
                <div class="col-sm-12">
                  <button class="btn btn-primary shadow rounded">
                    <span class="pcoded-micon">
                      <i class="feather icon-save"></i>
                    </span>
                    Guardar
                  </button>
                  <span class="btn btn-danger shadow rounded" @click="clean">
                    <span class="pcoded-micon">
                      <i class="feather icon-delete"></i>
                    </span>
                    Limpiar
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal END -->
  </div>
</template>

<script>
export default {
  name: "ClientsComponent",
  data() {
    return {
      clients: [],
      client: {
        id: 0,
        name: null,
        l_name: null,
        s_name: null,
        address: null,
        phone: null,
        email: "",
      },
      errorToStored: null,
      showUpdate: false,
      tableTime: 50,
    };
  },
  mounted() {
    this.getClients();
  },
  beforeMount() {},
  methods: {
    getClients() {
      //this.clients = [];
      axios
        .get("api/person")
        .then((response) => {
          this.clients = response.data;

          setTimeout(function () {
            $("#clients-table").DataTable({
              order: [[0, "desc"]],
            });
          }, this.tableTime);
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "No pudimos conectarnos con el servidor...",
            footer: `${error.response.data.message} - <i class='feather icon-globe'></i>`,
          });
        });
    },
    edit(client) {
      this.client.id = client.id;
      this.client.name = client.name;
      this.client.l_name = client.l_name;
      this.client.s_name = client.s_name;
      this.client.address = client.address;
      this.client.phone = client.phone;
      this.client.email = client.email;

      this.showUpdate = true;
      this.showModal();
    },
    remove(id, index) {
      Swal.fire({
        title: "Esta seguro ?",
        text: "Esta acción no se podrá revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#6cb2eb",
        cancelButtonColor: "#e3342f",
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`api/person/${id}/destroy`)
            .then((response) => {
              Swal.fire({
                icon: "success",
                text: "Registro eliminado !",
              });
              this.clients.splice(index, 1);
            })
            .catch((e) => {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ocurrió un error y no pudimos eliminar el registro",
              });
            });
        }
      });
    },
    onSubmit() {
      if (this.validate()) {
        // Store or update
        if (this.showUpdate) {
          this.toUpdate(this.client);
        } else {
          this.toStore(this.client);
        }

        this.hideModal();

        setTimeout(() => {
          this.getClients();
        }, 1000);
      }
    },
    toStore(data) {
      axios
        .post("/api/person", {
          name: data.name,
          l_name: data.l_name,
          s_name: data.s_name,
          address: data.address,
          phone: data.phone,
          email: data.email,
        })
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `He registrado a ${response.data.name}`,
            showConfirmButton: false,
            timer: 2500,
          });
          this.clean();
        })
        .catch((error) => {
          this.errorToStored = error.response.data;
        });
    },
    toUpdate(data) {
      axios
        .put(`/api/person/${data.id}/update`, {
          id: data.id,
          name: data.name,
          l_name: data.l_name,
          s_name: data.s_name,
          address: data.address,
          phone: data.phone,
          email: data.email,
        })
        .then((response) => {
          //console.log(response);
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `Acualicé los datos de: ${response.data.name}`,
            showConfirmButton: false,
            timer: 2500,
          });

          this.clean();
          this.showUpdate = false;

          var table = $("#clients-table").DataTable();
          table.destroy();
        })
        .catch((error) => {
          this.errorToStored = error.response.data;
        });

      this.showUpdate = false;
    },
    validate() {
      var validated = false;
      if (
        (this.client.id !== "") &
        (this.client.name !== "") &
        (this.client.l_name !== "") &
        (this.client.s_name !== "") &
        (this.client.address !== "") &
        (this.client.phone !== "")
      ) {
        validated = true;
      }
      return validated;
    },
    clean() {
      this.client.name = "";
      this.client.l_name = "";
      this.client.s_name = "";
      this.client.address = "";
      this.client.phone = "";
      this.client.email = "na@mail.com";
      this.showUpdate = false;
    },
    showModal() {
      $("#modal-client").modal("show");
    },
    hideModal() {
      $("#modal-client").modal("hide");
    },
  },
};
</script>

<style></style>
