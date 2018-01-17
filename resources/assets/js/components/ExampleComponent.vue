<template>
    <div id="app">
        <div v-if="!isLast"> 
            <div >    
                <div v-for="(question, index) in question" :key="index">
                    <div v-show="index === questionIndex">
                        <h2>{{ question.desc_question }}</h2>
                        <ol>
                            <li v-for="response in question.answers">
                                <label>
                                    <input type="radio"
                                        v-bind:value="response.id" 
                                        v-bind:name="index" 
                                        v-model="userResponses[index]" required> {{response.desc_answer}}
                                </label>
                            </li>
                        </ol>
                    </div>
                </div>            
            </div>
            <button v-on:click="next()">
                next
            </button>
        </div>    
        <div v-else>
            <h2>
                Your Actions:<br><br>
                <p v-for="action in actions">
                    {{action}}
                </p>
            </h2>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="closeModal close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="exampleInputEmail1">Petition</label>
                <input type="text" class="form-control" v-model="petition"  placeholder="Enter Petition Number" required>
                <br>
                <label for="exampleFormControlTextarea1">Petition Description</label>
                <textarea class="form-control" v-model="formPetition.desc_petition" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveChanges" @click="savePetition()">Save changes</button>
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