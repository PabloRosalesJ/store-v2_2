<template>
  <div>
    <!-- Modal list history-->
    <div class="modal-dialog modal-dialog-scrollable">
      <div
        class="modal fade"
        id="modal-history"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="modal-historyLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-historyLabel" v-if="client != null">
                Historial de pagos: {{ client.name }} {{ client.l_name }} {{ client.s_name }}
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5> Total recibido: ${{ totalPayments }} </h5>
              <table class="table table-sm table-hover">
                <tr>
                  <th>Pago id</th>
                  <th>Usuario</th>
                  <th>Monto</th>
                  <th>Fecha</th>
                </tr>
                <tbody>
                  <tr v-for="p in paymentsClientList" :key="p.id">
                    <td>{{ p.id }}</td>
                    <td>{{ p.user.username }}</td>
                    <td>${{ p.amount }}</td>
                    <td>{{ p.created_at }}</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Pago id</th>
                    <th>Usuario</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-primary"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->
    <div class="card">
      <div class="card-header p-2">
        <div class="row align-items-center m-l-0">
          <div class="col-sm-6">
            <h4>Pagos recibidos</h4>
          </div>
          <div class="col-sm-6 text-right">
            <button
              class="btn btn-primary shadow rounded mx-3 my-0"
              type="button"
              data-toggle="collapse"
              data-target="#make-payment"
              aria-expanded="false"
              aria-controls="make-payment"
            >
              <i class="feather icon-plus-circle"></i> Registrar nuevo pago
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!-- Create Income -->
        <div class="collapse" id="make-payment">
          <div class="card card-body">
            <div class="row justify-content-around">
              <div class="col-5">
                <div class="card">
                  <div class="bard-body">
                    <h6 class="text-center mt-2">Cliente</h6>
                    <div class="container">
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
                      <div class="col-12 text-truncate mt-3" v-if="client">
                        <table class="table table-sm">
                          <tr class="m-0 p-0">
                            <td>Nombre:</td>
                            <td>{{ client.name }}</td>
                          </tr>
                          <tr class="m-0 p-0">
                            <td>Apellidos:</td>
                            <td>{{ client.l_name }} {{ client.s_name }}</td>
                          </tr>
                          <tr class="m-0 p-0">
                            <td>Dirección:</td>
                            <td>{{ client.address }}</td>
                          </tr>
                          <tr class="m-0 p-0">
                            <td>Teléfono:</td>
                            <td>{{ client.phone }}</td>
                          </tr>
                        </table>
                        <button v-if="!showData" @click="select()"
                          class="btn btn-info btn-sm btn-block redounded mb-3">
                          Seleccionar
                        </button>
                        <button v-if="showData"
                          type="button"
                          class="btn btn-primary btn-block btn-sm mb-3 redounded"
                          data-toggle="modal"
                          data-target="#modal-history"
                        >
                          Ver historial
                        </button>
                        <button v-if="showData" @click="client = null; showData = false"
                          class="btn btn-info btn-sm btn-block redounded mb-3">
                          Editar
                        </button>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <h6 class="text-center mt-2">Monto</h6>
                <hr />
                <div class="row" v-if="client">
                  <div class="form-inline">
                    <div class="form-group mx-sm-3 mb-2">
                      $ &nbsp &nbsp
                      <input v-model="payment.amount"
                        type="text"
                        class="form-control"
                        id="amount"
                        placeholder="Monto a registrar"
                      />
                    </div>
                    <button class="btn btn-primary mb-2">
                      Registrar
                    </button>
                    <table v-if="showData"
                      class="table table-sm mt-3">
                      <tr class="m-0 p-0">
                        <td>Último pago:</td>
                        <td> ${{ paymentsClientList[0].amount }}, del {{ paymentsClientList[0].created_at }} </td>
                      </tr>
                      <tr class="m-0 p-0">
                        <td>Saldo anterior:</td>
                        <!-- <td> ${{ before_ }} </td> -->
                      </tr>
                      <tr class="m-0 p-0">
                        <td>Saldo actual:</td>
                        <!-- <td> ${{ before_ - payment.amount}} </td> -->
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Create income -->

        <div v-if="loading" class="col-12">
          <div class="row justify-content-center">
            <div
              class="spinner-border"
              style="width: 3rem; height: 3rem"
              role="status"
            >
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <div class="row justify-content-center">
            <p class="text-center">Cargando ...</p>
          </div>
        </div>
        <div class="table-responsive" v-else>
          <table class="table table-sm table-hover" id="payments-table">
            <thead>
              <tr>
                <th>id Pago</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Cantidad</th>
                <th>Fecha de recepción</th>
                <th class="text-center">
                  <i class="feather icon-trash-2"></i>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="payment in paymentsList" :key="payment.id">
                <td>{{ payment.id }}</td>
                <td>
                  {{ payment.client.name }} {{ payment.client.l_name }}
                  {{ payment.client.s_name }}
                </td>
                <td>{{ payment.user.username }}</td>
                <td>${{ payment.amount }}</td>
                <td>{{ payment.created_at }}</td>
                <td class="text-center">
                  <button class="btn btn-danger btn-sm">
                    <i class="feather icon-trash-2"></i>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>id Pago</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Cantidad</th>
                <th>Fecha de recepción</th>
                <th class="text-center">
                  <i class="feather icon-trash-2"></i>
                </th>
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
  name: "Payments",
  components: { vSelect },
  data() {
    return {
      paymentsList: [],
      paymentsClientList: [],
      payment: {
        client_id:null,
        amount:0
      },
      loading: true,
      peopleList: [],
      client: null,
      showData:false
    };
  },
  beforeMount() {
    this.getIPayments();
  },
  mounted() {
    this.activeTable();
  },
  methods: {
    getIPayments() {
      axios
        .get("/api/payment")
        .then((result) => {
          this.paymentsList = result.data;
          this.loading = false;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
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
      this.peopleList = [];
    },
    activeTable() {
      setTimeout(() => {
        $("#payments-table").DataTable({
          order: [],
        });
      }, 2500);
    },
    getPaymentsByClient(id) {
      axios
        .get(`/api/payment/${id}/client`)
        .then((result) => {
          this.paymentsClientList = result.data;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    select(){
      this.getPaymentsByClient(this.client.id);
      this.showData = true
    },
  },
  computed:{
    totalPayments(){
      let saldo = 0
      this.paymentsClientList.forEach(item => {
        saldo += item.amount
      });
      return saldo;
    }
  }
};
</script>

<style>
</style>
