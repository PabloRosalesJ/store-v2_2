<template>
  <div>
    <div class="card">
      <div class="card-header p-2">
        <div class="row align-items-center m-l-0">
          <div class="col-sm-6">
            <h4>Productos</h4>
          </div>
          <div class="col-sm-6 text-right">
            <button @click="show()"
              class="btn btn-primary shadow rounded mx-3 my-0"
              type="button" data-toggle="collapse" 
              data-target="#create-category" 
              aria-expanded="false" 
              aria-controls="create-category"
            >
              <i class="feather icon-plus-circle"></i> Añadir nuevo producto
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
      <div v-if="errors.show"
        class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ errors.message }}</strong> 
        <pre> {{ errors.errors }} </pre>
      </div>
        <div class="collapse" id="create-category" v-if="showCreateProduct">
            <div class="card card-body">
              <form @submit.prevent="onSubmit" enctype="multipart/form-data">
                <div class="row">
                  <h6 class="text-center">Datos</h6>
                  <hr>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group fill">
                        <label class="floating-label" for="name_category">Nombre</label>
                        <input v-model="product.name_category"
                          type="text" class="form-control" id="name_category" placeholder="Nombre">
                    </div>
                  </div>
                  <div class="col-5">
                    <div class="form-group fill">
                        <label class="floating-label" for="desc_category">Descripción</label>
                        <input v-model="product.desc_category" 
                          type="text" class="form-control" id="desc_category" placeholder="Descripción">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group fill">
                        <label class="floating-label" for="image">Imagen</label>
                        <input v-on:change="handleFileUpload()"
                          type="file" class="form-control" id="image" 
                          ref="file" accept="image/x-png,image/gif,image/jpeg" />
                    </div>
                  </div>
              </div>
              <div class="row">
                <h6 class="text-center">Stock</h6>
                <hr>
              </div>
              <div class="row justify-content-around">
                
                <div class="col-3">
                  <div class="form-group fill">
                      <label class="floating-label" for="category_id">Proveedor</label>
                      <select v-model="product.provider_id"
                        class="form-control" id="provider_id">
                          <option :value="p.provider_id" v-for="p in providers" :key="p.id">{{p.provider_name}}</option>
                      </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group fill">
                      <label class="floating-label" for="category_id">Categoria</label>
                      <select v-model="product.category_id"
                        class="form-control" id="category_id">
                          <option :value="c.id" v-for="c in categories" :key="c.id">{{c.name}}</option>
                      </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group fill">
                      <label class="floating-label" for="bar_code">Cod. Barras</label>
                      <input v-model="product.bar_code" 
                        type="text" class="form-control" id="bar_code" placeholder="En blanco para generar auto">
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group fill">
                      <label class="floating-label" for="stock">Stock inical</label>
                      <input v-model="product.stock"
                        type="number" class="form-control" id="stock" placeholder="pz" value="0">
                  </div>
                </div>
              </div>
              <div class="row">
                <h6 class="text-center">Precios</h6>
                <hr>
              </div>
              <div class="row justify-content-around">
                <div class="col-3">
                  <div class="form-group fill">
                      <label class="floating-label" for="unit_price">P. unitario</label>
                      <input v-model="product.unit_price" 
                        type="number" class="form-control" id="unit_price" value="0">
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group fill">
                      <label class="floating-label" for="wholesale_price">P. mayoreo</label>
                      <input v-model="product.wholesale_price"
                        type="number" class="form-control" id="wholesale_price" value="0">
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group fill">
                      <label class="floating-label" for="buy_price">P. de compra</label>
                      <input v-model="product.buy_price"
                        type="number" class="form-control" id="buy_price" value="0">
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                      <div class="switch switch-primary d-inline m-r-10">
                          <input v-model="product.status"
                            type="checkbox" id="status" checked>
                          <label for="status" class="cr"></label>
                      </div>
                      <label>Status: {{ product.status ? 'Activo' : 'Inactivo' }} </label>
                    </div>
                </div>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-block">Guardar Producto</button>
              </div>
              </form>
            </div>
          </div>
        <!-- <ProductsComponent :product="saved"></ProductsComponent> -->
          <div class="row justify-content-center">
            <div class="table table-responsive table-sm table-hover">
              <table id="products-table" class="table mb-0">
                <thead class="thead-light">
                  <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>BarCode</th>
                    <th>Precio</th>
                    <th>P. mayoreo</th>
                    <th>P. de compra</th>
                    <th>Stock</th>
                    <th>Creado el</th>
                    <th>Status</th>
                    <th class="text-center"><i class="feather icon-settings"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item of products" :key="item.id" class="m-0 p-0">
                    <td class="align-middle m-0 p-0">
                      <router-link
                        :to="{ name: 'productDetails', params: { id: item.id } }"
                      >
                        <button
                          title="Detalles"
                          class="btn btn-sm btn-outline-primary m-1"
                        >
                          {{ item.id }}
                        </button>
                      </router-link>
                    </td>
                    <td class="align-middle m-0 p-0">
                      <p class="m-0 p-0">
                        <strong> {{ item.name }} </strong>
                      </p>
                      <small>{{ item.description }}</small>
                    </td>
                    <td class="align-middle m-0 p-0">{{ item.bar_code }}</td>
                    <td
                      class="align-middle m-0 p-0 text-center"
                      v-text="'$' + item.unit_price"
                    ></td>
                    <td
                      class="align-middle m-0 p-0 text-center"
                      v-text="'$' + item.wholesale_price"
                    ></td>
                    <td
                      class="align-middle m-0 p-0 text-center"
                      v-text="'$' + item.buy_price"
                    ></td>
                    <td class="align-middle m-0 p-0" v-text="item.stock + ' pz'"></td>
                    <td class="align-middle m-0 p-0" v-text="item.created_at"></td>
                    <td class="text-center">
                      <span v-if="item.status" class="badge badge-primary">
                        <p hidden>{{ item.status }}</p>
                        <i title="activo" class="feather icon-thumbs-up"></i>
                      </span>
                      <span v-else class="badge badge-secondary">
                        <p hidden>{{ item.status }}</p>
                        <i title="desactivado" class="feather icon-thumbs-down"></i>
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
                    <th>BarCode</th>
                    <th>Precio</th>
                    <th>P. mayoreo</th>
                    <th>P. de compra</th>
                    <th>Stock</th>
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
</template>

