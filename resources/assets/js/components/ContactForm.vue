<template>
    <div>
        <div class="panel-heading"><span v-if="form.id == null">Add</span><span v-else>Edit</span> Contact</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">


                    <form style="display:inline" method="POST" action="/contacts" @submit.prevent="onSubmit"
                          @keydown="form.errors.clear($event.target.name)">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="first_name"> First Name</label>
                            <div class="col-md-6">
                                <input type="text" name="first_name" class="form-control" v-model="form.first_name"/>
                                <p class="help-block">
                                    <span class="help is-danger" v-if="form.errors.has('first_name')"
                                          v-text="form.errors.get('first_name')"></span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-md-4 control-label" for="last_name"> Last Name</label>
                            <div class="col-md-6">
                                <input type="text" name="last_name" class="form-control" v-model="form.last_name"/>
                                <p class="help-block">
                                    <span class="help is-danger" v-if="form.errors.has('last_name')"
                                          v-text="form.errors.get('last_name')"></span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="phone_number"> Phone Number</label>
                            <div class="col-md-6">
                                <input type="text" name="phone_number" class="form-control"
                                       v-model="form.phone_number"/>
                                <p class="help-block">

                                    <span class="help is-danger" v-if="form.errors.has('phone_number')"
                                          v-text="form.errors.get('phone_number')"></span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <button class="btn btn-primary" :disabled="form.errors.any()">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Form from '../Form';
    export default {
        watch: {
            '$route' (to) {
                this.init(to.params.id);
            }
        },
        data()  {
            return {
                showForm: false,
                form: new Form({
                    first_name: '',
                    last_name: '',
                    phone_number: '',
                    id: null
                }, '/contacts')
            }
        },

        methods: {
            init(id) {
                this.form.reset();
                this.form.id = id;
                if(id == 0) {
                    this.form.id = null;
                }
                else {
                    this.form.fetch(id);
                }
            },
            onSubmit() {
                this.form.post('/contacts')
                        .then(response => {
                    this.$router.push('/');
                });
            },
            onDelete(event) {
                this.form.id=event.id;
                this.form.delete('contacts/'+event.id);
            }
        },
        created() {
            this.init(this.$route.params.id);
        }
    }
</script>
