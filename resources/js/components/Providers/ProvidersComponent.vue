<template>
  <div>
    <div class="card-body">
      <div class="dt-responsive table-responsive">
        <table
          id="footer-search"
          class="table table-striped table-bordered nowrap table-sm"
        >
          <thead>
            <tr>
              <th>id</th>
              <th>Provedor</th>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Desde</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="m-0 p-0"
              v-for="provider of providersList"
              :key="provider.id"
            >
              <th class="m-0 p-0">{{ provider.provider_id }}</th>
              <th class="m-0 p-0">{{ provider.provider_name }}</th>
              <th class="m-0 p-0">{{ provider.person.name }}</th>
              <th class="m-0 p-0">{{ provider.person.phone }}</th>
              <th class="m-0 p-0" style="width: 50px">
                {{ provider.person.address }}
              </th>
              <th class="m-0 p-0">{{ provider.person.created_at }}</th>
              <th class="m-0 p-0">
                <button class="btn btn-sm btn-info">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
              </th>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>id</th>
              <th>Provedor</th>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Desde</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="modal-provider"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myExtraLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Provedor</h5>
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
                  <h5>Información adicional</h5>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="floating-label" for="Name"
                      >Nombre del provedor</label
                    >
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
                <div class="col-12">
                  <h5>Información de contacto</h5>
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
  name: "ProviderComponent",
  data() {
    return {
      providersList: [],
      client: {
        id: 0,
        name: null,
        l_name: null,
        s_name: null,
        address: null,
        phone: null,
        email: "",
      },
    };
  },
  mounted() {
    this.getProviders();
  },
  beforeMount() {
    setTimeout(() => {
      this.prepareTable();
    }, 2500);
  },
  methods: {
    getProviders() {
      axios
        .get(`/api/provider`)
        .then((result) => {
          this.providersList = result.data;
        })
        .catch((err) => {});
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
      this.client.email = "";
      this.showUpdate = false;
    },
    showModal() {
      $("#modal-provider").modal("show");
    },
    hideModal() {
      $("#modal-provider").modal("hide");
    },
    prepareTable() {
      var table = $("#footer-search").DataTable({
        order: [[0, "desc"]],
      });
    },
  },
};
</script>

<style>
</style>