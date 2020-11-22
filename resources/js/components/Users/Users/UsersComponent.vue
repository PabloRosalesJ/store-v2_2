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
          id="users-table"
          class="table table-hover table-bordered nowrap table-sm"
        >
          <thead>
            <tr>
              <th>id</th>
              <th>User Name</th>
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
              v-for="(user, index) of userList"
              :key="user.id"
            >
              <td class="m-0 p-0 text-center">
                <button
                  @click="goToShops(user.id)"
                  class="btn btn-outline-primary btn-sm m-1 p-1"
                >
                  {{ user.id }}
                </button>
              </td>
              <td class="m-0 p-0">{{ user.username }}</td>
              <td class="m-0 p-0">{{ user.person.name }}</td>
              <td class="m-0 p-0">{{ user.person.phone }}</td>
              <td class="m-0 p-0">{{ user.person.address }}</td>
              <td class="m-1 p-1">{{ user.person.created_at }}</td>
              <td class="m-0 p-0">
                <button @click="edit(user)" class="btn btn-sm btn-info">
                  Edit
                </button>
                <button
                  @click="remove(user.id, index)"
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
              <th>User Name</th>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Desde</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="modal-user"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myExtraLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Usuario</h5>
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
                  <h5>Información de sesion</h5>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="floating-label" for="user_name"
                      >Username</label
                    >
                    <input
                      v-model="user.userName"
                      type="text"
                      class="form-control"
                      id="user_name"
                      placeholder="Será tu usario para iniciar sesión"
                      required
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="floating-label" for="user_password"
                      >Password</label
                    >
                    <input
                      v-model="user.password"
                      type="password"
                      class="form-control"
                      id="user_password"
                      placeholder="Deja en blanco si no va a actualizar"
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label
                      class="floating-label"
                      for="user_password_confirmation"
                      >Confirma tu password</label
                    >
                    <input
                      v-model="user.password_confirmation"
                      type="password"
                      class="form-control"
                      id="user_password_confirmation"
                      placeholder="Deja en blanco si no va a actualizar"
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
                      v-model="user.name"
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
                      v-model="user.l_name"
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
                      v-model="user.s_name"
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
                      v-model="user.address"
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
                      v-model="user.phone"
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
                      v-model="user.email"
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
  name: "UserComponent",
  data() {
    return {
      userList: [],
      user: {
        id: 0,
        userName: "",
        password: null,
        password_confirmation: null,
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
      this.userList = [];
      axios
        .get(`/api/user`)
        .then((result) => {
          this.userList = result.data;
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
    edit(user) {
      this.user.id = user.id;
      this.user.userName = user.username;
      this.user.name = user.person.name;
      this.user.l_name = user.person.l_name;
      this.user.s_name = user.person.s_name;
      this.user.address = user.person.address;
      this.user.phone = user.person.phone;
      this.user.email = user.person.email;

      this.showUpdate = true;
      this.showModal();
    },
    remove(id, index) {
      // console.log(`/api/user/${id}/destroy`);
      Swal.fire({
        title: `Eliminar el id ${id}?`,
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
            .delete(`/api/user/${id}/destroy`)
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
          this.toUpdate(this.user);
        } else {
          this.toStore(this.user);
        }

        this.hideModal();
      }
    },
    toStore(user) {
      axios
        .post("api/user", {
          id: user.id,
          username: user.userName,
          password: user.password,
          password_confirmation: user.password_confirmation,
          name: user.name,
          l_name: user.l_name,
          s_name: user.s_name,
          address: user.address,
          phone: user.phone,
          email: user.email,
        })
        .then((response) => {
          console.log(response.data);
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `He registrado a ${response.data}`,
            showConfirmButton: false,
            timer: 2500,
          });

          this.clean();
          var table = $("#users-table").DataTable();
          table.destroy();

          setTimeout(() => {
            this.getProviders();
          }, 1000);
        })
        .catch((error) => {
          this.errorToStored = error.response.data;
        });
    },
    toUpdate(user) {
      axios
        .put(`api/user/${this.user.id}/update`, {
          id: user.id,
          username: user.userName,
          password: user.password,
          password_confirmation: user.password_confirmation,
          name: user.name,
          l_name: user.l_name,
          s_name: user.s_name,
          address: user.address,
          phone: user.phone,
          email: user.email,
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

          var table = $("#users-table").DataTable();
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
    goToShops(user_id) {
      this.$router.push({ name: "usersShops", params: { id: user_id } });

      // this.$router.push({ name: "usersShops", id: user_id });
    },
    validate() {
      var validated = false;
      if (
        (this.user.id !== "") &
        (this.user.name !== "") &
        (this.user.l_name !== "") &
        (this.user.s_name !== "") &
        (this.user.address !== "") &
        (this.user.phone !== "")
      ) {
        validated = true;
      }
      return validated;
    },
    clean() {
      this.user.name = "";
      this.user.userName = "";
      this.user.l_name = "";
      this.user.s_name = "";
      this.user.address = "";
      this.user.phone = "";
      this.user.email = "";
      this.showUpdate = false;
    },
    showModal() {
      $("#modal-user").modal("show");
    },
    hideModal() {
      $("#modal-user").modal("hide");
    },
    prepareTable() {
      var table = $("#users-table").DataTable({
        order: [],
      });
    },
  },
};
</script>

<style>
</style>