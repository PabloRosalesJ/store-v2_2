<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-10">
        <div class="card">
          <div class="card-header">Pagos</div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                id="report-table"
                class="table table-striped mb-0 dataTable no-footer"
                role="grid"
                aria-describedby="report-table_info"
              >
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
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">123456</div>
                    </td>
                    <td>
                      <div>02/12/2018</div>
                    </td>
                    <td>
                      <div class="row">Mrs. Aliyah Donnelly Jr. Schowalter</div>
                    </td>
                    <td>$235.00</td>
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
  data(){
    return {
      Payments = [],
    }
  },
  mounted: {},
  methods: {
    getPayments() {
      axios.
        get()
        .then((result) => {
          
        }).catch((err) => {
          
        });
    },
  },
};
</script>

<style>
</style>