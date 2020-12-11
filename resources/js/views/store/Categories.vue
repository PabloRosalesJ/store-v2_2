<template>
  <div>
    <div class="card">

      <div class="card-header p-2">
        <div class="row align-items-center m-l-0">
          <div class="col-sm-6">
            <h4>Categorias</h4>
          </div>
          <div class="col-sm-6 text-right">
            <button @click="show()"
              class="btn btn-primary shadow rounded mx-3 my-0"
              type="button" data-toggle="collapse" 
              data-target="#create-category" 
              aria-expanded="false" 
              aria-controls="create-category"
            >
              <i class="feather icon-plus-circle"></i> Añadir nueva categoria
            </button>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="category-products" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="category-products">
                Productos relacioados a la categoria: {{products_rel.name}} | id: {{products_rel.id}}
                </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table class="table table-sm table-hover">
                  <thead>
                    <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Desc.</th>
                    <th>Precio</th>
                    <th>P. mayoreo</th>
                    <th>P. de compra</th>
                    <th>Stock</th>
                    <th>Provedor</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <td colspan="8" v-if="!this.products_rel_list.length>= 1">No hay productos para esta categoria</td>
                    <tr v-for="p in products_rel_list" :key="p.id">
                      <td class="align-middle m-0 p-0">
                        <router-link
                          :to="{ name: 'productDetails', params: { id: p.id } }"
                        >
                          <button @click="hideModal()"
                            title="Detalles"
                            class="btn btn-sm btn-outline-primary m-1"
                          >
                            {{ p.id }}
                          </button>
                        </router-link>
                      </td>
                      <td> {{ p.name }} </td>
                      <td> {{ p.description }} </td>
                      <td> ${{ p.unit_price }} </td>
                      <td> ${{ p.wholesale_price }} </td>
                      <td> ${{ p.buy_price }} </td>
                      <td> {{ p.stock }} pz. </td>
                      <td> {{ p.provider_id }} </td>
                      <td class="text-center">
                        <span v-if="p.status" class="badge badge-primary">
                          <p hidden>{{ p.status }}</p>
                          <i title="activo" class="feather icon-thumbs-up"></i>
                        </span>
                        <span v-else class="badge badge-secondary">
                          <p hidden>{{ p.status }}</p>
                          <i title="desactivado" class="feather icon-thumbs-down"></i>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
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
                <div class="col-12 alert alert-danger" v-if="errors.status">Error en los datos: {{errors.message}}</div>
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
                        data-toggle="modal" 
                        data-target="#category-products"
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

      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "Categories",
  components: {
  },
  data() {
    return {
      categories: [],
      products_rel: [],
      products_rel_list: [],
      showCreate: false,
      form:{
        name: '',
        description: ''
      },
      errors: {status:false, message:''}
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
    products(id) {
      axios
        .get(`api/category/${id}/show`)
        .then((result) => {
          this.products_rel = result.data
          this.products_rel_list = result.data.product
          console.log(this.products_rel_list.length);
        }).catch((err) => {
          console.log(err.response.data.message);
        });
    },
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
          var t = $("#categories-table").DataTable();
          t.destroy()
          this.getCategories();
          this.showCreate = !this.showCreate;
          this.errors.status = false
          this.errors.message = ''
          this.activeTable()
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `Registrado!`,
            showConfirmButton: false,
            timer: 1500,
          });
        }).catch((err) => {
          this.errors.status = true
          this.errors.message = err.response.data.message
        });
    },
    activeTable() {
      setTimeout(() => {
        $("#categories-table").DataTable({
          order: [],
        });
      }, 1500);
    },
    hideModal(){
      $('#category-products').modal('hide')
    }
  },
};
</script>

<style>
</style>