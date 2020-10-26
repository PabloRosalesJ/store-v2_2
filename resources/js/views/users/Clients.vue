<template>
  <div>

    <div class="card">
      <div class="card-header">
          <h5 ></h5>
      </div>
      <div class="card-body">
          <div class="row align-items-center m-l-0">
              <div class="col-sm-6">
              </div>
              <div class="col-sm-6 text-right">
                  <button class="btn btn-success btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal-report"><i class="feather icon-plus"></i> Add Student</button>
              </div>
          </div>
        
          <ClientsComponent></ClientsComponent>

      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Student</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
                  <div class="modal-body">
                      <form>
                          <div class="row">
                              <div class="col-12">
                                  <h5>Personal Information</h5>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="floating-label" for="Name">Name</label>
                                      <input type="text" class="form-control" id="Name" placeholder="">
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group fill">
                                      <label class="floating-label" for="Email">Email</label>
                                      <input type="email" class="form-control" id="Email" placeholder="">
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group fill">
                                      <label class="floating-label" for="Password">Password</label>
                                      <input type="password" class="form-control" id="Password" placeholder="">
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="floating-label" for="Rollno">Roll number</label>
                                      <input type="text" class="form-control" id="Rollno" placeholder="">
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label class="floating-label" for="Address">Address</label>
                                      <textarea class="form-control" id="Address" rows="3"></textarea>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <h5>Other Information</h5>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="floating-label" for="Sex">Select Sex</label>
                                      <select class="form-control" id="Sex">
                                          <option value=""></option>
                                          <option value="male">Male</option>
                                          <option value="female">Female</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group fill">
                                      <label class="floating-label" for="Icon">Profie Image</label>
                                      <input type="file" class="form-control" id="Icon" placeholder="sdf">
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group fill">
                                      <label class="floating-label" for="Birth">Birth Date</label>
                                      <input type="date" class="form-control" id="Birth" placeholder="123">
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="floating-label" for="Age">Age</label>
                                      <input type="text" class="form-control" id="Age" placeholder="">
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label class="floating-label" for="Blood">Select Blood Group</label>
                                      <select class="form-control" id="Blood" placeholder="">
                                          <option value=""></option>
                                          <option value="A+">A+</option>
                                          <option value="A-">A-</option>
                                          <option value="B+">B+</option>
                                          <option value="B-">B-</option>
                                          <option value="AB+">AB+</option>
                                          <option value="AB-">AB-</option>
                                          <option value="O+">O+</option>
                                          <option value="O-">O-</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <button class="btn btn-primary">Submit</button>
                                  <button class="btn btn-danger">Clear</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
    </div>

  </div>
</template>

<script>

import ClientsComponent from '../../components/Users/ClientsComponent'

export default {
  name:'Clients',
  data(){
    return {
      // name: {g_name: 'Usuarios', l_name:'Clientes'}
    }
  },
  components:{
    ClientsComponent,
  }
}
</script>

<style>

</style>