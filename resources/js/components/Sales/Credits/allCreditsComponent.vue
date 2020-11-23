<template>
  <div>
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="row justify-content-between">
              <h5 class="col-3">Ventas realizadas</h5>
              <div class="col-2">
                <div v-if="load_page" class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                <div v-else>
                  <span>Total: ${{ total_sum }}.00</span>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div v-if="load_page" class="d-flex justify-content-center">
              <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>
            <div v-else class="table-responsive">
              <table id="creditos-table" class="table table-sm table-hover">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Fecha</th>
                    <th>Movimiento</th>
                    <th>Total</th>
                    <th>Operaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="item of creditos"
                    :key="item.id"
                    :class="{ 'table-danger': !item.status, '': item.status }"
                  >
                    <td>{{ item.id }}</td>
                    <td>{{ item.created_at }}</td>
                    <td v-if="item.person && item.user">
                      <div class="row">
                        <table>
                          <tr>
                            <td>Vendedor:</td>
                            <td>{{ item.user.username }}</td>
                          </tr>
                          <tr>
                            <td>Cliente:</td>
                            <td>
                              {{ item.person.name }} {{ item.person.l_name }}
                            </td>
                          </tr>
                        </table>
                      </div>
                    </td>
                    <td v-else>
                      <span class="text-danger">
                        <!-- {{ item.user }} -->
                        existe inconsistencia en los datos
                      </span>
                    </td>
                    <td>${{ item.total }}</td>
                    <td class="text-center">
                      <div v-if="item.status">
                        <i
                          @click="disableSale(item.id)"
                          class="p-1 mr-2 feather icon-minus-circle btn btn-outline-danger btn-sm shadow-sm rounded"
                        ></i>
                        <i
                          @click="
                            getCreditDetails(
                              item.id,
                              item.total,
                              item.created_at
                            )
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
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Fecha</th>
                    <th>Movimiento</th>
                    <th>Total</th>
                    <th>Operaciones</th>
                  </tr>
                </tfoot>
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
                <h5>Crédito del {{ creditDetails.created_at }}</h5>
              </div>
              <div class="col-1">
                <i
                  @click="hideCredits"
                  class="p-1 mr-2 mr-auto feather icon-check-square btn btn-success btn-sm shadow-sm rounded"
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
              v-for="credit of creditDetails"
              :key="credit.id"
              class="list-group-item py-0"
            >
              <div class="table-responsive">
                <table class="table table-borderless mb-0">
                  <tbody>
                    <tr>
                      <td>
                        <img
                          src="/img/product/product-default.svg"
                          alt="contact-img"
                          title="contact-img"
                          class="rounded mr-2"
                          height="48"
                        />
                        <p class="m-0 d-inline-block align-middle">
                          <a href="#" class="text-body font-weight-semibold">
                            {{ credit.product.name }}
                          </a>
                          <br />
                          <small>{{ credit.pices }} x ${{ credit.cost }}</small>
                        </p>
                      </td>
                      <td class="text-right">${{ credit.sub_total }}</td>
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
                  <tr class="border-top">
                    <td>
                      <h5 class="m-0">Total:</h5>
                    </td>
                    <td class="font-weight-semibold">
                      ${{ creditDetails.total }}
                    </td>
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
      creditos: [],
      creditDetails: [],
      showDetails: false,
      total: 0,
      load: false,
      load_page: true,
    };
  },
  props: ["client_id"],
  beforeMount() {
    this.getCredits();
  },
  mounted() {
    this.activateTable();
  },
  methods: {
    getCredits() {
      this.creditos = [];
      axios
        .get(`/api/credit`)
        .then((result) => {
          this.creditos = result.data;
          $("#navbar_app").addClass("navbar-collapsed");
          this.load_page = false;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    getCreditDetails(credit_id, total, created_at) {
      axios
        .get(`/api/credit/${credit_id}/single`)
        .then((result) => {
          this.creditDetails = result.data;
          this.creditDetails.total = total;
          this.creditDetails.created_at = created_at;
          this.showDetails = true;
          document.documentElement.scrollTop = 0;
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
    hideCredits() {
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
    activateTable() {
      setTimeout(() => {
        // $("#navbar_app").addClass("navbar-collapsed");
        $("#creditos-table").DataTable({
          order: [],
        });
        // this.load_page = false;
      }, 3000);
    },
  },
  computed: {
    total_sum() {
      this.creditos.forEach((item) => {
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