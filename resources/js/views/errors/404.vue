<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div class="auth-wrapper bg-white">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="text-center">
                  <img src="/img/maintance/404.png" alt="" class="img-fluid" />
                  <h5 class="text-muted my-4">Oops! Página no encontrada!</h5>
                  <button
                    @click="redirect"
                    class="btn btn-primary mb-4 shadow rounded"
                  >
                    <i class="feather icon-compass mr-2"></i>Sácame de aquí
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  // name: "404",
  methods: {
    redirect() {
      this.$router.push("/");
    },
  },
};
</script>

<style>
</style>