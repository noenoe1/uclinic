<template>
    <app-layout>
        <template #header> 
            <!-- <div class="flex justify-start items-center">
            <inertia-link href="/products/list"> Department List / </inertia-link>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update Department
            </h2>
            </div> -->
            <div class=" rounded font-sans w-full">
                <ol class="list-reset flex text-gray-600 items-center">
                    <li><span class="mx-2">/</span></li>
                    <li><inertia-link href="/blogs/list" class=" text-blue-600 font-bold"> Department List </inertia-link></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-gray-400">Update Department</li>
                </ol>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <template>
                    <jet-form-section @submitted="updateDepartment">
                        <template #title>
                            Edit Department Creation
                        </template>

                        <template #description>
                            Description for the Edit Department for your app. 
                        </template>

                        <template #form>
                            
                            <div class=" sm:col-span-4">
                                <jet-label for="name" value="Department Name" />
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />
                                <jet-input-error :message="form.error('name')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="description" value="Department Description" />
                                <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" id="name" v-model="form.description"></textarea>
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="description" value="Service Name" />
                                <select name="serviceid" class="w-full border bg-white rounded px-3 py-2 outline-none" @change="myFunction()">
                                    <option v-for="serv in services"
                                            v-bind:value='serv.id'
                                            :selected="serv.name==form.serviceid?true : false">
                                        {{serv.name}}
                                    </option>
                                </select> 
                            </div>
                            
                        </template>

                        <template #actions>
                            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                                Saved.
                            </jet-action-message>

                            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </jet-button>

                            <inertia-link class=" button pl-4" :href = "route('blogs.list')" >  Back </inertia-link>
                        </template>
                    </jet-form-section>
                </template>
            </div>
        </div>
       
    </app-layout>
</template>

<script>
import AppLayout from './../../../Layouts/Core/AppLayout'
import JetActionMessage from './../../../Jetstream/ActionMessage'
import JetButton from './../../../Jetstream/Button'
import JetFormSection from './../../../Jetstream/FormSection'
import JetInput from './../../../Jetstream/Input'
import JetInputError from './../../../Jetstream/InputError'
import JetLabel from './../../../Jetstream/Label'

export default {
    components : {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
    },
    props: [
        'department'
    ],
    data() {
        return {
            form: this.$inertia.form({
                name : this.department.name,
                description : this.department.description,
                serviceid : this.department.serviceid
            }, {
                bag: 'updateDepartment',
                resetOnSuccess: false,
            }),
            services: [],
            serv: '',
        }
    },
    mounted(){
        this.loadServices()
    },
    methods: {
        getServices: function(){
            axios.get(route('services.getallservices')).then(response => {
                 console.log(response.data);
                 this.services = response.data;
                 } ).catch(error => console.log(error))
        },
        myFunction: function() {
          console.log(this.countryid) 
        },
        loadServices(){
            axios.get(route('services.getallservices'))
            .then(response => this.services = response.data)
            .catch(error => console.log(error))
        },
        updateDepartment() {
            this.form.post(route('departments.update', [this.department, this.$page.user]), {
                preserveScroll: true
            });
        },
    },
    
}
</script>