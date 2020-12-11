<template>
  <div>
    <div class="collapse" id="create-category" v-if="showCreate">
      <div class="card card-body">
        <div class="row">
          <div class="col-4">
            <div class="form-group fill">
                <label class="floating-label" for="name_category">Nombre</label>
                <input type="text" class="form-control" id="name_category" placeholder="Nombre" v-model="form.name">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group fill">
                <label class="floating-label" for="desc_category">Descripción</label>
                <input type="text" class="form-control" id="desc_category" placeholder="Descripción" v-model="form.description">
            </div>
          </div>
          <div class="col-2">
            <button @click="save()"
              class="btn btn-primary" id="save-category">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="table table-responsive table-sm table-hover">
        <table id="categories-table" class="table mb-0">
          <thead class="thead-light">
            <tr>
              <th>id</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Creada el</th>
              <th>Status</th>
              <th class="text-center"><i class="feather icon-settings"></i></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item of categories" :key="item.id" class="m-0 p-0">
              <td class="align-middle m-0 p-0">
                <button
                  @click="products(item.id)"
                  title="Productos relacionados"
                  class="btn btn-sm btn-outline-primary m-1"
                >
                  {{ item.id }}
                </button>
              </td>
              <td class="align-middle m-0 p-0" v-text="item.name"></td>
              <td class="align-middle m-0 p-0" v-text="item.description"></td>
              <td class="align-middle m-0 p-0" v-text="item.created_at"></td>
              <td class="text-center">
                <span v-if="item.status" class="badge badge-primary">
                  <i title="activo" class="feather icon-thumbs-up"></i>
                </span>
                <span v-else class="badge badge-secondary">
                  <i title="desactivo" class="feather icon-thumbs-down"></i>
                </span>
              </td>
              <td class="table-action text-center">
                <i
                  v-if="!item.status"
                  @click="enable(item.id)"
                  title="Habilitar"
                  class="p-1 mr-2 feather icon-plus-circle btn btn-outline-success btn-sm shadow-sm rounded"
                ></i>
                <i
                  v-else
                  @click="disable(item.id)"
                  title="Desabilitar temporalmente"
                  class="p-1 mr-2 feather icon-minus-circle btn btn-outline-warning btn-sm shadow-sm rounded"
                ></i>
                <i
                  @click="remove(item.id)"
                  title="Eliminar"
                  class="p-1 mr-2 feather icon-trash-2 btn btn-outline-danger btn-sm shadow-sm rounded"
                ></i>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>id</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Creada el</th>
              <th>Status</th>
              <th class="text-center"><i class="feather icon-settings"></i></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CategoriesComponent",
  data() {
    return {
      categories: [],
      showCreate: false,
      form:{
        name: '',
        description: ''
      }
    };
  },
  beforeMount() {
    this.getCategories();
  },
  mounted() {
    this.activeTable();
  },
  methods: {
    getCategories() {
      //this.categories = [];
      axios
        .get("/api/category")
        .then((result) => {
          this.categories = result.data;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    products(id) {},
    enable(id) {
      axios
        .put(`/api/category/${id}/enable`)
        .then((result) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `hablilite: ${result.data.name}`,
            showConfirmButton: false,
            timer: 1500,
          });
          this.getCategories();
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    disable(id) {
      axios
        .put(`/api/category/${id}/disable`)
        .then((result) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `deshablilite: ${result.data.name}`,
            showConfirmButton: false,
            timer: 1500,
          });
          this.getCategories();
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    remove(id) {
      Swal.fire({
        title: "Eliminar el id "+id+"?",
        text:
          "Se eliminaran los productos realcionado a esta categoria, no se perderán registros pasados",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminala! <i class='feather icon-trash-2'></i>",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
          .delete(`/api/category/${id}/destroy`)
          .then((result) => {
            Swal.fire({ title: "Eliminado!", icon: "success" });
            this.getCategories()
          }).catch((err) => {
            console.log(err.response);
          });
        }
      });
    },
    show(){
      this.showCreate = !this.showCreate;
    },
    save(){
      axios
        .post('/api/category', this.form)
        .then((result) => {
          console.log(result);
          this.getCategories();
        }).catch((err) => {
          console.log(err.response);
        });
      // console.log(this.form);
      this.showCreate = !this.showCreate;
    },
    activeTable() {
      setTimeout(() => {
        $("#categories-table").DataTable({
          order: [],
        });
      }, 1500);
    },
  },
};
</script>

<style>
</style>