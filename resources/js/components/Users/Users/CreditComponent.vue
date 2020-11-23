<template>
  <div>
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="row justify-content-between">
              <h5 class="col-3">Créditos</h5>
              <span class="col-2">Total: ${{ total_sum }}.00</span>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                id="credit-table"
                class="table table-striped table-sm mb-0 dataTable no-footer"
              >
                <thead class="text-center">
                  <tr role="row">
                    <th>id</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Take</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="credit of credits"
                    :key="credit.id"
                    :class="{
                      'table-danger': !credit.status,
                      '': credit.status,
                    }"
                  >
                    <td v-text="credit.id"></td>
                    <td v-if="item.person">
                      {{ item.person.name }} {{ item.person.l_name }}
                    </td>
                    <td v-else>
                      <span class="text-danger"
                        >existe inconsistencia en los datos</span
                      >
                    </td>
                    <td>${{ credit.total }}</td>
                    <td v-text="credit.created_at"></td>
                    <td v-text="credit.take"></td>
                    <td class="text-center">
                      <div v-if="credit.status">
                        <i
                          @click="disableCredit(credit.id)"
                          class="p-1 mr-2 feather icon-minus-circle btn btn-outline-danger btn-sm shadow-sm rounded"
                        ></i>
                        <i
                          @click="
                            getCreditDetails(
                              credit.id,
                              credit.total,
                              credit.created_at
                            )
                          "
                          class="p-1 mr-2 feather icon-external-link btn btn-outline-dark btn-sm shadow-sm rounded"
                        ></i>
                      </div>
                      <div v-else>
                        <span class="badge badge-danger"
                          >Cancelado el {{ credit.updated_at }}</span
                        >
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
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
                  @click="hideDetails"
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
  name: "CreditComponentInUser",
  data() {
    return {
      credits: [],
      creditDetails: [],
      showDetails: false,
      total: 0,
    };
  },
  props: ["user_id"],
  mounted() {
    this.getCredits();
  },
  beforeMount() {
    setTimeout(() => {
      $("#credit-table").DataTable({
        order: [],
      });
    }, 3000);
  },
  methods: {
    getCredits() {
      this.credits = [];
      axios
        .get(`/api/credit/${this.user_id}/user`)
        .then((result) => {
          this.credits = result.data;
        })
        .catch((err) => {
          //console.log(err.response);
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
        })
        .catch((err) => {
          //console.log(err.response);
        });
    },
    hideDetails() {
      this.showDetails = false;
    },
    disableCredit(id) {
      Swal.fire({
        title: "Ingrese su contraseña.",
        input: "password",
        inputAttributes: {
          autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonText: "Cancelar crédito",
        cancelButtonText: "Cerrar",
        confirmButtonColor: "#d33",
        showLoaderOnConfirm: true,
        preConfirm: (data) => {
          axios
            .put(`api/credit/${id}/disable`, {
              pw: data,
            })
            .then((result) => {
              this.getCredits();
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Cancelado !",
                showConfirmButton: false,
                timer: 1500,
              });
              // console.log(result);
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
  },
  computed: {
    total_sum() {
      this.credits.forEach((item) => {
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