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
                      src="/img/product/product-default.svg"
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
            <table class="table mb-0">
              <thead class="thead-light">
                <tr>
                  <th>Seller</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Revenue</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Octroyee mall USA</td>
                  <td>$139.50</td>
                  <td>
                    <div class="mb-0">
                      <span>478 </span>
                      <div class="progress">
                        <div
                          class="progress-bar bg-success"
                          role="progressbar"
                          style="width: 56%"
                          aria-valuenow="56"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </div>
                  </td>
                  <td>$1,89,547</td>
                </tr>
                <tr>
                  <td>Chromin - Brazil</td>
                  <td>$149.99</td>
                  <td>
                    <div class="mb-0">
                      <span>73 </span>
                      <div class="progress">
                        <div
                          class="progress-bar bg-danger"
                          role="progressbar"
                          style="width: 16%"
                          aria-valuenow="16"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </div>
                  </td>
                  <td>$87,245</td>
                </tr>
                <tr>
                  <td>Milan - Navsari</td>
                  <td>$106.87</td>
                  <td>
                    <div class="mb-0">
                      <span>781 </span>
                      <div class="progress">
                        <div
                          class="progress-bar bg-success"
                          role="progressbar"
                          style="width: 72%"
                          aria-valuenow="72"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </div>
                  </td>
                  <td>$5,87,478</td>
                </tr>
                <tr>
                  <td>Xendrasn - Japan</td>
                  <td>$239.66</td>
                  <td>
                    <div class="mb-0">
                      <span>815 </span>
                      <div class="progress">
                        <div
                          class="progress-bar bg-success"
                          role="progressbar"
                          style="width: 89%"
                          aria-valuenow="89"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </div>
                  </td>
                  <td>$55,781</td>
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
          this.product = result.data;
        })
        .catch((err) => {
          console.log(err.response);
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