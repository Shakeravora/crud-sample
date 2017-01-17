<template>
    <div>
        <div class="panel-heading">Contacts</div>
        <div class="panel-body">
            <div class="table-responsive">
                <router-link class="btn btn-primary btn-xs" title="Add New ContactList" to="/contact/0"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></router-link>
                <vuetable ref="vuetable"
                          api-url="/contacts"
                          :fields="fields"
                          pagination-path=""
                          @vuetable:pagination-data="onPaginationData"
                          @vuetable:cell-clicked="onCellClicked"
                ></vuetable>
                <vuetable-pagination ref="pagination"
                                     @vuetable-pagination:change-page="onChangePage"
                ></vuetable-pagination>


            </div>
        </div>
    </div>
</template>

<script>
    import Form from '../Form';
    import Vuetable from 'vuetable-2/src/components/Vuetable.vue'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination.vue'
    import Vue from 'vue'

    export default {
        components: {
            Vuetable,
            VuetablePagination
        },
        data()  {
            return {
                contacts: [],
                fields: [
                    {
                        name: 'first_name',
                        title: 'First Name'
                    },
                    {
                        name: 'last_name',
                        title: 'Last Name'
                    },
                    {
                        name: 'phone_number',
                        title: 'Phone Number'
                    },
                    {
                        name: 'edit',
                        title: '',
                        callback: 'editButton'
                    },
                    {
                        name: 'delete',
                        title: '',
                        callback: 'deleteButton'
                    },
                ]
            }
        },

        methods: {
            deleteButton() {
                return '<a class="btn btn-danger btn-xs" title="Delete Contact"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>';
            },
            editButton() {
                return '<a class="btn btn-success btn-xs" title="Edit Contact"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>';
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            deleteContact(id) {
                var temp = new Form({
                            id,
                            'url': '/contacts'
                        });
                temp.delete().then(response=>{this.$refs.vuetable.reload();});

            },
            onCellClicked (data, field, event) {
                if(field.name == 'edit') {
                    this.$router.push('/contact/'+data.id);
                }
                else if(field.name == 'delete') {
                    this.deleteContact(data.id);
                }

            }

        },
        created() {
            Event.listen('refresh-contact', this.refresh);
        },
        ready() {

        }
    }
</script>
