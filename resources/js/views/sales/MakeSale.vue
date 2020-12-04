<template>
  <div>
    <div class="card">
      <div class="card-header p-2">
        <div class="row align-items-center m-l-0">
          <div class="col-sm-6">
            <h4>Realizar venta</h4>
          </div>
          <div class="col-sm-6 text-right">
            <!-- <button
              class="btn btn-primary shadow rounded mx-3 my-0"
              data-toggle="modal"
              data-target="#modal-user"
            >
              <i class="feather icon-plus-circle"></i> Añadir un usuario
            </button> -->
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-3">
            <div class="card">
              <div class="card-body">
                <h6 class="text-center">Datos del Cliente</h6>

                <div v-if="clientOptions.edit">
                  Buscar cliente:
                  <v-select
                    @search="searchPerson"
                    :filterable="false"
                    label="name"
                    :options="peopleList"
                    placeholder="Buscar en clientes..."
                    @input="getPerson"
                  >
                    <template slot="option" slot-scope="peopleList">
                      <div class="d-center">
                        {{ peopleList.name }} {{ peopleList.l_name }}
                        {{ peopleList.s_name }}
                      </div>
                    </template>
                  </v-select>
                </div>

                <div class="mt-3" v-if="client">
                  <table>
                    <tr class="m-0 p-0">
                      <td>Nombre:</td>
                      {{
                        client.name
                      }}
                      <td></td>
                    </tr>
                    <tr class="m-0 p-0">
                      <td>Apellidos:</td>
                      {{
                        client.l_name
                      }}
                      {{
                        client.s_name
                      }}
                      <td></td>
                    </tr>
                    <tr class="m-0 p-0">
                      <td>Dirección:</td>
                      {{
                        client.address
                      }}
                      <td></td>
                    </tr>
                    <tr class="m-0 p-0">
                      <td>Teléfono:</td>
                      {{
                        client.phone
                      }}
                      <td></td>
                    </tr>
                  </table>

                  <hr />

                  <button
                    v-if="!clientOptions.go"
                    @click="SelectClient()"
                    class="mt-1 btn btn-sm btn-primary btn-block"
                  >
                    <i class="feather icon-user-check"></i>
                    Seleccionar
                  </button>
                  <button
                    v-else
                    @click="EditClient()"
                    class="mt-1 btn btn-sm btn-warning btn-block"
                  >
                    <i class="feather icon-user-x"></i>
                    Editar
                  </button>
                </div>

                <button v-if="cart.length >= 1"
                  @click="cancel()"
                  class="btn btn-sm btn-block btn-danger mt-3"> 
                    Cancelar venta <i class="feather icon-x-square"></i> 
                </button>
                
              </div>
            </div>
          </div>
          <div class="col-9">
            <h6 class="text-center">Seleccionar producto</h6>
            <hr>
            <div class="row" v-if="clientOptions.go">
              <div class="col-5">
                <p>Buscar Producto</p>
                <v-select
                  @search="searchProduct"
                  :filterable="false"
                  label="name"
                  :options="productList"
                  placeholder="Buscar en productos..."
                  @input="getProduct"
                >
                  <template slot="option" slot-scope="productList">
                    <div class="d-center">
                      {{ productList.name }} | ${{ productList.unit_price }}
                    </div>
                  </template>
                </v-select>

                <div class="row">
                  <div class="col-6">
                    <label for="bar_code">Código de barrars</label>
                    <v-select
                      id="bar_code"
                      @search="searchProductByBarCode"
                      :filterable="false"
                      label="name"
                      :options="productList"
                      placeholder="por código de barras..."
                      @input="getProduct"
                    >
                      <template slot="option" slot-scope="productList">
                        <div class="d-center">
                          {{ productList.name }} | ${{ productList.unit_price }}
                        </div>
                      </template>
                    </v-select>
                  </div>
                  <div class="col-6">
                    <label for="price">Precio</label>
                    <v-select
                      id="price"
                      @search="searchProductByPrice"
                      :filterable="false"
                      label="name"
                      :options="productList"
                      placeholder="por precio..."
                      @input="getProduct"
                    >
                      <template slot="option" slot-scope="productList">
                        <div class="d-center">
                          {{ productList.name }} | ${{ productList.unit_price }}
                        </div>
                      </template>
                    </v-select>
                  </div>
                </div>

                <div class="form-gropu" v-if="product">
                  <br>
                  <div class="row align-items-center">
                    <div class="col-5">
                      <input
                        v-model="picesSelected"
                        class="form-control form-control-sm"
                        type="number"
                        placeholder="pz"
                        :max="product.stock"
                      />
                    </div>
                    <div class="col-7">Total: ${{ ProductSelectTotal }}</div>
                  </div>
                  <br>
                  <div v-if="picesSelected > product.stock"
                   class="alert alert-sm alert-warning alert-dismissible fade show" role="alert">
                    <strong>No tenemos las piezas suficientes.</strong> Solo podemos vender {{product.stock}} pz
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <button v-if="picesSelected >= 1"
                    @click="addToCartView"
                    class="btn btn-info btn-sm btn-block">
                    Agregar al carrito
                  </button>
                </div>
              </div>

              <div class="col-4">
                <p class="text-center">Detalle del Producto</p>
                <div v-if="product">
                  <table class="m-0 p-0 text-sm table table-sm table-hover">
                    <tr class="m-0 p-0">
                      <td>Nombre</td>
                      <td>{{ product.name }}</td>
                    </tr>
                    <tr class="m-0 p-0">
                      <td>Precio</td>
                      <td>${{ product.unit_price }}</td>
                    </tr>
                    <tr class="m-0 p-0">
                      <td>BarCode</td>
                      <td>{{ product.bar_code }}</td>
                    </tr>
                    <tr class="m-0 p-0">
                      <td>Stock</td>
                      <td>{{ product.stock }}</td>
                    </tr>
                    <tr class="m-0 p-0">
                      <td>Descrip</td>
                      <td>{{ product.description }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <h6 class="text-center mt-1">Lista del carrito</h6>
            
            <div id="cart-sale" class="dataTables_wrapper dt-bootstrap4">
              <div class="table-responsive">
                <table class="table table-sm table-hover">
                  <thead class="thead-light">
                    <tr>
                      <td>Producto</td>
                      <td>Descripción</td>
                      <td>Precio</td>
                      <td>Pz</td>
                      <td>Subtotal</td>
                      <td>Retirar</td>
                    </tr>
                  </thead>
                  <tbody v-if="cart.length >= 1">
                    <tr v-for="(c, index) in cart" :key="c.id">
                      <td>{{c.name}}</td>
                      <td>{{c.description}}</td>
                      <td>{{c.unit_price}}</td>
                      <td>{{c.picesSelected}}</td>
                      <td>${{c.unit_price * c.picesSelected}}</td>
                      <td>
                        <i @click="removeItem(index)" class="feather icon-trash-2 m-1 p-1 btn btn-danger btn-sm"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <hr>
            <div class="row" v-if="cart.length >= 1">
            <!-- <div class="row"> -->
              <div class="col-8">
                <button @click="sale()"
                  class="btn btn-success btn-block">
                  Finalizar compra
                </button>
              </div>
              <div class="col-4">
                <table class="table table-sm">
                  <tr class="m-0 p-0">
                    <td class="m-0 p-0">Productos</td>
                    <td class="m-0 p-0"> {{products}} </td>
                  </tr>
                  <tr class="m-0 p-0">
                    <td class="m-0 p-0">Piezas</td>
                    <td class="m-0 p-0"> {{pices}} </td>
                  </tr>
                  <tr class="m-0 p-0">
                    <td class="m-0 p-0">Total</td>
                    <td class="m-0 p-0"> $ {{total}} </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  name: "MakeSale",
  data() {
    return {
      peopleList: [],
      client: null,
      clientOptions: { edit: true, go: false },
      productList: [],
      product: null,
      picesSelected: 1,
      productOptions: { edit: true, go: false },
      cart:[],
      _cart:[]
    };
  },
  components: {
    vSelect,
  },
  mounted: function () {
    // $("#navbar_app").addClass("navbar-collapsed");
  },
  methods: {
    searchPerson(search, loading) {
      loading(true);
      axios
        .get(`/api/person/search/${search}`)
        .then((result) => {
          q: search;
          this.peopleList = result.data;
          loading(false);
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    getPerson(person) {
      this.client = person;
      this.peopleList = null;
    },
    SelectClient() {
      this.clientOptions.edit = false;
      this.clientOptions.go = true;
      this.peopleList  = []

    },
    EditClient() {
      this.clientOptions.edit = true;
      this.clientOptions.go = false;
    },
    searchProduct(search, loading) {
      loading(true);
      axios
        .get(`/api/product/search?name=${search}`)
        .then((result) => {
          q: search;
          this.productList = result.data;
          loading(false);
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    searchProductByBarCode(search, loading) {
      loading(true);
      axios
        .get(`/api/product/search?bar_code=${search}`)
        .then((result) => {
          q: search;
          this.productList = result.data;
          loading(false);
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    searchProductByPrice(search, loading) {
      loading(true);
      axios
        .get(`/api/product/search?unit_price=${search}`)
        .then((result) => {
          q: search;
          this.productList = result.data;
          loading(false);
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    getProduct(product) {
      this.product = product;
    },
    addToCartView(){
      let _product = this.product;

      if (this.verifyCartBa(_product)) {
        if (this.picesSelected > this.product.stock) {
          _product.picesSelected = this.product.stock
        } else{
          _product.picesSelected = this.picesSelected;
        }
        this.cart.push(_product);
      }
      
      this.productList = []
      this.product = null
      this.picesSelected = 1
      
    },
    verifyCartBa(product){
      let flag = true
      this.cart.forEach(element => {
        if (element.id == product.id) {
          element.picesSelected ++
          flag = false;
        }
      });
      return flag;
    },
    removeItem(index){
      this.cart.splice(index, 1)
    },
    cancel(){
      this.cart = []
      this.client = null,
      this.peopleList = []
      this.product = null
      this.productList = []

      this.clientOptions.edit = !this.clientOptions.edit
      this.clientOptions.go = !this.clientOptions.go
    },
    sale(){
      Swal.fire({
        title: 'Finalizar venta?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Finalizar!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post('/api/sale', {
              cart: this.cart,
              client: this.client,
              total: this.total,
            })
            .then((result) => {
              Swal.fire(
                'Éxito!',
                'Venta finalizada con el folio: ' + result.data.serie,
                'success'
              )
              this.cancel();
              console.log(result.data);
            }).catch((err) => {
              Swal.fire(
                'Oops...',
                'Algo falló, intente nuevamente',
                'error'
              )
              console.log(err.response);
            });
        }
      })
    }
  },
  computed: {
    ProductSelectTotal() {
      if (this.picesSelected > this.product.stock) {
        return this.product.stock * this.product.unit_price;
      }
      return this.picesSelected * this.product.unit_price;
    },
    products(){
      return this.cart.length
    },
    pices(){
      let pices = 0;
      for (let i = 0; i < this.cart.length; i++) {
        pices = Number(pices) + Number(this.cart[i].picesSelected);
      }
      return pices
    },
    total(){
      let total = 0
      this.cart.forEach(item=>{
        total += item.unit_price * item.picesSelected
      })
      return total
    }
  },
};
</script>

<style>
</style>