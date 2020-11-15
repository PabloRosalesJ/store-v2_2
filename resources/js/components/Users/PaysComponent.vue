<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-10">
        <div class="card">
          <div class="card-header">
            <div class="row justify-content-between">
              <h5 class="col-3">Pagos</h5>
              <span class="col-2">Total: ${{ total_sum }}.00</span>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="payments-table" class="table table-sm table-hover">
                <thead class="text-center">
                  <tr role="row">
                    <th>Serie</th>
                    <th>Fecha</th>
                    <th>Vendedor</th>
                    <th>Total</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item of Payments" :key="item.id">
                    <td>
                      <div
                        class="d-flex align-items-center"
                        v-text="item.id"
                      ></div>
                    </td>
                    <td>
                      <div v-text="item.created_at"></div>
                    </td>
                    <td>
                      <div v-text="item.user.username"></div>
                    </td>
                    <td>
                      <div>${{ item.amount }}.00</div>
                    </td>
                    <td class="text-center">
                      <i
                        class="p-1 mr-2 feather icon-minus-circle btn btn-outline-danger btn-sm shadow-sm rounded"
                      ></i>
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
  name: "PaysComponent",
  data() {
    return {
      Payments: [],
      total: 0,
    };
  },
  props: ["client_id"],
  mounted() {
    this.getPayments();
  },
  beforeMount() {
    setTimeout(() => {
      $("#payments-table").DataTable({
        order: [],
      });
    }, 3000);
  },
  methods: {
    getPayments() {
      axios
        .get(`/api/payment/${this.client_id}/client`)
        .then((result) => {
          this.Payments = result.data;
        })
        .catch((err) => {
          //console.log(result.response);
        });
    },
  },
  computed: {
    total_sum() {
      this.Payments.forEach((item) => {
        this.total += parseInt(item.amount);
      });
      return this.total;
    },
  },
};
</script>

<style>
</style>