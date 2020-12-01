<template>
  <div>
    <div class="card">
      <div class="card-header p-2">
        <div class="row align-items-center m-l-0">
          <div class="col-sm-6">
            <h4>Realizar Venta</h4>
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
                      {{ productList.name }} ${{ productList.unit_price }}
                    </div>
                  </template>
                </v-select>

                <div class="form-gropu" v-if="product">
                  <br>
                  <div class="row align-items-center">
                    <div class="col-5">
                      <input
                        v-model="picesSelected"
                        class="form-control form-control-sm"
                        type="text"
                        placeholder="pz"
                      />
                    </div>
                    <div class="col-7">Total: ${{ ProductSelectTotal }}</div>
                  </div>
                  <br>
                  <button v-if="picesSelected >= 1"
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
            <hr>
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
    },
    EditClient() {
      this.clientOptions.edit = true;
      this.clientOptions.go = false;
      this.peopleList = [];
      this.productList = [];
    },
    searchProduct(search, loading) {
      loading(true);
      axios
        .get(`/api/product/search/${search}`)
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
  },
  computed: {
    ProductSelectTotal() {
      return this.picesSelected * this.product.unit_price;
    },
  },
};
</script>

<style>
</style>