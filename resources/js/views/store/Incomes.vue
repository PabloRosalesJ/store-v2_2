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
            <table id="incomes-details-table" class="table table-sm table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Desc</th>
                        <th>Cantidad</th>
                        <th>Pz</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr v-for="in_det of incomeDetails" :key="in_det.id">
                      <td> {{ in_det.product[0].name }} </td>
                      <td> {{ in_det.product[0].description }} </td>
                      <td> {{ in_det.quantity }} </td>
                      <td> {{ in_det.price }} </td>
                      <td> {{ in_det.sub_total }} </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Desc</th>
                        <th>Cantidad</th>
                        <th>Pz</th>
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

                <div class="col-3">

                  <label for="prod_name">Código de barrars</label>
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
                  <label for="pz">Cantidad</label>
                  <input v-model="productSelected.quantity"
                    type="number" name="pz" id="pz">
                </div>

                <div class="col-3">
                  <label for="price">Precio</label>
                  <input v-model="productSelected.price"
                    type="number" name="price" id="price">
                .</div>

                <div class="col-3">
                  Subtotal: $ {{subtotal}}
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
                    <tr v-for="income of incomesList" :key="income.id">
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
                          <i
                            @click="disable(income.id)"
                            title="Cancelar ingreso"
                            class="p-1 mr-2 feather icon-trash-2 btn btn-outline-danger btn-sm shadow-sm rounded"
                          ></i>
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

      cart:[],

      productList: [],
      product:null,
      productSelected:{
        product_id:null,
        quantity: 0,
        price:0,
        sub_total:0,
      }
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
    },
    disable(id){
      console.log(id);
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
    }
  }
};
</script>

<style>
</style>