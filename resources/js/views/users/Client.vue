<template>
  <div>
    <div class="user-profile user-card mb-4">
      <div class="card-header border-0 p-0 pb-0">
        <div class="cover-img-block">
          <!-- <img src="assets/images/profile/cover.jpg" alt="" class="img-fluid"> -->
          <div class="overlay"></div>
          <div class="dropdown">
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#"
                ><i class="feather icon-upload-cloud mr-2"></i>upload new</a
              >
              <a class="dropdown-item" href="#"
                ><i class="feather icon-image mr-2"></i>from photos</a
              >
              <a class="dropdown-item" href="#"
                ><i class="feather icon-film mr-2"></i> upload video</a
              >
              <a class="dropdown-item" href="#"
                ><i class="feather icon-trash-2 mr-2"></i>remove</a
              >
            </div>
          </div>
        </div>
      </div>
      <div class="card-body py-0">
        <div class="user-about-block m-0">
          <div class="row">
            <div class="col-md-4 text-center mt-n5">
              <div class="change-profile text-center">
                <!-- <span>
                  <i
                    class="feather icon-arrow-left btn btn-sm btn-light m-1 p-1 rounded text-muted"
                  ></i>
                </span> -->
                <div class="dropdown w-auto d-inline-block">
                  <a
                    class="dropdown-toggle"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <div class="profile-dp">
                      <div class="position-relative d-inline-block">
                        <img
                          class="img-radius img-fluid wid-100"
                          :src="BASE_URL + '/img/defaultAvatar.svg'"
                          alt="User image"
                        />
                      </div>
                      <div class="overlay">
                        <span>change</span>
                      </div>
                    </div>
                    <!-- Credit info -->
                    <div v-if="client.status" class="certificated-badge">
                      <i
                        class="fas fa-check-circle text-c-blue bg-icon"
                        title="OK"
                      ></i>
                    </div>
                    <div v-if="!client.status" class="certificated-badge">
                      <i
                        class="fas fa-exclamation-circle text-c-yellow bg-icon"
                        title="Precaución. 
Ha este cliente no se le puede vender a crédito."
                      ></i>
                    </div>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"
                      ><i class="feather icon-upload-cloud mr-2"></i>upload
                      new</a
                    >
                    <a class="dropdown-item" href="#"
                      ><i class="feather icon-trash-2 mr-2"></i>remove</a
                    >
                  </div>
                </div>
                <!-- <span>
                  <i
                    class="feather icon-arrow-right btn btn-sm btn-light m-1 p-1 rounded text-muted"
                  ></i>
                </span> -->
              </div>
              <h5 class="mb-1" v-text="client.name"></h5>
              <p class="mb-2 text-muted">
                {{ client.l_name }} {{ client.s_name }}
              </p>
              <p class="mb-2 text-muted">
                <button
                  @click="back"
                  class="btn btn-light m-1 p-1 shadow-sm rounded"
                >
                  <i class="feather icon-arrow-left"></i>
                  back
                </button>
              </p>
            </div>
            <div class="col-md-8 mt-md-4">
              <div class="row">
                <div class="col-md-6">
                  <span
                    href="#!"
                    class="mb-1 text-muted d-flex align-items-end text-h-primary"
                    ><i class="feather icon-calendar mr-2 f-18"></i
                    >{{ client.created_at }}</span
                  >
                  <div class="clearfix"></div>
                  <span
                    class="mb-1 text-muted d-flex align-items-end text-h-primary"
                    ><i class="feather icon-mail mr-2 f-18"></i
                    >{{ client.email }}</span
                  >
                  <div class="clearfix"></div>
                  <a
                    href="#!"
                    class="mb-1 text-muted d-flex align-items-end text-h-primary"
                    ><i class="feather icon-phone mr-2 f-18"></i>
                    {{ client.phone }}</a
                  >
                </div>
                <div class="col-md-6">
                  <div class="media">
                    <i class="feather icon-map-pin mr-2 mt-1 f-18"></i>
                    <div class="media-body">
                      <p class="mb-0 text-muted">{{ client.address }}</p>
                    </div>
                  </div>
                </div>
              </div>

              <ul
                class="nav nav-tabs profile-tabs nav-fill"
                id="clientHistory"
                role="tablist"
              >
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link text-reset active"
                    id="compras-tab"
                    data-toggle="pill"
                    href="#compras"
                    role="tab"
                    aria-controls="compras"
                    aria-selected="true"
                    ><i class="feather icon-shopping-cart mr-2"></i>Compras</a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link text-reset"
                    id="credit-tab"
                    data-toggle="pill"
                    href="#credit"
                    role="tab"
                    aria-controls="credit"
                    aria-selected="false"
                    ><i class="feather icon-credit-card mr-2"></i>Crédito</a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link text-reset"
                    id="pays-tab"
                    data-toggle="pill"
                    href="#pays"
                    role="tab"
                    aria-controls="pays"
                    aria-selected="false"
                    ><i class="fas fa-money-bill-alt mr-2"></i>Pagos</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
      <div
        class="tab-pane fade show active"
        id="compras"
        role="tabpanel"
        aria-labelledby="compras-tab"
      >
        <ShoppingComponent
          :client_id="this.$route.params.id"
        ></ShoppingComponent>
      </div>
      <div
        class="tab-pane fade"
        id="credit"
        role="tabpanel"
        aria-labelledby="credit-tab"
      >
        <CreditComponent :client_id="this.$route.params.id"></CreditComponent>
      </div>
      <div
        class="tab-pane fade"
        id="pays"
        role="tabpanel"
        aria-labelledby="pays-tab"
      >
        <PaysComponent :client_id="this.$route.params.id"></PaysComponent>
      </div>
    </div>
  </div>
</template>

<script>
import ShoppingComponent from "../../components/Users/ShoppingComponent";
import CreditComponent from "../../components/Users/CreditComponent";
import PaysComponent from "../../components/Users/PaysComponent";

export default {
  name: "Client",
  components: {
    ShoppingComponent,
    CreditComponent,
    PaysComponent,
  },
  data() {
    return {
      BASE_URL: process.env.MIX_APP_API_URL,
      client: {},
    };
  },
  mounted() {
    this.getClient();
  },
  beforeMount() {},
  methods: {
    getClient() {
      axios
        .get(`${this.BASE_URL}/api/person/${this.$route.params.id}/show`)
        .then((result) => {
          this.client = result.data;
        })
        .catch((error) => {
          //console.log(error.response.data.message);
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