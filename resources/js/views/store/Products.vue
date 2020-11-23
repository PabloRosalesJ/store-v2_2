<template>
  <div>
    <div class="card">
      <div class="card-header p-2">
        <div class="row align-items-center m-l-0">
          <div class="col-sm-6">
            <h4>Productos</h4>
          </div>
          <div class="col-sm-6 text-right">
            <button
              class="btn btn-primary shadow rounded mx-3 my-0"
              data-toggle="modal"
              data-target="#modal-user"
            >
              <i class="feather icon-plus-circle"></i> Añadir un usuario
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ProductsComponent></ProductsComponent>
      </div>
    </div>
  </div>
</template>

<script>
import ProductsComponent from "../../components/Store/ProductsComponent";

export default {
  name: "Products",
  components: {
    ProductsComponent,
  },
};
</script>

<style>
</style>