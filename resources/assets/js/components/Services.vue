<template>
    <div id="app">
        <div class="bg-grey">
            <h4>Navigate through the options below</h4><br>
            <div class="row text-center">
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <p><b>Petitions Guide</b></p>
                        <p>This service will assist you in your petitions, indicating actions to be taken.</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Start</button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <p><b>Search Actions</b></p>
                        <p>If you made a petition questionnaire and lost your actions, look then here.</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSearch">Start</button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <p><b>Petitions Controller</b></p>
                        <p>Petitions controller, close your actions and look the progress.</p>
                        <button type="button" class="btn btn-primary" title="In progress!" disabled>Start</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guide Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Petition Guide</h4>
                    </div>
                    <div class="modal-body">
                        <label for="exampleInputEmail1">Petition Number</label>
                        <input type="text" class="form-control" placeholder="Enter Petition Number" required>
                        <br>
                        <label for="exampleFormControlTextarea1">Petition Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Petition Description"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Search -->
        <div class="modal fade" id="modalSearch" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Search Actions</h4>
                    </div>
                    <div class="modal-body">
                        <label for="exampleInputEmail1">Petition Number</label>
                        <input type="text" class="form-control" placeholder="Enter Petition Number" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['user_id'],
        data() {
            return {
                questions: [],
                question: [],
                actions: [],
                results: [],
                questionIndex: '',
                userResponses: [],
                isLast: false,
                petition: '',
                form: {
                    action_result: [],
                    id_petition: ''
                },
                formPetition: {
                    num_petition: '',
                    desc_petition: '',
                    id_user: ''
                }
            }
        },
        created() {
            this.questions = [];
            let self = this;
            axios.get('/api/questions/1')
            .then(function (response) {
                self.question.push(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        mounted() {
            this.questionIndex = 0;
            for (let i = 0; i < this.questions.length; i++) {
                this.userResponses[i] = false;
            }
        },
        methods: {
            next: function() {
                let self = this;
                axios.get('/api/answers/' + this.userResponses[this.userResponses.length-1])
                .then(function (response) {
                    self.question.push(response.data);
                    if(response.data['desc_question'] == undefined){
                        self.isLast = true;
                        console.log(self.form);
                        axios.post('/api/results' , self.form)
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    }else{
                        for(let i = 0; i<response.data.actions.length; i++){
                            self.actions.push(response.data.actions[i].desc_action);
                        }
                        for(let i = 0; i<response.data.actions.length; i++){
                            self.form.action_result.push(response.data.actions[i].id);
                        }
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.questionIndex++;
            },
            savePetition: function(){
                let self = this;
                self.formPetition.id_user = self.user_id;
                self.formPetition.num_petition = self.petition;
                axios.post('/api/petitions', self.formPetition)
                .then(function (response) {
                   self.form.id_petition = response.data;   
                   console.log( self.form.id_petition);               
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>