<script>
import ProductsComponent from "../../components/Store/Products/ProductsComponent";

export default {
  name: "Products",
  components: {
    ProductsComponent,
  },
  data(){
    return {
      showCreateProduct : false,
      errors : {status:null, message:''},
      products: [],
      product: {category_id: '', provider_id: '', bar_code: '', name_category: '', desc_category: '', image: '', 
            buy_price: '', unit_price: '', wholesale_price: '', stock: '', status:true},
      categories : [],
      providers : [],
      errors: {message:'', errors:'', show:false},
    }
  },
  beforeMount() {
    this.getProducts();
  },
  mounted() {
    this.getCategories()
    this.getProviders()
    this.activeTable();
  },
  methods:{
    show(){
      this.showCreateProduct = !this.showCreateProduct;
    },
    getCategories(){
      axios
      .get('/api/category')
      .then((result) => {
        this.categories = result.data
      }).catch((err) => {
        console.error(err.response.message);
      });
    },
    getProviders(){
      axios
      .get('/api/provider')
      .then((result) => {
        this.providers = result.data
      }).catch((err) => {
        console.error(err.response.message);
      });
    },
    handleFileUpload(){
      this.product.image = this.$refs.file.files[0];
    },
    onSubmit(){
      const config = { headers: { 'content-type': 'multipart/form-data' } }

      let formdata = new FormData();
      formdata.append('category_id', this.product.category_id)
      formdata.append('provider_id', this.product.provider_id)
      formdata.append('bar_code', this.product.bar_code)
      formdata.append('name', this.product.name_category)
      formdata.append('desc_category', this.product.desc_category)
      formdata.append('image', this.product.image)
      formdata.append('buy_price', this.product.buy_price)
      formdata.append('unit_price', this.product.unit_price)
      formdata.append('wholesale_price', this.product.wholesale_price)
      formdata.append('stock', this.product.stock)
      formdata.append('status', this.product.status)

      axios
        .post( '/api/product', formdata, config)
        .then((result) => {
          this.clearForm();
          this.getProducts();
          this.showCreateProduct = false;
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `Producto registrado`,
            showConfirmButton: false,
            timer: 1500,
          });
        }).catch((err) => {
          this.errors.message = err.response.data.message
          this.errors.errors = err.response.data.errors
          this.errors.show = true
        });
    },
    getProducts() {
      axios
        .get("/api/product")
        .then((result) => {
          this.products = result.data;
          $("#navbar_app").addClass("navbar-collapsed");
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    enable(id) {
      axios
        .put(`/api/product/${id}/enable`)
        .then((result) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `hablilite: ${result.data.name}`,
            showConfirmButton: false,
            timer: 1500,
          });
          this.getProducts();
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    disable(id) {
      axios
        .put(`/api/product/${id}/disable`)
        .then((result) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `deshablilite: ${result.data.name}`,
            showConfirmButton: false,
            timer: 1500,
          });
          this.getProducts();
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    remove(id) {
      Swal.fire({
        title: "Eliminar el id " + id + "?",
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
            .delete(`/api/product/${id}/destroy`)
            .then((result) => {
              this.getProducts();
              Swal.fire({ title: "Eliminado!", icon: "success" });
            })
            .catch((err) => {
              console.log(err.response);
            });
        }
      });
    },
    clearForm(){
      this.product = {category_id: '', provider_id: '', bar_code: '', name_category: '', desc_category: '', image: '', 
            buy_price: '', unit_price: '', wholesale_price: '', stock: '', status:true}
    },
    cleanErrors(){
      this.errors.message = err.response.data.message
      this.errors.errors = err.response.data.errors
      this.errors.show = false
    },
    activeTable() {
      setTimeout(() => {
        $("#products-table").DataTable({
          order: [],
        });
      }, 2500);
    },
  }
};
</script>

<style>
</style>