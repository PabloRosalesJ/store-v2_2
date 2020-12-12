<template>
  <div>
    <!-- Modal -->
    <div class="modal fade" id="income-details" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="income-detailsLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header m-1 p-1" v-if="Object.entries(incomeDetailsHeader).length !== 0">
            <table>
              <tr>
                <td><h5 class="modal-title" id="income-detailsLabel">Detalles del ingreso {{incomeDetailsHeader.number}} del {{incomeDetailsHeader.created_at}}</h5></td>
              </tr>
              <tr>
                <td><p>Generado por: {{incomeDetailsHeader.user.username}}, por un total de ${{incomeDetailsHeader.total}}.</p></td>
              </tr>
            </table>
            <button @click="loading.details = !loading.details"
              type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Table income details -->

        <div v-if="loading.details"
          class="col-12">
          <div class="row justify-content-center">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <div class="row justify-content-center">
            <p class="text-center">Cargando ...</p>
          </div>
        </div>

        <div v-else
          class="dt-responsive table-responsive">
            <table id="incomes-details-table" class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Nombre prod.</th>
                        <th>Desc. prod.</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr v-for="in_det of incomeDetails" :key="in_det.id">
                      <td> {{ in_det.product[0].name }} </td>
                      <td> {{ in_det.product[0].description }} </td>
                      <td class="text-center"> {{ in_det.quantity }} </td>
                      <td class="text-center"> ${{ in_det.price }} </td>
                      <td class="text-center"> ${{ in_det.sub_total }} </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Desc</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </tfoot>
            </table>
        </div>

            <!-- End table income details -->
          </div>
          <div class="modal-footer">
            <button @click="loading.details = !loading.details"
              type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->

    <div class="card">
      <div class="card-header p-2">
        <div class="row align-items-center m-l-0">
          <div class="col-sm-6">
            <h4>Ingresos a almacén</h4>
          </div>
          <div class="col-sm-6 text-right">
            <button
              class="btn btn-primary shadow rounded mx-3 my-0"
              type="button" data-toggle="collapse" data-target="#create-income" 
              aria-expanded="false" aria-controls="create-income"
            >
              <i class="feather icon-plus-circle"></i> Nuevo ingreso a almacén
            </button>
          </div>
        </div>
      </div>
      <!-- Create Income -->
      <div class="collapse" id="create-income">
        <div class="card card-body">
          <div class="row">
            <div class="col">
              <h4 class="text-center">Reabastecer</h4>
              <hr>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="card">
                <div class="card-body">
                <strong class="text-center">Producto:</strong>
                <hr>
                  <div v-if="product">
                    <table >
                      <tr>
                        <th>Nombre</th>
                        <td> {{ product.name }} </td>
                      </tr>
                      <tr>
                        <th>Desc</th>
                        <td> {{ product.description }} </td>
                      </tr>
                      <tr>
                        <th>Stock</th>
                        <td> {{ product.stock }} </td>
                      </tr>
                      <tr>
                        <th>Precio unit.</th>
                        <td> {{ product.unit_price }} </td>
                      </tr>
                      <tr>
                        <th>P.compra</th>
                        <td> {{ product.buy_price }} </td>
                      </tr>
                    </table>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img
                          :src="product.image === '/storage/' ? '/img/product/product-default.svg' : product.image"
                          class="d-block w-100"
                          alt="Product images"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-8">
              <div class="row">

                <div class="col-6">

                  <label for="prod_name">Nombre del producto</label>
                  <v-select
                    id="prod_name"
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

                <div class="col-3">

                  <div class="form-group">
                      <label class="floating-label" for="pz">Pz</label>
                      <input v-model="productSelected.quantity" 
                        type="text" class="form-control" id="pz" placeholder="Pz">
                  </div>
                  <br>
                  <strong>Subtotal: $ {{subtotal}}</strong>
                </div>
                  
                <div class="col-3">

                  <div class="form-group">
                      <label class="floating-label" for="price">Precio</label>
                      <input v-model="productSelected.price" 
                        type="text" class="form-control" id="price" placeholder="Precio">
                  </div>

                  <div class="form-group"> 
                    <button @click="addToCart()"
                      class="btn btn-outline-primary btn-block shadow-sm rounded">
                      Agergar
                    </button>
                  </div>
                
                </div>

              </div>
              <div class="row justify-content-center mt-3">
                <div v-if="product != null">
                  <div v-if="productSelected.price != product.buy_price"
                    class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Precios diferntes!</strong> Se actualizará el precio de compra de este producto.
                  </div>
                </div>
              </div>
              <div class="row mt-1">
                <div class="col-12">
                  <p class="text-center"><strong>Productos:</strong></p>
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>Prod. id</th>
                          <th>Nombre</th>
                          <th>Desc</th>
                          <th>Pz</th>
                          <th>Precio</th>
                          <th>Subtotal</th>
                          <th class="text-center"> <i class="feather icon-settings"></i> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(product, index) of cartView" :key="product.id">
                          <td> {{ product.id }} </td>
                          <td> {{ product.name }} </td>
                          <td> {{ product.description }} </td>
                          <td class="text-center"> {{ product.pz }} </td>
                          <td class="text-center"> ${{ product.price }} </td>
                          <td class="text-center"> ${{ product.sub_total }} </td>
                          <td>
                            <i @click="removeItem(index)"
                              title="Eliminar de la lista"
                              class="p-1 mr-2 feather icon-trash-2 btn btn-outline-danger btn-sm shadow-sm rounded"
                            ></i>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row" v-if="cart.length >= 1">
                <div class="col-8">
                  <button @click="store()"
                    class="btn btn-danger btn-block">
                    Finalizar
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
      <!-- End Create income -->
      <div class="card-body">

        <div v-if="loading.main"
          class="col-12">
          <div class="row justify-content-center">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <div class="row justify-content-center">
            <p class="text-center">Cargando ...</p>
          </div>
        </div>

        <div v-else
          class="dt-responsive table-responsive">
            <table id="incomes-table" class="table table-sm table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Number</th>
                        <th>Total</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-center"> <i class="feather icon-settings"></i> </th>
                    </tr>
                </thead>
                <tbody> 
                    <tr v-for="income of incomesList" :key="income.id"
                        :class="{'table-danger' : !income.state}">
                        <td>
                          <button @click="getIncomeDetails(income)"
                            type="button"
                            title="Detalles"
                            class="btn btn-sm btn-outline-primary m-1"
                            data-toggle="modal" data-target="#income-details"
                          > <!-- Button trigger modal -->
                            {{ income.id }}
                          </button>
                        </td>
                        <td>{{ income.number }}</td>
                        <td>${{ income.total }}</td>
                        <td>{{ income.user.username }}</td>
                        <td>{{ income.created_at }}</td>
                        <td class="text-center">
                          <span v-if="income.state" class="badge badge-primary">
                            <p hidden>{{ income.state }}</p>
                            <i title="activo" class="feather icon-thumbs-up"></i>
                          </span>
                          <span v-else class="badge badge-secondary">
                            <p hidden>{{ income.state }}</p>
                            <i title="desactivado" class="feather icon-thumbs-down"></i>
                          </span>
                        </td>
                        <td class="text-center">
                          <i v-if="income.state"
                            @click="disable(income.id, income.number)"
                            title="Cancelar ingreso"
                            class="p-1 mr-2 feather icon-trash-2 btn btn-outline-danger btn-sm shadow-sm rounded"
                          ></i>
                          <div v-else>
                            <p class="badge badge-danger">Cancelado el {{income.updated_at}}</p>
                          </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Number</th>
                        <th>Total</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-center"> <i class="feather icon-settings"></i> </th>
                    </tr>
                </tfoot>
            </table>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  name:'incomes',
  data(){
    return {
      incomesList : [],
      incomeDetailsHeader : {},
      incomeDetails : [],

      loading : {main:true, details:true},

      productList: [],
      product:null,
      productSelected:{
        product_id:null,
        quantity: 0,
        price:0,
        sub_total:0,
      },
      cart:[],
      cartView:[],
    }
  },
  components: {
    vSelect,
  },
  beforeMount(){
    this.getIncomes();
  },
  mounted(){
    this.activeTable()
  },
  methods:{
    getIncomes(){
      axios
        .get('/api/income')
        .then((result) => {
          this.incomesList = result.data
          this.loading.main = false
        }).catch((err) => {
          console.log(err.response);
        });
    },
    getIncomeDetails(income){
      this.incomeDetailsHeader = income
      axios
        .get(`api/income/${income.id}/show`)
        .then((result) => {
          this.incomeDetails = result.data
          this.loading.details = false
        }).catch((err) => {
          console.log(err.response)
        });
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
    getProduct(product) {
      this.product = product;
      this.productSelected.product_id = product.id 
      this.productSelected.price = product.buy_price
    },
    addToCart(){
      if(this.validate()){
        this.cart.push(this.productSelected)
        this.product.pz = this.productSelected.quantity
        this.product.price = this.productSelected.price 
        this.product.sub_total = this.productSelected.sub_total 
        this.cartView.push(this.product);
        this.product = null;
        this.productSelected = {
          product_id:null,
          quantity: 0,
          price:0,
          sub_total:0,
        }
      }
      return false
    },
    validate(){
      if( this.productSelected.quantity >= 1 && this.productSelected.price >= 1){
        return true
      }
      return false
    },
    removeItem(index){
      this.cart.splice(index, 1)
      this.cartView.splice(index, 1)
    },
    store(){
      Swal.fire({
        title: 'Finalizar ingreso?',
        text: "Asegúrese de que la información sea correcta.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Registrar!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Confirme con su password',
            input: 'password',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
              let data = new Object();
              data.password = login;
              data.total = this.total;
              data.products = this.cart;
              return fetch(`/api/income`,{
                  method: 'POST', // or 'PUT'
                  body: JSON.stringify(data), // data can be `string` or {object}!
                  headers:{
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                  }
              })
                .then(response => {
                  if (!response.ok) {
                    throw new Error(response.statusText)
                  }
                  return response.json()
                })
                .catch(error => {
                  Swal.showValidationMessage(
                    `Ooops, hubo un error: ${error}`
                  )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
          }).then((result) => {
            if (result.isConfirmed) {
              console.log(result.value)
              Swal.fire(
                'Éxito!',
                `Ingreso generado con la serie: ${result.value.number}`,
                'success'
              )
              this.getIncomes();
              this.cart = [];
              this.cartView = [];
              $("#create-income").collapse('toggle');
            }
          })
        }
      })
    },
    disable(id, number){
      
      Swal.fire({
        title: 'Estas seguro?',
        text: `Los productos relacionados al ingreso ${number} serán descontados del stock.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Confirme con su password',
            input: 'password',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
              return fetch(`/api/income/${id}/disable`,{
                  method: 'PUT', // or 'PUT'
                  body: JSON.stringify({'password':login}), // data can be `string` or {object}!
                  headers:{
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                  }
              })
                .then(response => {
                  if (!response.ok) {
                    throw new Error(response.statusText)
                  }
                  return response.json()
                })
                .catch(error => {
                  Swal.showValidationMessage(
                    `Ooops, hubo un error: ${error}`
                  )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
          }).then((result) => {
            if (result.isConfirmed) {
              console.log(result.value)
              Swal.fire(
                'Éxito!',
                `Ingreso con la serie: ${result.value.number} ha sido cancelado`,
                'success'
              )
              this.getIncomes();
            }
          })
        }
      })
    },
    activeTable() {
      setTimeout(() => {
        $("#incomes-table").DataTable({
          order: [],
        });
      }, 2500);
    },
  },
  computed:{
    subtotal(){
      let sub_total = this.productSelected.quantity * this.productSelected.price;
      this.productSelected.sub_total = sub_total;
      return sub_total;
    },
    products(){
      return this.cart.length
    },
    pices(){
      let pices = 0;
      for (let i = 0; i < this.cart.length; i++) {
        pices = Number(pices) + Number(this.cart[i].quantity);
      }
      return pices
    },
    total(){
      let total = 0
      this.cart.forEach(item=>{
        total += item.sub_total
      })
      return total
    }
  }
};
</script>

<style>
</style>