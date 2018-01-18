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
                    <form action="/question">
                        <div class="modal-body">
                            <label for="exampleInputEmail1">Petition Number*</label>
                            <input type="number" class="form-control" placeholder="Enter Petition Number" v-model="petition" required>
                            <br>
                            <label for="exampleFormControlTextarea1">Petition Description*</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Petition Description" v-model="form.desc_petition" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" @click="savePetition">Save</button>
                        </div>
                    </form>
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
                        <label for="exampleInputEmail1">Petition Number*</label>
                        <input type="text" class="form-control" placeholder="Enter Petition Number" v-model="petition.number" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a :href="'/petition/' + petition.number" type="button" class="btn btn-primary">Send</a>
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
                petition: '',
                form: {
                    num_petition: '',
                    desc_petition: '',
                    id_user: ''
                }
            }
        },
        methods: {
            savePetition: function(){
                let self = this;
                self.form.id_user = self.user_id;
                self.form.num_petition = self.petition;
                console.log(this.form);
                axios.post('/api/petitions', self.form)
                .then(function (response) { 
                   console.log(response);               
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>