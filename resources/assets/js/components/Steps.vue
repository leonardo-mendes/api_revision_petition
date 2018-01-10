<template>
 <div style="padding: 2rem 3rem; text-align: left;">
        DESCRI QUEST {{ question.next_question.desc_question }}
        <br/>
        NEXT {{ question1 }}
        <br/>
        <button @click="clickedNext(question1)">CLICK</button>
    </div>
</template>

<script>
    export default {
        props: ['clickedNext', 'currentStep'],
        data() {
            return {
                form: {
                    answer: ''
                },
                question: [],
                question1: ''
            }
        },
        watch: {
            question: function (newQuestion) {
                this.answer = 'Waiting for you to stop typing...'
                this.getAnswer()
            }
        },
        mounted() {
            this.currentQuestion();
            this.nextQuestion();
        },
        methods: {
            currentQuestion () {
                console.log('/api/answers/' + this.currentStep);
                let self = this;
                axios.get('/api/answers/' + this.currentStep)
                .then(function (response) {
                    self.question = response.data;
                    console.log('cheguei');
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            nextQuestion () {
                let self = this;
                axios.get('/api/answers/' + this.currentStep)
                .then(function (response) {
                    self.question1 = response.data.next_question.answers[0].next_question;
                    console.log('aqui');
                    console.log(response.data);
                    console.log(self.question1);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            clickedNext(val) {
                this.currentStep = val;
                console.log('inhai');
                console.log(this.currentStep);
            }
        }
    }
</script>