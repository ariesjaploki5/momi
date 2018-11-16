<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Milk Request</h3>

                    </div>
                    <div class="card-body p-0 mx-2 my-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="requesting-tab" data-toggle="tab" href="#requesting" role="tab" aria-controls="requesting" aria-selected="true">Milk Requests</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="requesting" role="tabpanel" aria-labelledby="requesting-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Added At</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="requesting in requestings.data" :key="requesting.id" class="text-capitalize">
                                                    <td>{{ requesting.id }}</td>
                                                    <td>{{ requesting.client.user.firstname }}</td>
                                                    <td>{{ requesting.client.user.lastname }}</td>
                                                    <td>{{ requesting.created_at }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info" @click="view(requesting)" >               
                                                            <!-- <i class="fa fa-edit"></i> -->
                                                            View
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-success" @click="approved(requesting.id)">Approved</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Added At</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="al in approvedlists.data" :key="al.id" class="text-capitalize">
                                                    <td>{{ al.id }}</td>
                                                    <td>{{ al.client.user.firstname }}</td>
                                                    <td>{{ al.client.user.lastname }}</td>
                                                    <td>{{ al.created_at }}</td>
                                                    
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" @click="givemilkmodal(al.id)">
                                                            Give Milk
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="modal fade" id="givemilkmodal" tabindex="-1" role="dialog" aria-labelledby="givemilkmodal" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="givemilkmodal">Available Milks</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Milk Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="milk in milks.data" :key="milk.id">
                                                    <td>{{ milk.id }}{{ milk.milk_id }}</td>
                                                    
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" @click="givemilk(milk.id)">
                                                            Release 
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="detailmodal" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailmodal">Request Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                               
                                    <div class="modal-body">
                                        <div class="container-fluid">
                           <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <table>
                                                
                                                <tbody class="text-capitalize">
                                                    <tr>
                                                        <td class="text-bold">Firstname:</td><td> {{ user.firstname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">MI:</td><td> {{ user.middlename }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Lastname:</td><td> {{ user.lastname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Contact:</td><td> {{ user.contact }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Address:</td><td> {{ user.addresss }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">City:</td><td> {{ user.city }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <table>
                                                <tbody class="text-capitalize">
                                                    <tr>
                                                        <td class="text-bold">Child Firstname:</td><td> {{ details.child_firstname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Child Lastname:</td><td> {{ details.child_lastname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Birthdate :</td><td> {{ details.birthdate | myDate2 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Reason Why :</td><td> {{ details.reason_why }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Gender :</td><td> {{ details.gender }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                       </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                    

                    <div class="modal fade" id="schedulemodal" tabindex="-1" role="dialog" aria-labelledby="schedulemodal" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="schedulemodal">Schedule</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form @submit.prevent="schedule()">
                                    <div class="modal-body">
                                        <div class="row justfiy-content-center">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="date" class="control-label">Date</label>
                                                    <input type="date" class="form-control" v-model="scheduleform.date" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="start_time" class="control-label">Start time*</label>
                                                    <div class="form-inline">
                                                    <select v-model="scheduleform.starting_hour" class="form-control" required>
                                                        
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                    </select>
                                                    :
                                                    <select v-model="scheduleform.starting_minute" class="form-control" required>
                                                        <option value="00">00</option>
                                                        <option value="15">15</option>
                                                        <option value="30">30</option>
                                                        <option value="45">45</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="finish_time" class="control-label">Finish time*</label>
                                                    <div class="form-inline">
                                                    <select v-model="scheduleform.finish_hour" class="form-control" required>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                    </select>
                                                    :
                                                    <select v-model="scheduleform.finish_minute" class="form-control" required>
                                                        
                                                        <option value="00">00</option>
                                                        <option value="15">15</option>
                                                        <option value="30">30</option>
                                                        <option value="45">45</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
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
        
        data() {
            return{

                requestings :{},
                approvedlists :{},
                disapprovedlists :{},
                schedulelist :{},
                milks: {},
                details: [],
                user: [],
                requesting: [],
                givemilkform: new Form({
                    requesting_id: '',
                }),

                form : new Form({
                    requesting_id: '',
                }),

                scheduleform: new Form({
                    id: '',
                    date: '',
                    starting_hour: '',
                    starting_minute: '',
                    finish_hour: '',
                    finish_minute: '',
                }),
            }   
        },
        methods: {
            changeSelect(event){

            },
            getResults(page = 1) {
                axios.get('api/requesting?page=' + page)
                    .then(response => {
                        this.requestings = response.data;
                    });
            },

            getResults2(page = 1) {
                axios.get('api/rapprovedlist?page=' + page)
                    .then(response => {
                        this.approvedlist = response.data;
                    });
            },

            getResults3(page = 1) {
                axios.get('api/rdisapprovedlist?page=' + page)
                    .then(response => {
                        this.disapprovedlist = response.data;
                    });
            },

            getResults4(page = 1) {
                axios.get('api/schedulelist?page=' + page)
                    .then(response => {
                        this.schedulelist = response.data;
                    });
            },

            loaddata(){
                axios.get('api/requesting').then(({ data }) => (this.requestings = data ));
            },

            loadapprovedlist(){
                axios.get('api/rapprovedlist').then(({ data }) => (this.approvedlists = data ));
            },

            loaddisapprovedlist(){
                axios.get('api/rdisapprovedlist').then(({ data }) => (this.disapprovedlists = data ));
            },


            loadschedule(){
                axios.get('api/schedulelist').then(({ data }) => (this.schedulelist = data ));
            },
            loadmilk(){
                axios.get('api/milk2').then(({data}) => (this.milks = data));
            },

            view(requesting){
                $('#detailmodal').modal('show');
                this.details = requesting;
                this.user = requesting.recipient.user;
                this.requesting = requesting;

            },

            schedulemodal(id){
                this.scheduleform.id = id;
                $('#schedulemodal').modal('show');

            },

            schedule(){
                this.scheduleform.put('api/schedule/'+this.scheduleform.id).then(() => {
                    Fire.$emit('success');
                    $('#schedulemodal').modal('hide');
                    toast({
                                type: 'success',
                                title: 'Schedule'
                            });
                        this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                });
            },

            approved(id){
                axios.get('approvedrequesting/'+id).then(() => {
                    Fire.$emit('success');
                        toast({
                                type: 'success',
                                title: 'Requesting Approved'
                            });
                    this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                });
            },

            disapproved(id){
                axios.get('disapprovedrequesting/'+id).then(() => {
                    Fire.$emit('success');
                        toast({
                                type: 'danger',
                                title: 'requesting disapproved'
                            });
                    this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                });
            },
            givemilkmodal(id){
                this.givemilkform.requesting_id = id;
                $('#givemilkmodal').modal('show');
            },
            givemilk(id){
                this.givemilkform.post('api/givemilk/'+id).then(() => {
                    Fire.$emit('success');
                    toast({
                                type: 'success',
                                title: 'Milk reserved'
                            });
                        this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                });
            },
            loadall(){
                this.loaddata();

                this.loadschedule();
                this.loadmilk();

                this.loadapprovedlist();
                this.loaddisapprovedlist();
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
