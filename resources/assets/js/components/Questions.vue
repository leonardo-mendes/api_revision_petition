<template>
    <div id="app">
        <div v-if="!isLast"> 
            <div >    
                <div v-for="(question, index) in question" :key="index">
                    <div v-show="index === questionIndex">
                        <h3 style="margin-top: 46px">{{ question.desc_question }}</h3>
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
            <button class="btn btn-primary" v-on:click="next()">Next</button>
        </div>    
        <div v-else>
            <h3  style="margin-top: 46px">
                Your Actions:<br><br>
                <p style="font-size:15px" v-for="action in actions">
                   - {{action}}
                </p>
            </h3><br>
            <a href="/home" type="button" class="btn btn-default">Close</a>
            <a href="/home" type="button" class="btn btn-primary">Print</a>
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
        },
        methods: {
            next: function() {
                let self = this;
                axios.get('/api/answers/' + this.userResponses[this.userResponses.length-1])
                .then(function (response) {
                    self.question.push(response.data);
                    if(response.data['desc_question'] == undefined){
                        self.isLast = true;

                        axios.get('/api/petitions/current/' + self.user_id)
                        .then(function (response) {
                            self.petition = response.data;
                            console.log(self.form.id_petition);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                        self.form.id_petition = petition;
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
            }
        }
    }
</script>