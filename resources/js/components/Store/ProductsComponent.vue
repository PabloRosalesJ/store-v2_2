<template>
  <div>
    <div class="row justify-content-center">
      <div class="table table-responsive table-sm table-hover">
        <table id="products-table" class="table mb-0">
          <thead class="thead-light">
            <tr>
              <th>id</th>
              <th>Nombre</th>
              <th>BarCode</th>
              <th>Precio</th>
              <th>P. mayoreo</th>
              <th>P. de compra</th>
              <th>Stock</th>
              <th>Creado el</th>
              <th>Status</th>
              <th class="text-center"><i class="feather icon-settings"></i></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item of products" :key="item.id" class="m-0 p-0">
              <td class="align-middle m-0 p-0">
                <button
                  @click="showinfo(item.id)"
                  title="Estadísticas"
                  class="btn btn-sm btn-outline-primary m-1"
                >
                  {{ item.id }}
                </button>
              </td>
              <td class="align-middle m-0 p-0">
                <p class="m-0 p-0">
                  <strong> {{ item.name }} </strong>
                </p>
                <small>{{ item.description }}</small>
              </td>
              <td class="align-middle m-0 p-0">{{ item.bar_code }}</td>
              <td
                class="align-middle m-0 p-0 text-center"
                v-text="'$' + item.unit_price"
              ></td>
              <td
                class="align-middle m-0 p-0 text-center"
                v-text="'$' + item.wholesale_price"
              ></td>
              <td
                class="align-middle m-0 p-0 text-center"
                v-text="'$' + item.buy_price"
              ></td>
              <td class="align-middle m-0 p-0" v-text="item.stock + ' pz'"></td>
              <td class="align-middle m-0 p-0" v-text="item.created_at"></td>
              <td class="text-center">
                <span v-if="item.status" class="badge badge-primary">
                  <p hidden>{{ item.status }}</p>
                  <i title="activo" class="feather icon-thumbs-up"></i>
                </span>
                <span v-else class="badge badge-secondary">
                  <p hidden>{{ item.status }}</p>
                  <i title="desactivo" class="feather icon-thumbs-down"></i>
                </span>
              </td>
              <td class="table-action text-center">
                <i
                  v-if="!item.status"
                  @click="enable(item.id)"
                  title="Habilitar"
                  class="p-1 mr-2 feather icon-plus-circle btn btn-outline-success btn-sm shadow-sm rounded"
                ></i>
                <i
                  v-else
                  @click="disable(item.id)"
                  title="Desabilitar temporalmente"
                  class="p-1 mr-2 feather icon-minus-circle btn btn-outline-warning btn-sm shadow-sm rounded"
                ></i>
                <i
                  @click="remove(item.id)"
                  title="Eliminar"
                  class="p-1 mr-2 feather icon-trash-2 btn btn-outline-danger btn-sm shadow-sm rounded"
                ></i>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>id</th>
              <th>Nombre</th>
              <th>BarCode</th>
              <th>Precio</th>
              <th>P. mayoreo</th>
              <th>P. de compra</th>
              <th>Stock</th>
              <th>Status</th>
              <th class="text-center"><i class="feather icon-settings"></i></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductsComponent",
  data() {
    return {
      products: [],
    };
  },
  beforeMount() {
    this.getProducts();
  },
  mounted() {
    this.activeTable();
  },
  methods: {
    getProducts() {
      axios
        .get("/api/product")
        .then((result) => {
          this.products = result.data;
          $("#navbar_app").addClass("navbar-collapsed");
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    showinfo(id) {},
    enable(id) {
      axios
        .put(`/api/product/${id}/enable`)
        .then((result) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `hablilite: ${result.data.name}`,
            showConfirmButton: false,
            timer: 1500,
          });
          this.getProducts();
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    disable(id) {
      axios
        .put(`/api/product/${id}/disable`)
        .then((result) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `deshablilite: ${result.data.name}`,
            showConfirmButton: false,
            timer: 1500,
          });
          this.getProducts();
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    remove(id) {
      Swal.fire({
        title: "Elimianr?",
        text:
          "Se eliminaran los productos realcionado a esta categoria, no se perderán registros pasados",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminala! <i class='feather icon-trash-2'></i>",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({ title: "Eliminado!", icon: "success" });
        }
      });
    },
    activeTable() {
      setTimeout(() => {
        $("#products-table").DataTable({
          order: [],
        });
      }, 1500);
    },
  },
};
</script>

<style>
</style>