<template>
  <div>
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="row justify-content-between">
              <h5 class="col-3">Ventas realizadas</h5>
              <span class="col-2">Total: ${{ total_sum }}.00</span>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="compras-table" class="table table-sm table-hover">
                <thead>
                  <tr>
                    <th>Serie</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Operaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item of compras" 
                    :key="item.id" 
                    :class="{ 'table-danger': !item.status, '': item.status }"
                  >
                    <td>{{ item.serie }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>{{ item.people.name }} {{ item.people.l_name }}</td>
                    <td>${{ item.total }}</td>
                    <td class="text-center">
                      <div v-if="item.status">
                        <i
                          @click="disableSale(item.id)"
                          class="p-1 mr-2 feather icon-minus-circle btn btn-outline-danger btn-sm shadow-sm rounded"
                        ></i>
                        <i
                          @click="
                            getShoopDetails(item.id, item.total, item.serie)
                          "
                          class="p-1 mr-2 feather icon-external-link btn btn-outline-dark btn-sm shadow-sm rounded"
                        ></i>
                      </div>
                      <div v-else>
                        <span class="badge badge-danger"
                          >Cancelado el {{ item.updated_at }}</span
                        >
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="row">
              <!-- Data Export -->
              <div
                v-if="!load"
                class="shadow-sm mt-3 ml-3 p-1 mb-1 bg-white rounded"
              >
                <i
                  class="p-2 ml-2 btn btn-outline-success rounded fas fa-file-excel"
                  title="Excel"
                ></i>
                <!-- <a
                  :href="`${this.BASE_URL}/api/sale/${this.client_id}/client?export=pdf`"
                > -->
                <i
                  @click="getPDF()"
                  class="p-2 my-2 btn btn-outline-danger rounded fas fa-file-pdf"
                  title="PDF"
                ></i>
                <!-- </a> -->
              </div>
              <div v-else>
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
                Un segundo ...
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="showDetails" class="col-md-4">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-8">
                <h5>Detalles: {{ details.serie }}</h5>
              </div>
              <div class="col-1 text-center">
                <i
                  @click="closeDetails"
                  class="m-0 p-1 mr-auto feather icon-check-square btn btn-success btn-sm shadow-sm rounded"
                ></i>
              </div>
              <div class="col-1 text-center">
                <i
                  class="m-0 p-1 mr-auto feather icon-printer btn btn-secondary btn-sm shadow-sm rounded"
                ></i>
              </div>
            </div>
          </div>
          <ul class="list-group list-group-flush">
            <li
              v-for="item of details"
              :key="item.id"
              class="list-group-item py-0"
            >
              <div class="table-responsive">
                <table class="table table-borderless mb-0">
                  <tbody>
                    <tr>
                      <td>
                        <!-- http://store.test/img/admin_avatar.svg -->
                        <img
                          :src="BASE_URL + '/img/product/product-default.svg'"
                          alt="contact-img"
                          title="contact-img"
                          class="rounded mr-2"
                          height="48"
                        />
                        <p class="m-0 d-inline-block align-middle">
                          <a
                            href="product/"
                            class="text-body font-weight-semibold"
                            >{{ item.product[0].name }}</a
                          >
                          <br />
                          <small>{{ item.quantity }} x ${{ item.price }}</small>
                        </p>
                      </td>
                      <td class="text-right">${{ item.sub_total }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
          </ul>
          <div class="card-body py-2">
            <div class="table-responsive">
              <table
                class="table table-borderless mb-0 w-auto table-sm float-right text-right"
              >
                <tbody>
                  <tr>
                    <td>
                      <!-- <h6 class="m-0">Shipping:</h6> -->
                    </td>
                    <!-- <td>FREE</td> -->
                  </tr>
                  <tr class="border-top">
                    <td>
                      <h5 class="m-0">Total:</h5>
                    </td>
                    <td class="font-weight-semibold">${{ details.total }}</td>
                  </tr>
                </tbody>
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
  name: "ShoppingComponentInUser",
  data() {
    return {
      BASE_URL: process.env.MIX_APP_API_URL,
      compras: [],
      details: [],
      showDetails: false,
      total: 0,
      load: false,
    };
  },
  props: ["client_id"],
  mounted() {
    this.getShoops();
  },
  beforeMount() {
    setTimeout(() => {
      $("#compras-table").DataTable({
        order: [],
      });
    }, 3000);
  },
  methods: {
    getShoops() {
      this.compras = [];
      axios
        .get(`/api/sale/${this.client_id}/user`)
        .then((result) => {
          this.compras = result.data;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    getShoopDetails(id, total, serie) {
      this.details = [];
      axios
        .get(`/api/sale/${id}/details`)
        .then((result) => {
          this.details = result.data;
          this.details.total = total;
          this.details.serie = serie;
          this.showDetails = true;
        })
        .catch((err) => {
          //console.log(err.response);
        });
    },
    disableSale(id) {
      Swal.fire({
        title: "Ingrese su contraseña.",
        input: "password",
        inputAttributes: {
          autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonText: "Cancelar compra",
        cancelButtonText: "Cerrar",
        confirmButtonColor: "#d33",
        showLoaderOnConfirm: true,
        preConfirm: (data) => {
          axios
            .put(`/api/sale/${id}/disable`, {
              pw: data,
            })
            .then((result) => {
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Cancelado !",
                showConfirmButton: false,
                timer: 1500,
              });
              this.getShoops();
            })
            .catch((err) => {
              Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "Credenciales incorrectas",
                showConfirmButton: true,
              });
              //console.log(err.response);
            });
        },
      });
    },
    closeDetails() {
      this.showDetails = false;
      this.details = [];
    },
    getPDF() {
      this.load = true;
      //window.location.href = `${this.BASE_URL}/api/sale/${this.client_id}/client?export=pdf`;
      setTimeout(() => {
        this.load = false;
      }, 5000);
    },
  },
  computed: {
    total_sum() {
      this.compras.forEach((item) => {
        if (item.status === 1) {
          this.total += parseInt(item.total);
        }
      });
      return this.total;
    },
  },
};
</script>

<style>
</style>