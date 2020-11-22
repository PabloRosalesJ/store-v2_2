<template>
  <div>
    <div class="card-body">
      <div v-if="errorToStored">
        <div class="ro">
          <div class="col-8"></div>
          <div class="col-4">
            <div
              class="alert alert-warning alert-dismissible fade show"
              role="alert"
            >
              <ul>
                <li v-for="error of errorToStored" :key="error.id">
                  {{ error }}
                </li>
              </ul>
              <button
                @click="errorToStored = ''"
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="dt-responsive table-responsive">
        <table
          id="footer-search"
          class="table table-hover table-striped table-bordered nowrap table-sm"
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
              v-for="(provider, index) of providersList"
              :key="provider.id"
            >
              <td class="m-0 p-0">{{ provider.provider_id }}</td>
              <td class="m-0 p-0">{{ provider.provider_name }}</td>
              <td class="m-0 p-0">{{ provider.person.name }}</td>
              <td class="m-0 p-0">{{ provider.person.phone }}</td>
              <td class="m-0 p-0" style="width: 50px">
                {{ provider.person.address }}
              </td>
              <td class="m-0 p-0">{{ provider.person.created_at }}</td>
              <td class="m-0 p-0">
                <button @click="edit(provider)" class="btn btn-sm btn-info">
                  Edit
                </button>
                <button
                  @click="remove(provider.provider_id, index)"
                  class="btn btn-sm btn-danger"
                >
                  Delete
                </button>
              </td>
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
                  <h5>Información del proveedor</h5>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="floating-label" for="provider_name"
                      >Nombre del proveedor</label
                    >
                    <input
                      v-model="provider.providerName"
                      type="text"
                      class="form-control"
                      id="provider_name"
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
                    <label class="floating-label" for="name">Nombre(s)</label>
                    <input
                      v-model="provider.name"
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
                      v-model="provider.l_name"
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
                      v-model="provider.s_name"
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
                      v-model="provider.address"
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
                      v-model="provider.phone"
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
                      v-model="provider.email"
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
      provider: {
        id: 0,
        providerName: "",
        name: null,
        l_name: null,
        s_name: null,
        address: null,
        phone: null,
        email: "",
      },
      showUpdate: false,
      errorToStored: "",
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
      this.providersList = [];
      axios
        .get(`/api/provider`)
        .then((result) => {
          this.providersList = result.data;
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Algo salió mal, no pude conectarme al servidor!",
            footer: "<h5>" + err.response.statusText + "</h5>",
          });
        });
    },
    edit(provider) {
      this.provider.id = provider.provider_id;
      this.provider.providerName = provider.provider_name;
      this.provider.name = provider.person.name;
      this.provider.l_name = provider.person.l_name;
      this.provider.s_name = provider.person.s_name;
      this.provider.address = provider.person.address;
      this.provider.phone = provider.person.phone;
      this.provider.email = provider.person.email;

      this.showUpdate = true;
      this.showModal();
    },
    remove(id, index) {
      // console.log(`/api/provider/${id}/destroy`);
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
            .delete(`/api/provider/${id}/destroy`)
            .then((result) => {
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Eliminado !",
                showConfirmButton: false,
                timer: 2500,
              });
              this.getProviders();
            })
            .catch((err) => {
              Swal.fire({
                position: "top-end",
                icon: "error",
                title: "No pude retirar el registro !",
                text: err.response.statusText,
                showConfirmButton: true,
              });
              console.log(err);
            });
        }
      });
    },
    onSubmit() {
      if (this.validate()) {
        // Store or update
        if (this.showUpdate) {
          this.toUpdate(this.provider);
        } else {
          this.toStore(this.provider);
        }

        this.hideModal();
      }
    },
    toStore(provider) {
      axios
        .post("api/provider", {
          name: provider.name,
          l_name: provider.l_name,
          s_name: provider.s_name,
          address: provider.address,
          phone: provider.phone,
          email: provider.email,
          provider_name: provider.providerName,
        })
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `He registrado a ${response.data[1].provider_name}`,
            showConfirmButton: false,
            timer: 2500,
          });

          this.clean();
          var table = $("#footer-search").DataTable();
          table.destroy();

          setTimeout(() => {
            this.getProviders();
          }, 1000);
        })
        .catch((error) => {
          this.errorToStored = error.response.data;
        });
    },
    toUpdate(provider) {
      axios
        .put(`api/provider/${this.provider.id}/update`, {
          id: provider.id,
          name: provider.name,
          l_name: provider.l_name,
          s_name: provider.s_name,
          address: provider.address,
          phone: provider.phone,
          email: provider.email,
          provider_name: provider.providerName,
        })
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `Acualicé los datos de: ${response.data[1].provider_name}`,
            showConfirmButton: false,
            timer: 2500,
          });

          this.clean();
          this.showUpdate = false;

          var table = $("#footer-search").DataTable();
          table.destroy();

          setTimeout(() => {
            this.getProviders();
          }, 1000);
        })
        .catch((error) => {
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: `No pude actualizar el registro.`,
            text: error.response.statusText,
            showConfirmButton: true,
          });
          this.errorToStored = error.response.data.errors;
        });

      this.showUpdate = false;
    },
    validate() {
      var validated = false;
      if (
        (this.provider.id !== "") &
        (this.provider.name !== "") &
        (this.provider.l_name !== "") &
        (this.provider.s_name !== "") &
        (this.provider.address !== "") &
        (this.provider.phone !== "")
      ) {
        validated = true;
      }
      return validated;
    },
    clean() {
      this.provider.name = "";
      this.provider.providerName = "";
      this.provider.l_name = "";
      this.provider.s_name = "";
      this.provider.address = "";
      this.provider.phone = "";
      this.provider.email = "";
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
        order: [],
      });
    },
  },
};
</script>

<style>
</style>