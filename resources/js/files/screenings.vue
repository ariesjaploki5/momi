<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Donor Screenings</h3>

                    </div>
                    <div class="card-body p-0 mx-2 my-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="true">Approved For Medical Test</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="false">Approved To Donate</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="disapproved-tab" data-toggle="tab" href="#disapproved" role="tab" aria-controls="disapproved" aria-selected="false">Disapproved to Donate</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved-tab">
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
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-sm btn-primary" @click="view(al)">
                                                                View
                                                            </button>
                                                            <button v-if="al.start_time === null && al.medical_test === 0" class="btn btn-sm btn-primary" @click="schedulemodal(al.id)">
                                                                Schedule
                                                            </button>
                                                            <button v-if="al.approved_to_donate === 0" class="btn btn-sm btn-primary" @click="medtest(al.id)">Medical Test</button>
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Schedule</th>

                                            </thead>
                                            <tbody>
                                                <tr v-for="s in schedulelist.data" :key="s.id">
                                                    <td>{{ s.id }}</td>
                                                    <td>{{ s.client.user.firstname }}</td>
                                                    <td>{{ s.client.user.lastname }}</td>
                                                    <td>
                                                        {{ s.start_time }} - {{ s.finish_time }}
                                                    </td>
 
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade show" id="disapproved" role="tabpanel" aria-labelledby="disapproved-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Text</th>
                                                <th>Selected</th>
                                                <th>Added At</th>

                                            </thead>
                                            <tbody>
                                                <tr v-for="al in disapprovedlists.data" :key="al.id" class="text-capitalize">
                                                    <td>{{ al.id }}</td>
                                                    <td>{{ al.client.user.firstname }}</td>
                                                    <td>{{ al.client.user.lastname }}</td>
                                                    <td>{{ al.created_at }}</td>

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
                    <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="detailmodal" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailmodal">client Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
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
                                                        <td class="text-bold">Child Firstname:</td><td> {{ screening.child_firstname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Child Lastname:</td><td> {{ screening.child_lastname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Birthdate :</td><td> {{ screening.birthdate | myDate2 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Reason Why :</td><td> {{ screening.reason_why }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold">Gender :</td><td> {{ screening.gender }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table" >
                                                <div  class="modaltable">
                                                    <thead class="outline-white">
                                                        <th>Answer</th>
                                                        <th>Question</th>
                                                    </thead>
                                                </div>
                                                <div  class="modaltable2">
                                                <tbody>
                                                    <tr v-for="q in qs" :key="q.id">
                                                        <td> 
                                                            <p v-if="q.answer == 1">Yes</p> 
                                                            <p v-else>No</p>
                                                            </td>
                                                        <td> {{ q.text }} </td>
                                                    </tr>
                                                </tbody>
                                                </div>
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
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="testmodal" tabindex="-1" role="dialog" aria-labelledby="testmodal" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="testmodal">Medical Test</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form @submit.prevent="storemedtest()">
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Test</th>
                                                    <th>Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 
                                                <tr v-for="t in tests" :key="t.id">
                                                    <td>{{ t.name }}</td>
                                                    <td>
                                                        <select v-model="form.results[t.id - 1]">
                                                            <option :value="'1 '+ t.id">POSITIVE</option>
                                                            <option :value="'0 '+ t.id">NEGATIVE</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="testdetailmodal" tabindex="-1" role="dialog" aria-labelledby="testdetailmodal" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="testdetailmodal">View Medical Test</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                    <div class="modal-body">
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
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
                screenings :{},
                approvedlists :{},
                disapprovedlists :{},
                schedulelist :{},
                screening : [],
                user: [],
                qs: [],
                mts: [],
                test_id:[],
                tests: [],
                choices: [
                    { value: 'P', text: "POSITIVE"},
                    { value: 'N', text: "NEGATIVE"}
                ],
                form : new Form({
                    screening_id: '',
                    tests: [],
                    results: [],
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
            getuser(){

            },
            getResults(page = 1) {
                axios.get('api/screening?page=' + page)
                    .then(response => {
                        this.screenings = response.data;
                    });
            },

            getResults2(page = 1) {
                axios.get('api/sapprovedlist?page=' + page)
                    .then(response => {
                        this.approvedlist = response.data;
                    });
            },

            getResults3(page = 1) {
                axios.get('api/sdisapprovedlist?page=' + page)
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
                axios.get('api/screening').then(({ data }) => (this.screenings = data ));
            },

            loadapprovedlist(){
                axios.get('api/sapprovedlist').then(({ data }) => (this.approvedlists = data ));
            },

            loaddisapprovedlist(){
                axios.get('api/sdisapprovedlist').then(({ data }) => (this.disapprovedlists = data ));
            },

            loadmedtest(){
                axios.get('api/test2').then(({ data }) => (this.tests = data ));
                
            },

            loadmedtest2(){
                axios.get('api/test3').then(({ data }) => (this.form.tests = data))
                
            },

            loadschedule(){
                axios.get('api/schedulelist').then(({ data }) => (this.schedulelist = data ));
            },

            view(screening){
                $('#detailmodal').modal('show');
                this.screening = screening;
                this.qs = screening.questions;
                this.mts = screening.tests;
                this.user = screening.client.user;
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
                axios.get('approvedscreening/'+id).then(() => {
                    Fire.$emit('success');
                        toast({
                                type: 'success',
                                title: 'Screening approved'
                            });
                    this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                });
            },

            disapproved(id){
                axios.get('disapprovedscreening/'+id).then(() => {
                    Fire.$emit('success');
                        toast({
                                type: 'danger',
                                title: 'Screening disapproved'
                            });
                    this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                });
            },

            medtest(id){
                this.form.screening_id = id;
                $('#testmodal').modal('show');
            },

            storemedtest(){
                
                this.$Progress.start();
                 this.form.post('api/medtest').then(() => {
                    Fire.$emit('success');
                    $('#testmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Updated Medical Test Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },

            viewmedtest(id){
                
                $('#testdetailmodal').modal('show');
            },
            loadall(){
                this.loaddata();
                this.loadmedtest();
                this.loadmedtest2();
                this.loadapprovedlist();
                this.loaddisapprovedlist();
                this.loadschedule();

            }

        },
        created() {
            this.loadall();
            Fire.$on('success',() => {
                this.loadall();
            });
        }
    }
</script>
