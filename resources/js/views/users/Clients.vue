<template>
  <div>
    <div class="card">
      <div class="card-header p-2">
        <div class="row align-items-center m-l-0">
          <div class="col-sm-6">
            <h4>Clientes</h4>
          </div>
          <div class="col-sm-6 text-right">
            <button
              class="btn btn-primary shadow rounded mx-3 my-0"
              data-toggle="modal"
              data-target="#modal-client"
            >
              <i class="feather icon-plus-circle"></i> Añadir un client
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ClientsComponent></ClientsComponent>
      </div>
    </div>
  </div>
</template>

<script>
import ClientsComponent from "../../components/Users/ClientsComponent";

export default {
  name: "Clients",
  data() {
    return {
      // name: {g_name: 'Usuarios', l_name:'Clientes'}
    };
  },
  components: {
    ClientsComponent,
  },
};
</script>

<style>
</style>