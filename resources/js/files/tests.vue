<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Medical Tests</h3>
                        <div class="card-tools">
                            <button class="btn add-btn" @click="newmodal">Add New</button>
                        </div>
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
                                                <th>Name</th>
                                                <th>Selected</th>
                                                <th>Added At</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="test in tests.data" :key="test.id" class="text-capitalize">
                                                    <td>{{ test.id }}</td>
                                                    <td>{{ test.name }}</td>
                                                    <td>
                                                        <p v-if="test.selected === 1">Yes</p>
                                                        <p v-else>No</p>
                                                    </td>
                                                    <td>
                                                        <p v-if="test.created_at === null"></p>
                                                        <p v-else>{{ test.created_at | myDate }}</p>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" @click="editmodal(test)" data-toggle="tooltip" data-placement="top" title="Edit">               
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" @click="archivetest(test.id)" data-toggle="tooltip" data-placement="top" title="Archive">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="tests" @pagination-change-page="getResults">
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
                                            <th>Name</th>
                                            <th>Selected</th>
                                            <th>Added At</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="archive in archives.data" :key="archive.id" class="text-capitalize">
                                                <td>{{ archive.id }}</td>
                                                <td>{{ archive.name }}</td>
                                                <td>
                                                    <p v-if="archive.selected === 1">Yes</p>
                                                    <p v-else>No</p>
                                                </td>
                                                <td>
                                                        <p v-if="archive.created_at === null"></p>
                                                        <p v-else>{{ archive.created_at | myDate }}</p>
                                                    </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" @click="restoretest(archive.id)" data-toggle="tooltip" data-placement="top" title="Restore">               
                                                        <i class="fas fa-window-restore"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <pagination :data="tests" @pagination-change-page="getResults">
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
            <div class="modal fade" id="testmodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="addmodalLabel">Add New Test</h5>
                            <h5 v-show="editmode" class="modal-title" id="addmodalLabel">Update Test</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updatetest() : createtest()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Test Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="Test name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="selected">Selected?</label>
                                    <select v-model="form.selected" placeholder="selected" class="form-control" :class="{ 'is-invalid': form.errors.has('selected') }">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <has-error :form="form" field="selected"></has-error>
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
                tests :{},
                archives: {},
                form: new Form({
                    id: '',
                    name: '',
                    selected: '',


                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/test?page=' + page)
                    .then(response => {
                        this.tests = response.data;
                    });
            },
            getResults2(page = 1) {
                axios.get('api/testarchives?page=' + page)
                    .then(response => {
                        this.testsarchives = response.data;
                    });
            },
            loaddata(){
                axios.get('api/test').then(({ data }) => (this.tests = data ));
            },
            loadarchiveds(){
                axios.get('api/testarchives').then(({ data }) => (this.archives = data ));
            },
            newmodal(){
                this.editmode = false;
                this.form.reset();
                $('#testmodal').modal('show');
            },
            editmodal(test){
                this.editmode = true;
                this.form.reset();
                $('#testmodal').modal('show');
                this.form.fill(test);
            },
            createtest() {
                this.$Progress.start();
                this.form.post('api/test').then(() => {
                    Fire.$emit('success');
                    $('#testmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Medical Test Created Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            updatetest(id) {
                this.$Progress.start();
                this.form.put('api/test/'+this.form.id).then(() => {
                    Fire.$emit('success');
                    $('#testmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Medical Test Updated Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            archivetest(id) {
                swal({
                title: 'Are you sure?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, archive it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value){
                        this.form.delete('api/test/'+id).then(()=>{
                            swal(
                                'Archived!',
                                'Medical Test has been archived.',
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
            restoretest(id){
                swal({
                title: 'Are you sure?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value){
                        axios.get('api/testrestore/'+id).then(()=>{
                            swal(
                                'Restored!',
                                'Medical Test has been restore.',
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
            loadall(){
                this.loaddata();
                this.loadarchiveds();
            },
        },
        created() {
            this.loadall();
            Fire.$on('success',() => {
                this.loadall();
                
            });
        }
    }
</script>
