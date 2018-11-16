<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div v-if="approved_for_medical_test === 1 && approved_to_donate === 0" class="row">
                            <div class="col-md-12">
                                <div class="card bg-info">
                                    <div class="card-body text-center">
                                        <div v-if="medtest_schedule.start_time == null || medtest_schedule.finish_time ==null">
                                            <h3>Wait For Your Schedule</h3>
                                        </div>
                                        <div v-else>
                                            <h3>Your Schedule For Medical Test</h3>
                                            <h4><p>{{ medtest_schedule.start_time }} - {{ medtest_schedule.finish_time }}</p></h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div v-if="approved_to_donate === 2" class="row">
                            <div class="col-md-12">
                                <div class="card bg-success">
                                    <div class="card-body text-center">
                                        <h1>Sorry</h1>  
                                        <h3>You are not approved to become a donor</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="approved_to_donate === 1" class="row">
                            <div class="col-md-12">
                                <div class="card bg-success">
                                    <div class="card-body text-center">
                                        <h1>Congratulation!</h1>  
                                        <h3>You Have Been Approved to become a Donor</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">
                        Donate
                        
                    </div>
                    <div v-if="submitted === false" class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form class="form-horizontal" @submit.prevent="submitDonate()">
                                <div class="form-group">
                                    <label for="inputName" class="col-6 control-label">Child Firstname</label>
                                    <div class="col-12">
                                        <input type="text"  v-model="form.child_firstname" class="form-control form-control-sm" name="child_firstname" id="child_firstname" placeholder="Child Firstname" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-12 control-label">Child Lastname</label>
                                    <div class="col-12">
                                        <input type="text"  v-model="form.child_lastname" class="form-control form-control-sm" name="child_lastname" id="child_lastname" placeholder="Child Lastname" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-12 control-label">Birthdate</label>
                                    <div class="col-12">
                                        <input type="date" v-model="form.birthdate" class="form-control form-control-sm text-uppercase" name="birthdate" id="birthdate" placeholder="Birthdate" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-12 control-label">Gender</label>
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" v-model="form.gender" type="radio" 
                                            name="gender" id="male" value="male" required>
                                            <label class="form-check-label" for="boy">Boy</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" v-model="form.gender" type="radio" 
                                            name="gender" id="female" value="female" required>
                                            <label class="form-check-label" for="girl">Girl</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-12">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td width="25%">
                                                        Answer
                                                    </td>
                                                    <td>
                                                        Question
                                                    </td>
                                                </tr>
                                                <tr v-for="q in questions" :key="q.id">
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input"  v-model="form.answer[q.id]" type="radio" :id=q.id  :value="'1 '+ q.id " required>
                                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input"  v-model="form.answer[q.id]" type="radio" :id=q.id :value="'0 '+ q.id" required>
                                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>{{ q.text }}</p>
                                                    </td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                           

                        </div>
                    </div>
                    <div class="card-body" v-if="submitted === true">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <h2>Please Wait for the Approval</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</template>
<script>
export default {
    data () {
        return{
            approved_for_medical_test: 0,
            approved_to_donate: 0,
            medtest: 0,
            medtest_schedule: [],
            submitted: false,
            questions: {},
            form:new Form({
                child_firstname: '',
                child_lastname: '',
                gender: '',
                birthdate: '',
                answer: {},
            }),
        }
    },
    methods: {
        loadscreening() {
            axios.get('check_approved_for_medical_test').then(({ data }) => (this.approved_for_medical_test = data ));
        },
        loaddonate(){
            axios.get('check_approved_to_donate').then(({ data }) => (this.approved_to_donate= data ));
        },
        loadmedtest() {
            axios.get('checkscreeningmedtest').then(({ data }) => (this.medtest = data ));
        },
        loadschedule(){
            axios.get('loadschedule').then(({ data }) => (this.medtest_schedule = data ));
        },
        loadquestion(){
            axios.get('selectedquestion').then(({ data }) => (this.questions = data ));
        },
        loadall(){
            this.loadscreening();
            this.loadmedtest();
            this.loadschedule();
            this.loaddonate();
            this.loadquestion();
        },
        submitDonate(){
            this.$Progress.start();
                this.form.post('senddonate2').then(() => {
                    Fire.$emit('success');
                    $('#doctormodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Submitted Successfully'
                        });
                    this.$Progress.finish();
                    this.submitted = true;
                }).catch(() =>{
                    this.$Progress.fail();
                })
        }
    },
    created() {
        this.loadall();
        this.interval = setInterval(() => 
            this.loadall(), 30000
        );
        
    }
}
</script>
