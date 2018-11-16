<template>
    <div class="container">

                    <div class="card-body">
                        <table class="table table-responsive-sm table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Donor's Name</th>
                                <th>Doctor \ Nurse</th>
                                <th>Date Donated</th>
                                
                            </thead>
                            <tbody>
                                <tr v-for="al in approvedlists.data" :key="al.id" class="text-capitalize">
                                    <td>{{ al.id }}</td>
                                    <td>{{ al.candidate.user.lastname }}, {{ al.candidate.user.firstname }}</td>
                                    <td>{{ al.doctor.user.lastname }}, {{ al.doctor.user.firstname }}</td>
                                    <td>{{ al.created_at }}</td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                
            
        
    </div>
</template>

<script>
    export default {
        data (){
            return{
                screenings :{},
                approvedlists :{},

                donations: [],
                form: new Form({
                    month: '',
                    year: '',
                }),

                months: [
                    {id : 1, text: 'january'},
                    {id : 2, text: 'febuary'},
                    {id : 3, text: 'march'},
                    {id : 4, text: 'april'},
                    {id : 5, text: 'may'},
                    {id : 6, text: 'june'},
                    {id : 7, text: 'july'},
                    {id : 8, text: 'august'},
                    {id : 9, text: 'september'},
                    {id : 10, text: 'october'},
                    {id : 11, text: 'november'},
                    {id : 12, text: 'december'},
                ],
                years: [
                    { id: 1, text: "2018"},
                    { id: 2, text: "2019"},
                    { id: 3, text: "2020"},
                    { id: 4, text: "2021"},
                    { id: 5, text: "2022"},
                    { id: 6, text: "2023"},
                    { id: 7, text: "2024"},
                    { id: 8, text: "2025"},
                    { id: 9, text: "2026"},
                    { id: 10, text: "2027"},
                    { id: 11, text: "2028"},
                    { id: 12, text: "2029"},
                ],
            }
        },
        methods: {  
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

            loaddata(){
                axios.get('api/screening').then(({ data }) => (this.screenings = data ));
            },

            loadapprovedlist(){
                axios.get('api/sapprovedlist').then(({ data }) => (this.approvedlists = data ));
            },

            loaddonations(){
                axios.get('api/displaydonation').then(({ data }) => {
                    this.donations = data.data
                }).catch(() => {

                });
            },
            postdonationpdf(){
                this.$Progress.start();
                this.form.post('postdonationpdf').then(() => {
                    Fire.$emit('success');
                    $('#conditionmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Success PDF'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
        },
        created () {
            this.loaddata();
             this.loadapprovedlist();
            this.loaddonations();
        }
    }
</script>


