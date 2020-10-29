<template>
  <div>
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h5>Compras</h5>
          </div>
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
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-10">
                <h5>Detalles</h5>
              </div>
              <div class="col-2">
                <i
                  class="p-1 mr-2 mr-auto feather icon-check-square btn btn-success btn-sm shadow-sm rounded"
                ></i>
              </div>
            </div>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item py-0">
              <div class="table-responsive">
                <table class="table table-borderless mb-0">
                  <tbody>
                    <tr>
                      <td>
                        <img
                          src="assets/images/product/prod-1.jpg"
                          alt="contact-img"
                          title="contact-img"
                          class="rounded mr-2"
                          height="48"
                        />
                        <p class="m-0 d-inline-block align-middle">
                          <a href="#!" class="text-body font-weight-semibold"
                            >Rolling Chair</a
                          >
                          <br />
                          <small>5 x $148.66</small>
                        </p>
                      </td>
                      <td class="text-right">$743.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
            <li class="list-group-item py-0">
              <div class="table-responsive">
                <table class="table table-borderless mb-0">
                  <tbody>
                    <tr>
                      <td>
                        <img
                          src="assets/images/product/prod-2.jpg"
                          alt="contact-img"
                          title="contact-img"
                          class="rounded mr-2"
                          height="48"
                        />
                        <p class="m-0 d-inline-block align-middle">
                          <a href="#!" class="text-body font-weight-semibold"
                            >Dining Chair</a
                          >
                          <br />
                          <small>2 x $99.00</small>
                        </p>
                      </td>
                      <td class="text-right">$198.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
            <li class="list-group-item py-0">
              <div class="table-responsive">
                <table class="table table-borderless mb-0">
                  <tbody>
                    <tr>
                      <td>
                        <img
                          src="assets/images/product/prod-3.jpg"
                          alt="contact-img"
                          title="contact-img"
                          class="rounded mr-2"
                          height="48"
                        />
                        <p class="m-0 d-inline-block align-middle">
                          <a href="#!" class="text-body font-weight-semibold"
                            >Marvel T-shirts</a
                          >
                          <br />
                          <small>1 x $129.99</small>
                        </p>
                      </td>
                      <td class="text-right">$129.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
          </ul>
          <div class="card-body py-2">
            <div class="table-responsive">
              <table
                class="table table-borderless mb-0 w-auto table-sm float-right text-right"
              >
                <tbody>
                  <tr>
                    <td>
                      <h6 class="m-0">Sub Total:</h6>
                    </td>
                    <td>$1070</td>
                  </tr>
                  <tr>
                    <td>
                      <h6 class="m-0">Shipping:</h6>
                    </td>
                    <td>FREE</td>
                  </tr>
                  <tr class="border-top">
                    <td>
                      <h5 class="m-0">Total:</h5>
                    </td>
                    <td class="font-weight-semibold">$1070</td>
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
  name: "ShoppingComponent",
  data() {
    return {
      compras: [],
    };
  },
};
</script>

<style>
</style>