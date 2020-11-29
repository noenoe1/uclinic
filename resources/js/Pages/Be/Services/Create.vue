<template>
    <app-layout>
        <template #header> 
            <div class=" rounded font-sans w-full">
                <ol class="list-reset flex text-gray-600 items-center">
                    <li><inertia-link href="/products/list" class=" text-blue-600 font-bold">{{$page.isDarkMode}} Product List </inertia-link></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-gray-400">Create New Product</li>
                </ol>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <template>
                    <jet-form-section @submitted="createService" enctype="multipart/form-data">
                        <template #title>
                            New Service Creation
                        </template>

                        <template #description>
                            Description for the New Creation Service for your app. 
                        </template>

                        <template #form>
                            
                            <div class=" sm:col-span-4">
                                <jet-label for="name" value="Service Name" />
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />
                                <jet-input-error :message="form.error('name')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="description" value="Service Description" />
                                <jet-input id="description" type="text" class="mt-1 block w-full" v-model="form.description" autofocus />
                                <jet-input-error :message="form.error('description')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <label for="image">Service Image</label> <br>
                                <input type="file" class="form-control" v-on:change="onImageChange">
                            </div>
                            
                        </template>

                        <template #actions>
                            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                                Saved.
                            </jet-action-message>

                            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </jet-button>

                            <inertia-link class=" button pl-4" :href = "route('services.list')" >  Back </inertia-link>
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

    data() {
        return {
            form: this.$inertia.form({
                name : '',
                description : '',
                image: '',

            }, {
                bag: 'createService',
                resetOnSuccess: false,
            })
        }
    },

    methods: {
        createService() {
            this.form.post(route('services.store'), {
                preserveScroll: true
            });
        },
        onImageChange(e){
            console.log(e.target.files[0]);
            this.form.image = e.target.files[0];
        },
    },
    
}
</script>