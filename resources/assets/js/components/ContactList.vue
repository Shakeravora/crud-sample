<template>
    <div>
        <div class="panel-heading">Contacts</div>
        <div class="panel-body">
            <div class="table-responsive">
                <router-link class="btn btn-primary btn-xs" title="Add New ContactList" to="/contact/0"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></router-link>
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th>ID</th><th> First Name </th><th> Last Name </th><th> Phone Number </th><th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="contact in contacts">
                        <td>{{ contact.id }}</td>
                        <td>{{ contact.first_name }}</td><td>{{ contact.last_name }}</td><td>{{ contact.phone_number }}</td>
                        <td>
                            <router-link :to="contactRoute(contact.id)" class="btn btn-success btn-xs" title="Edit Contact"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></router-link>
                            <a @click.prevent="deleteContact(contact.id)" class="btn btn-danger btn-xs" title="Delete Contact"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from '../Form';

    export default {
        data()  {
            return {
                contacts: []
            }
        },

        methods: {
            contactRoute(id) {
                return '/contact/'+id;
            },
            refresh() {
                axios.get('contacts').then(response => {
                    this.contacts = response.data;
                })

            },
            deleteContact(id) {
                var temp = new Form({
                            id,
                            'url': '/contacts'
                        });
                temp.delete();
                this.refresh();
            }
        },
        created() {
            this.refresh();
            Event.listen('refresh-contact', this.refresh);
        },
        ready() {

        }
    }
</script>
