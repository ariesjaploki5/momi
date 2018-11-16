<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div v-if="requesting === 1" class="row">
                            <div class="col-md-12">
                                <div class="card bg-success">
                                    <div class="card-body text-center">
                                        <h1>Congratulations!</h1>  
                                         <h3>You Can Get Your Milk Now</h3> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Request
                        
                    </div>
                    <div class="card-body" v-if="submitted === false">
                        <div class="row">
                            <div class="col-12">
                                <form class="form-horizontal" @submit.prevent="submitRequest()">
                                <div class="form-group">
                                    <label for="inputName" class="col-6 control-label">Child Firstname</label>
                                    <div class="col-12">
                                        <input type="text" v-model="form.child_firstname" class="form-control form-control-sm" name="child_firstname" id="child_firstname" placeholder="Child Firstname" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-12 control-label">Child Lastname</label>
                                    <div class="col-12">
                                        <input type="text" v-model="form.child_lastname" class="form-control form-control-sm" name="child_lastname" id="child_lastname" placeholder="Child Lastname" required>
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
                                            <input v-model="form.gender" class="form-check-input" type="radio" 
                                            name="gender" id="male" value="male" required>
                                            <label class="form-check-label" for="boy">Boy</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input v-model="form.gender" class="form-check-input" type="radio" 
                                            name="gender" id="female" value="female" required>
                                            <label class="form-check-label" for="girl">Girl</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-12 control-label">Reason Why</label>
                                    <div class="col-12">
                                        <select  class="form-control form-control-sm" v-model="form.reason_why">
                                            <option value="" hidden selected>Please Select Reason Why Requesting</option>
                                            <option  v-for="r in reasons" :key="r.id" :value="r.value">{{ r.value }}</option>
                                        </select>

                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="inputName" class="col-12 control-label">Attach File</label>
                                    <div class="col-12">
                                        <input type="file"  name="file" id="file" placeholder="File" required>
                                    </div>
                                </div> -->
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
            requesting: 0,
            submitted: false,
            reasons: [
                { value: 'Premature infants, sick '},
                { value: 'Premature infants, well  '},
                { value: 'Infants <12 months with medical and abdominal/gastrointestinal surgical conditions likely to respond to donated human milk therapy'},
                { value: 'Individuals >12 months with medical conditions likely to respond to donated human milk therapy'},
                { value: 'Individuals >12months with chronic medical conditions, high normal functioning, low dose need'},
                { value: 'Individuals >12 months with chronic medical conditions, high normal functioning, high dose need'},
                { value: 'Individuals >12 months with chronic medical conditions, low normal functioning, low dose need'},
                { value: 'Individuals >12 months with chronic medical conditions, low normal functioning, high dose need'},
                { value: 'Infants for short-term use, no specific medical indication'},
                { value: 'Research contract for clinical use in well-designated studies'},

                
            ],
            form: new Form({
                child_firstname: '',
                child_lastname: '',
                gender: '',
                birthdate: '',
                reason_why: '',
            }),
        }
    },
    methods: {
        loadrequesting() {
             axios.get('check_approved_request').then(({ data }) => (this.requesting = data ));
        },

        submitRequest(){
            this.$Progress.start();
                this.form.post('sendrequest2').then(() => {
                    
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
        },
        loadall() {
            this.loadrequesting();
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
