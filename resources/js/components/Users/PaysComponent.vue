<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-10">
        <div class="card">
          <div class="card-header">Pagos</div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="payments-table" class="table table-sm table-hover">
                <thead class="text-center">
                  <tr role="row">
                    <th>Serie</th>
                    <th>Fecha</th>
                    <th>Vendedor</th>
                    <th>Total</th>
                    <th>Cancelar</th>
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
                      <div v-text="item.amount"></div>
                    </td>
                    <td class="text-center">
                      <i
                        class="p-1 mr-2 feather icon-minus-circle btn btn-outline-danger btn-sm shadow-sm rounded"
                      ></i>
                      <i
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
    </div>
  </div>
</template>

<script>
export default {
  name: "PaysComponent",
  data() {
    return {
      Payments: [],
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
          console.log(result.response);
        });
    },
  },
};
</script>

<style>
</style>