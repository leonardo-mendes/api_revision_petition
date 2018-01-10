<template>
    <div id="app">
        <div> 
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
        <div v-show="questionIndex === this.question.length+1">
            <h2>
                Quiz finished
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
                questionIndex: '',
                userResponses: []
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
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.questionIndex++;
            },
            prev: function() {
                this.questionIndex--;
            }
        }
    }
</script>