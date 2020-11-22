<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-10">
        <div class="card">
          <div class="card-header">
            <div class="row justify-content-between">
              <h5 class="col-3">Pagos recibidos</h5>
              <span class="col-2">Total: ${{ total_sum }}.00</span>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="payments-table" class="table table-sm table-hover">
                <thead class="text-center">
                  <tr role="row">
                    <th>id</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item of Payments" 
                    :key="item.id"
                    :class="{ 'table-danger': item.deleted_at, '': !item.deleted_at }"
                    >
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
                      <div> {{item.client.name}} {{item.client.l_name}} </div>
                    </td>
                    <td>
                      <div>${{ item.amount }}.00</div>
                    </td>
                    <td class="text-center">
                      <div v-if="item.deleted_at">
                        <span class="badge badge-danger">Cancelado desde {{ item.deleted_at }}</span>                        
                      </div>
                      <div v-else>
                        <i @click="remove(item.id)"
                        class="p-1 mr-2 feather icon-minus-circle btn btn-outline-danger btn-sm shadow-sm rounded"
                      ></i>
                      </div>
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
  name: "PaysComponentInUser",
  data() {
    return {
      Payments: [],
      total: 0,
    };
  },
  props: ["user_id"],
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
        .get(`/api/payment/${this.user_id}/user`)
        .then((result) => {
          this.Payments = result.data;
        })
        .catch((err) => {
          //console.log(result.response);
        });
    },
    remove(id) {
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
            .put(`/api/payment/${id}/disable`, {
              pw: data,
            })
            .then((result) => {
              console.log(result);
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Cancelado !",
                showConfirmButton: false,
                timer: 1500,
              });
              this.getPayments();
            })
            .catch((err) => {
              Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "Credenciales incorrectas",
                showConfirmButton: true,
              });
              console.log(err.response);
            });
        },
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