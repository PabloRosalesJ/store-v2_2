<template>
  <div>
    <div class="card">
      <div class="card-header p-2">
        <div class="row align-items-center m-l-0">
          <div class="col-sm-6">
            <h4>Provedores</h4>
          </div>
          <div class="col-sm-6 text-right">
            <button
              class="btn btn-primary shadow rounded mx-3 my-0"
              data-toggle="modal"
              data-target="#modal-provider"
            >
              <i class="feather icon-plus-circle"></i> Añadir un provedor
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ProvidersComponent></ProvidersComponent>
      </div>
    </div>
  </div>
</template>

<script>
import ProvidersComponent from "../../components/Providers/ProvidersComponent";
export default {
  name: "Providers",
  components: {
    ProvidersComponent,
  },
};
</script>

<style>
</style>