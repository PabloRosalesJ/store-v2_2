<template>
  <div>
    <div class="table-responsive">
      <table id="table" class="table table-bordered table-striped mb-0">
        <thead>
          <tr role="row">
            <th
              class="sorting_asc"
              tabindex="0"
              aria-controls="report-table"
              rowspan="1"
              colspan="1"
              aria-sort="ascending"
              aria-label="Image: activate to sort column descending"
              style="width: 46px"
            >
              Image
            </th>
            <th
              class="sorting"
              tabindex="0"
              aria-controls="report-table"
              rowspan="1"
              colspan="1"
              aria-label="Name: activate to sort column ascending"
              style="width: 83px"
            >
              Name
            </th>
            <th
              class="sorting"
              tabindex="0"
              aria-controls="report-table"
              rowspan="1"
              colspan="1"
              aria-label="Email: activate to sort column ascending"
              style="width: 134px"
            >
              Email
            </th>
            <th
              class="sorting"
              tabindex="0"
              aria-controls="report-table"
              rowspan="1"
              colspan="1"
              aria-label="Roll: activate to sort column ascending"
              style="width: 41px"
            >
              Roll
            </th>
            <th
              class="sorting"
              tabindex="0"
              aria-controls="report-table"
              rowspan="1"
              colspan="1"
              aria-label="Sex: activate to sort column ascending"
              style="width: 28px"
            >
              Sex
            </th>
            <th
              class="sorting"
              tabindex="0"
              aria-controls="report-table"
              rowspan="1"
              colspan="1"
              aria-label="Birth Date: activate to sort column ascending"
              style="width: 81px"
            >
              Birth Date
            </th>
            <th
              class="sorting"
              tabindex="0"
              aria-controls="report-table"
              rowspan="1"
              colspan="1"
              aria-label="Age: activate to sort column ascending"
              style="width: 30px"
            >
              Age
            </th>
            <th
              class="sorting"
              tabindex="0"
              aria-controls="report-table"
              rowspan="1"
              colspan="1"
              aria-label="Blood Group: activate to sort column ascending"
              style="width: 103px"
            >
              Blood Group
            </th>
            <th
              class="sorting"
              tabindex="0"
              aria-controls="report-table"
              rowspan="1"
              colspan="1"
              aria-label="Options: activate to sort column ascending"
              style="width: 95px"
            >
              Options
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="client of clients" :key="client.id">
            <td class="sorting_1">
              <img
                src="http://store.test/images/avatar.jpg"
                class="img-radius"
                width="30px"
                height="30px"
              />
            </td>
            <td>Tanvir Hasan</td>
            <td>patient@example.com</td>
            <td>9876543</td>
            <td>female</td>
            <td>13/09/1994</td>
            <td>54</td>
            <td>o+</td>
            <td>
              <a href="#!" class="btn btn-info btn-sm">Edit</a>
              <a href="#!" class="btn btn-danger btn-sm">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "ClientsComponent",
  data() {
    return {
      clients: [],
    };
  },
  mounted() {
    axios
      .get("http://store.test/api/person/")
      .then((response) => {
        this.clients = response.data.data;
      })
      .catch((e) => {
        // Podemos mostrar los errores en la consola
        console.log(e);
      });

    console.log(this.clients);
  },
};
</script>

<style></style>
