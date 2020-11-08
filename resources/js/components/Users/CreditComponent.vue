<template>
  <div>
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h5>Créditos</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                id="credit-table"
                class="table table-striped table-sm mb-0 dataTable no-footer"
                role="grid"
                aria-describedby="report-table_info"
              >
                <thead class="text-center">
                  <tr role="row">
                    <th>id</th>
                    <th>Vendedor</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Take</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="credit of credits" :key="credit.id">
                    <td v-text="credit.id"></td>
                    <td v-text="credit.user.username"></td>
                    <td>${{ credit.total }}</td>
                    <td v-text="credit.created_at"></td>
                    <td v-text="credit.take"></td>
                    <td class="text-center">
                      <i
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
  name: "CreditComponent",
  data() {
    return {
      credits: [],
      creditDetails: [],
      showDetails: false,
    };
  },
  props: ["client_id"],
  beforeMount() {},
  mounted() {
    axios
      .get(`/api/credit/${this.client_id}/client`)
      .then((result) => {
        this.credits = result.data;
        setTimeout(() => {
          $("#credit-table").DataTable({});
        }, 1000);
      })
      .catch((err) => {
        console.log(err.response);
      });
  },
  methods: {
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
          console.log(err.response);
        });
    },
    hideDetails() {
      this.showDetails = false;
    },
  },
};
</script>

<style>
</style>