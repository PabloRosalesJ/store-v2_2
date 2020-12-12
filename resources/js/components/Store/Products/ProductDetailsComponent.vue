<template>
  <div class="row">
    <!-- customar project  start -->
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-5">
              <div
                id="carouselExampleCaptions"
                class="carousel slide carousel-fade"
                data-ride="carousel"
              >
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      :src="image === '/storage/' ? '/img/product/product-default.svg' : image"
                      class="d-block w-100"
                      alt="Product images"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="pl-lg-4">
                <h6 class="text-muted">
                  <button
                    @click="back"
                    title="back"
                    class="btn btn-sm m-0 p-0 shadow-sm redounded"
                  >
                    <i class="feather icon-arrow-left"></i>
                  </button>
                  {{ product.provider.provider_name }}
                </h6>
                <h3 class="mt-0">
                  {{ product.name }}
                  <a href="javascript: void(0);" class="text-muted"
                    ><i class="mdi mdi-square-edit-outline ml-2"></i
                  ></a>
                </h3>
                <p class="mb-1">Fecha de creación: {{ product.created_at }}</p>
                <div class="mt-3">
                  <h5 v-if="product.stock > 1">
                    <span class="badge badge-success">Instock</span>
                    {{ product.stock }} pz
                  </h5>
                  <h5 v-else>
                    <span class="badge badge-warning">Outstock</span>
                  </h5>
                </div>
                <div class="mt-4">
                  <h6>Precio:</h6>
                  <h3>
                    ${{ product.unit_price }}
                    <span class="text-muted font-weight-normal h5">
                      <small
                        >mayoreo: ${{ product.buy_price }} | precio de compra:
                        ${{ product.wholesale_price }}</small
                      ></span
                    >
                  </h3>
                </div>
                <div class="row">
                  <div class="col-sm-6 mt-md-0 mt-2">
                    <button
                      type="button"
                      class="btn btn-block btn-lg btn-warning"
                    >
                      <i class="fas fa-cart-plus mr-1"></i> Agregar al carrito
                    </button>
                  </div>
                  <div class="col-sm-6">
                    <button
                      type="button"
                      class="btn btn-block btn-lg btn-danger mt-md-0 mt-2"
                    >
                      <i class="fas fa-bolt mr-1"></i> Vender ahora
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="mt-4">
                <h6>Descripción:</h6>
                <p>{{ product.description }}</p>
              </div>
            </div>
          </div>
          <div class="table-responsive mt-4">
            <h6 class="text-center">Últimas 5 ventas</h6>
            <table class="table mb-0 table-sm">
              <thead class="thead-light">
                <tr>
                  <th>Vendedor</th>
                  <th>Comprador</th>
                  <th>Precio</th>
                  <th>Piezas</th>
                  <th>total</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="l_shop of last_shops" :key="l_shop.id">
                  <td> 
                    <router-link :to="{ name: 'usersShops', params: { id: l_shop.sale.user_id }}">
                      Vendedor {{l_shop.sale.user_id}}
                    </router-link>
                  </td>
                  <td> 
                    <router-link :to="{ name: 'client', params: { id: l_shop.sale.people_id }}">
                      Cliente {{l_shop.sale.people_id}}
                    </router-link>
                  </td>
                  <td> {{l_shop.price}} </td>
                  <td> ${{l_shop.quantity}} </td>
                  <td> ${{l_shop.sub_total}} </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- customar project  end -->
  </div>
</template>

<script>
export default {
  name: "ProductsDetailsComponent",
  data() {
    return {
      product: {},
      image: '',
      last_shops:[]
    };
  },
  mounted() {
    this.getProduct();
  },
  methods: {
    getProduct() {
      axios
        .get(`/api/product/${this.$route.params.id}/show`)
        .then((result) => {
          this.product = result.data.product;
          this.image = result.data.image;
          this.getLastShops();
        })
        .catch((err) => {
          this.$router.push({ name: "notFound" });
          //console.log(err.response);
        });
    },
    getLastShops(){
      axios
      .get(`api/product/${this.$route.params.id}/show?limit=5`)
      .then((result) => {
        this.last_shops = result.data;
      }).catch((err) => {
        err.response
      });
    },
    back() {
      this.$router.go(-1);
    },
  },
};
</script>

<style>
</style>