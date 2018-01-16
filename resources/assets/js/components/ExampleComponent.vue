<template>
    <div id="app">
        <div v-if="!isLast"> 
            <div >    
                <div v-for="(question, index) in question" :key="index">
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
            <button v-if="questionIndex > 0" v-on:click="prev">
                prev
            </button>
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
    </div>
</template>
<script>
    export default {
        data() {
            return {
                questions: [],
                question: [],
                actions: [],
                questionIndex: '',
                userResponses: [],
                isLast: false
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
                let i = 0;
                axios.get('/api/answers/' + this.userResponses[this.userResponses.length-1])
                .then(function (response) {
                    self.question.push(response.data);
                    console.log(response.data.actions);
                    if(response.data['desc_question'] == undefined){
                        self.isLast = true;
                    }else{
                        for(let i = 0; i<response.data.actions.length; i++){
                            self.actions.push(response.data.actions[i].desc_action);
                        }
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            prev: function() {
                this.questionIndex--;
            }
        }
    }
</script>