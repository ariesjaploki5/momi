<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Milks</h3>
                        <div class="card-tools">
                            <button class="btn add-btn" @click="newmilk">Add New</button>
                            <!-- <button class="btn add-btn" @click="newmodal">Add New</button> -->
                        </div>
                    </div>
                    <div class="card-body p-0 mx-2 my-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Available</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="release-tab" data-toggle="tab" href="#release" role="tab" aria-controls="active" aria-selected="true">Released</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="active" aria-selected="true">Pending</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Batch Number</th>
                                                <th>Donors</th>
                                                <th>Containers</th>
                                                <th>Expiration Date</th>
                                                <th>Added At</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="milk in milks.data" :key="milk.id" class="text-capitalize">
                                                    <td>{{ milk.id }}</td>
                                                    <td>{{ milk.batch_number }}</td>
                                                    <td>
                                                        <p v-for="donor in milk.donors" :key="donor.id">
                                                            {{ donor.user.lastname }}, {{ donor.user.firstname }}
                                                        </p>
                                                        <button @click="adddonor(milk.id)" class="btn add-btn">Add Donor</button>
                                                    </td>
                                                    <td>
                                                        <p v-for="container in milk.containers" :key="container.id">
                                                            {{ container.number }}
                                                        </p>
                                                        <button @click="addcontainer(milk.id)" class="btn add-btn">Add Container</button>
                                                    </td>
                                                    <td>
                                                        {{ milk.expiration_date }}
                                                    </td>
                                                    <td>{{ milk.created_at | myDate }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" @click="editmodal(milk)" >               
                                                            <i class="fa fa-edit"></i>
                                                            Edit
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="milks" @pagination-change-page="getResults">
                                        </pagination>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="release" role="tabpanel" aria-labelledby="release-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Batch Number</th>
                                                <th>Donors</th>
                                                <th>Containers</th>
                                                <th>Added At</th>
                                                
                                            </thead>
                                            <tbody>
                                                <tr v-for="released in releaseds.data" :key="released.id" class="text-capitalize">
                                                    <td>{{ released.id }}</td>
                                                    <td>{{ released.batch_number }}</td>
                                                    <td>
                                                        <p v-for="donor in released.donors" :key="donor.id">
                                                            {{ donor.user.lastname }}, {{ donor.user.firstname }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p v-for="container in released.containers" :key="container.id">
                                                            {{ container.id }}
                                                        </p>
                                                    </td>
                                                    <td>{{ released.created_at | myDate }}</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="milks" @pagination-change-page="getResults2">
                                        </pagination>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Batch Number</th>
                                                <th>Donors</th>
                                                <th>Containers</th>
                                                <th>Added At</th>
                                                
                                            </thead>
                                            <tbody>
                                                <tr v-for="pending in pendings.data" :key="pending.id" class="text-capitalize">
                                                    <td>{{ pending.id }}</td>
                                                    <td>{{ pending.batch_number }}</td>
                                                    <td>
                                                        <p v-for="donor in pending.donors" :key="donor.id">
                                                            {{ donor.user.lastname }}, {{ donor.user.firstname }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p v-for="container in pending.containers" :key="container.id">
                                                            {{ container.id }}
                                                        </p>
                                                    </td>
                                                    <td>{{ pending.created_at | myDate }}</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="milks" @pagination-change-page="getResults3">
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
            <div class="modal fade" id="milkmodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="addmodalLabel">Add New milk</h5>
                            <h5 v-show="editmode" class="modal-title" id="addmodalLabel">Update milk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updatemilk() : createmilk()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="batch_number">Batch Number</label>
                                    <input v-model="form.batch_number" type="text" name="batch_number" 
                                        placeholder="Batch Number"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('batch_number') }">
                                    <has-error :form="form" field="batch_number"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="batch_number">Expiration Date</label>
                                    <input v-model="form.expiration_date" type="date" name="expiration_date" 
                                        placeholder="Batch Number"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('expiration_date') }">
                                    <has-error :form="form" field="expiration_date"></has-error>
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
        <div class="row">
            <div class="modal fade" id="donormodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addmodalLabel">Add Donor</h5>
                            
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="search">Search</label>
                                    <input type="text" v-model="search" class="form-control">
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Lastname</th>
                                            <th>Firstname</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>  
                                    <tbody>
                                        <tr v-for="donor in donorlist" :key="donor.id">
                                            <td>{{ donor.id }}</td>
                                            <td>{{ donor.user.lastname }}</td>
                                            <td>{{ donor.user.firstname }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success" @click="adddonormilk(donor.id)" >               
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                
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
        <div class="row">
            <div class="modal fade" id="containermodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addmodalLabel">Add Container</h5>
                            
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="addcontainermilk">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input v-model="containerform.number" type="text" name="number" 
                                        placeholder="Conatiner Number"
                                            class="form-control" :class="{ 'is-invalid': containerform.errors.has('number') }">
                                    <has-error :form="containerform" field="number"></has-error>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                                
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
                search: '',
                editmode: false,
                milks :{},
                releaseds: {},
                pendings: {},
                archives: {},
                form: new Form({
                    id: '',
                    batch_number: '',
                    expiration_date: '',
                }),
                donorlist: [],
                donorform: new Form({
                    milkid: '',
                }),
                containerform: new Form({
                    milkid: '',
                    number: '',
                }),
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/milk?page=' + page)
                    .then(response => {
                        this.milks = response.data;
                    });
            },

            getResults2(page = 1) {
                axios.get('api/milkdonor?page=' + page)
                    .then(response => {
                        this.milks = response.data;
                    });
            },

            getResults3(page = 1) {
                axios.get('api/released?page=' + page)
                    .then(response => {
                        this.released = response.data;
                    });
            },


            getResults4(page = 1) {
                axios.get('api/pending?page=' + page)
                    .then(response => {
                        this.pending = response.data;
                    });
            },

            loaddata(){
                axios.get('api/milk').then(({ data }) => (this.milks = data ));
            },

            loadreleased(){
                axios.get('api/notavailable').then(({ data }) => (this.released = data ));
            },

            loadpending(){
                axios.get('api/pending').then(({ data }) => (this.pending = data ));
            },

            

            newmodal(){
                this.editmode = false;
                this.form.reset();
                $('#milkmodal').modal('show');
            },
            editmodal(milk){
                this.editmode = true;
                this.form.reset();
                $('#milkmodal').modal('show');
                this.form.fill(milk);
            },
            newmilk()
            {
                axios.get('api/newmilk')
                .then(()=> {
                    Fire.$emit('success');
                    $('#milkmodal').modal('hide');
                    toast({
                            type: 'success',
                            title: 'Milk Created in Successfully'
                        });
                    this.$Progress.finish();
                })
                .catch(()=> {
                    this.$Progress.fail();
                });
            },
            createmilk() {
                this.$Progress.start();
                this.form.post('api/milk').then(() => {
                    Fire.$emit('success');
                    $('#milkmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Milk Created in Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            updatemilk(id) {
                this.$Progress.start();
                this.form.put('api/milk/'+this.form.id).then(() => {
                    Fire.$emit('success');
                    $('#milkmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Milk Updated in Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            adddonor(id){
                this.donorform.reset();
                this.donorform.milkid = id;
                $('#donormodal').modal('show');
            },
            adddonormilk(id){
                this.$Progress.start();
                this.donorform.put('api/adddonormilk/'+id)
                .then(()=> {
                    Fire.$emit('success');
                    $('#donormodal').modal('show');
                    toast({
                            type: 'success',
                            title: 'Milk Created Successfully'
                        });
                    this.$Progress.finish();
                })
                .catch(()=> {
                    this.$Progress.fail();
                });
            },
            addcontainer(id){
                this.containerform.reset();
                this.containerform.milkid = id;
                $('#containermodal').modal('show');
            },

            addcontainermilk(){
                this.$Progress.start();
                 this.containerform.post('api/addcontainermilk')
                .then(()=> {
                    Fire.$emit('success');
                    $('#containermodal').modal('hide');
                    toast({
                            type: 'success',
                            title: 'Container Created Successfully'
                        });
                    this.$Progress.finish();
                })
                .catch(()=> {
                    this.$Progress.fail();
                });
            },
            donors(){
                axios.get('api/milkdonor').then(({ data }) => (this.donorlist = data ));
            },
        },
        created() {
            this.loaddata();
            this.donors();
            this.loadreleased();
            this.loadpending();
            Fire.$on('success',() => {
                this.loaddata();
                this.donors();
                this.loadreleased();
                this.loadpending();
            });
        },
        computed:{
            filteredDonors:function(){
                return this.donorlist.filter((donor) => {
                    return donor.user.lastname.match(this.search);
                });
            }
        }
    }
</script>
