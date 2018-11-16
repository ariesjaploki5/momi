<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Candidates</h3>

                    </div>
                    <div class="card-body p-0 mx-2 my-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="archives-tab" data-toggle="tab" href="#archives" role="tab" aria-controls="archives" aria-selected="false">Archives</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Firstname</th>
                                                <th>Middlename</th>
                                                <th>Lastname</th>
                                                <th>Email</th>
                                                <th>Registered At</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="candidate in candidates.data" :key="candidate.id" class="text-capitalize">
                                                    <td>{{ candidate.id }}</td>
                                                    <td>{{ candidate.firstname }}</td>
                                                    <td>{{ candidate.middlename }}</td>
                                                    <td>{{ candidate.lastname }}</td>
                                                    <td>{{ candidate.email }}</td>
                                                    <td>{{ candidate.created_at | myDate }}</td>
                                                    <td>
                                                      
                                                        <button type="button" class="btn btn-sm btn-danger" @click="archivecandidate(candidate.id)">
                                                            <i class="fa fa-trash"></i>
                                                            Archive
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="candidates" @pagination-change-page="getResults">
                                        </pagination>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="archives" role="tabpanel" aria-labelledby="archives-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Firstname</th>
                                                <th>Middlename</th>
                                                <th>Lastname</th>
                                                <th>Email</th>
                                                <th>Registered At</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="archive in archives.data" :key="archive.id" class="text-capitalize">
                                                    <td>{{ archive.id }}</td>
                                                    <td>{{ archive.firstname }}</td>
                                                    <td>{{ archive.middlename }}</td>
                                                    <td>{{ archive.lastname }}</td>
                                                    <td>{{ archive.email }}</td>
                                                    <td>{{ archive.created_at | myDate }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-success" @click="restorecandidate(archive.id)">               
                                                            <i class="fas fa-edit"></i>
                                                            Restore
                                                        </button>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="archives" @pagination-change-page="getResults2">
                                        </pagination>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div><!--  row -->
        <div class="row">
            <div class="modal fade" id="candidatemodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="addmodalLabel">Add new</h5>
                            <h5 v-show="editmode" class="modal-title" id="addmodalLabel">Update User's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updatecandidate() : createcandidate()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input v-model="form.firstname" type="text" name="firstname" 
                                        placeholder="Firstname"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('firstname') }">
                                    <has-error :form="form" field="firstname"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.middlename" type="text" name="middlename" 
                                        placeholder="Middlename"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('middlename') }">
                                    <has-error :form="form" field="middlename"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.lastname" type="text" name="lastname" 
                                        placeholder="Lastname"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('lastname') }">
                                    <has-error :form="form" field="lastname"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.email" type="text" name="email" 
                                        placeholder="Email Address"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.password" type="password" name="password" id="password"
                                        placeholder="Password"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--  row -->
    </div>
</template>
<script>
    export default {
        data() {
            return{
                editmode: false,
                candidates :{},
                archives: {},
                form: new Form({
                    id: '',
                    email: '',
                    password: '',
                    firstname: '',
                    middlename: '',
                    lastname: '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/candidate?page=' + page)
                    .then(response => {
                        this.candidates = response.data;
                    });
            },
            getResults2(page = 1) {
                axios.get('api/candidatearchives?page=' + page)
                    .then(response => {
                        this.candidatesarchives = response.data;
                    });
            },
            loaddata(){
                axios.get('api/candidate').then(({ data }) => (this.candidates = data ));
            },
            loadarchiveds(){
                axios.get('api/candidatearchives').then(({ data }) => (this.archives = data ));
            },
            newmodal(){
                this.editmode = false;
                this.form.reset();
                $('#candidatemodal').modal('show');
            },
            editmodal(candidate){
                this.editmode = true;
                this.form.reset();
                $('#candidatemodal').modal('show');
                this.form.fill(candidate);
            },

            updatecandidate(id) {
                this.$Progress.start();
                this.form.put('api/candidate/'+this.form.id).then(() => {
                    Fire.$emit('success');
                    $('#candidatemodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'candidate Created in Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            archivecandidate(id) {
                swal({
                title: 'Are you sure?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value){
                        this.form.delete('api/candidate/'+id).then(()=>{
                            swal(
                                'Archived!',
                                'Candidate has been archived.',
                                'success'
                            )
                            Fire.$emit('success');
                        }).catch(()=>{
                            swal(
                                'Failed!',
                                'There was something wrong',
                                'warning'
                            )
                        });
                    }
                })
            },
            restorecandidate(id){
                swal({
                title: 'Are you sure?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value){
                        axios.get('api/candidaterestore/'+id).then(()=>{
                            swal(
                                'Restored!',
                                'Candidate has been restore.',
                                'success'
                            )
                            Fire.$emit('success');
                        }).catch(()=>{
                            swal(
                                'Failed!',
                                'There was something wrong',
                                'warning'
                            )
                        });
                    }
                })
            },

        },
        created() {
            this.loaddata();
            this.loadarchiveds();
            Fire.$on('success',() => {
                this.loaddata();
                this.loadarchiveds();
            });
        }
    }
</script>
